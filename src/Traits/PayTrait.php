<?php

namespace Haxneeraj\LaravelVirtualWallet\Traits;

use Haxneeraj\LaravelVirtualWallet\Exceptions\InsufficientBalanceException;
use Haxneeraj\LaravelVirtualWallet\Exceptions\InvalidWalletException;
use Illuminate\Support\Facades\DB;
use Haxneeraj\LaravelVirtualWallet\DataObjects\PaymentData;
use Haxneeraj\LaravelVirtualWallet\Models\WalletTransaction;

/**
 * Trait PayTrait
 *
 * Provides methods for interacting with the Wallet model, including querying by various criteria and calculating balances.
 * 
 * @package haxneeraj\laravel-virtual-wallet
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 * @version 1.0.0
 * @license MIT
 */
trait PayTrait
{
    /**
     * Processes the payment by deducting the amount from the wallet or wallets
     * and creating the necessary transaction records.
     *
     * @param PaymentData $paymentData
     * @return void
     */
    public function pay(PaymentData $paymentData): void
    {        
        DB::transaction(function () use ($paymentData) {
            // Single wallet case
            if (!empty($paymentData->wallet_type)){
                if (!in_array($paymentData->wallet_type, resolve_wallet_enum('wallet_type')::values())){                  
                    throw new InvalidWalletException(); // Throws exception if invalid wallet type 
                }

                $wallet = $this->wallets()
                ->where('wallet_type', $paymentData->wallet_type)
                ->lockForUpdate()
                ->first();

                if (!$wallet):
                    throw new InvalidWalletException(); // Throws exception if wallet not found
                endif;

                if($wallet->status?->value != resolve_wallet_enum('wallet_status')::ACTIVE->value):
                    throw new \Exception("Wallet is not active"); 
                endif;

                if (!$this->hasSufficientBalance($paymentData->amount, $paymentData->wallet_type)):
                    throw new InsufficientBalanceException(); // Throws exception if insufficient balance 
                endif;
                
                $wallet->decrement('balance', $paymentData->amount);

                // Create wallet transaction
                $wallet_transaction = WalletTransaction::create([
                    'owner_type'      => $paymentData->owner_type,
                    'owner_id'        => $paymentData->owner_id,
                    'txid'            => $paymentData->txid,
                    'amount'          => $paymentData->amount,
                    'description'     => $paymentData->description,
                    'wallet_type'     => $paymentData->wallet_type,
                    'currency'        => $wallet->currency,
                    'currency_type'   => $wallet->currency_type,
                    'transaction_method' => $paymentData->method,
                    'transaction_type' => $paymentData->transaction_type,                    
                    'status'          => $paymentData->status,
                ]);
            }

            // Multiple wallets case
            else{
                if (!$this->hasSufficientBalance($paymentData->amount)){
                    throw new InsufficientBalanceException(); // Throws exception if insufficient balance 
                }

                $wallets = $this->wallets;
                $remainAmount = $paymentData->amount;

                foreach ($wallets as $wallet){
                    if (!$wallet->hasBalance() || $wallet->status?->value != resolve_wallet_enum('wallet_status')::ACTIVE){
                        continue;
                    }
                    
                    // Deduct from multiple wallets if needed 
                    $amountToDeduct = min($wallet->balance, $remainAmount);
                    $wallet->balance -= $amountToDeduct;
                    $wallet->save();

                    // Create wallet transaction for each wallet 
                    $wallet_transaction = WalletTransaction::create([
                        'owner_type'          => $paymentData->owner_type,
                        'owner_id'            => $paymentData->owner_id,
                        'txid'                => $paymentData->txid,
                        'amount'              => $amountToDeduct,
                        'description'         => $paymentData->description,
                        'wallet_type'         => $paymentData->wallet_type,
                        'currency'            => $wallet->currency,
                        'currency_type'       => $wallet->currency_type,
                        'transaction_type'    => $paymentData->transaction_type,
                        'transaction_method'  => $paymentData->method,
                        'status'              => $paymentData->status,
                    ]);

                    $remainAmount -= $amountToDeduct;
                    if ($remainAmount <= 0){
                        break;
                    }
                }

                if ($remainAmount > 0){
                    throw new InsufficientBalanceException(); // Throws exception if not enough balance in all wallets 
                }
            }
        });
    }
}