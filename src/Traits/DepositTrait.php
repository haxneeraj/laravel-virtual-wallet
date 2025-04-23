<?php

namespace Haxneeraj\LaravelVirtualWallet\Traits;

use Haxneeraj\LaravelVirtualWallet\Exceptions\InvalidWalletException;
use Haxneeraj\LaravelVirtualWallet\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Haxneeraj\LaravelVirtualWallet\DataObjects\PaymentData;
use Haxneeraj\LaravelVirtualWallet\Models\WalletTransaction;

/**
 * Trait DepositTrait
 *
 * Provides methods for depositing funds into the Wallet model,
 * including handling various wallet types and creating transaction records.
 * 
 * @package haxneeraj\laravel-virtual-wallet
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 * @version 1.0.0
 * @license MIT
 */
trait DepositTrait
{
    /**
     * Deposits the specified amount into the wallet or wallets
     * and creates the necessary transaction records.
     *
     * @param PaymentData $paymentData
     * @return void
     */
    public function deposit(PaymentData $paymentData): void
    {
        DB::transaction(function () use ($paymentData) {
            // Validate the Wallet
            if(!in_array($paymentData->wallet_type, resolve_wallet_enum('wallet_type')::values()))            
            {
                throw new InvalidWalletException(); // Throws exception if invalid wallet type
            }
                
            $wallet = Wallet::where([
                'wallet_type' => $paymentData->wallet_type, 
                'owner_id' => $paymentData->owner_id
            ])
            ->lockForUpdate()
            ->first();

            if(!$wallet){
                throw new InvalidWalletException(); // Throws exception if wallet not found
            }

            // If status is "approved" then only increment the balance
            if($paymentData?->status == 'approved'){
                $wallet->increment('balance', $paymentData->amount);
            }
            
            // Create Wallet Transaction
            $wallet_transaction = WalletTransaction::create([
                'owner_type'         => $paymentData->owner_type,
                'owner_id'           => $paymentData->owner_id,
                'txid'               => $paymentData->txid,
                'amount'             => $paymentData->amount,
                'description'        => $paymentData->description,
                'wallet_type'        => $paymentData->wallet_type,
                'currency'           => $wallet->currency,
                'currency_type'      => $wallet->currency_type,
                'transaction_method' => $paymentData->method,
                'transaction_type'   => $paymentData->transaction_type,
                'status'             => $paymentData->status,
            ]); // Create wallet transaction
        });
    }
}
