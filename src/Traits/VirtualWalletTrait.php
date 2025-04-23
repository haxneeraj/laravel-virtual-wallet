<?php

namespace Haxneeraj\LaravelVirtualWallet\Traits;

use Haxneeraj\LaravelVirtualWallet\Exceptions\InvalidWalletException;

use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait VirtualWalletTrait
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
trait VirtualWalletTrait
{
    /**
     * Define a polymorphic one-to-many relationship with the Wallet model.
     *
     * Optionally filters the wallets by wallet type if provided.
     *
     * @param string|null $walletType The wallet type to filter by (optional).
     * @return MorphMany
     *
     * @throws InvalidWalletException If the wallet type is invalid.
     */
    public function wallets(string $walletType = null): MorphMany
    {
        if (!empty($walletType)) {
            if (!in_array($walletType, resolve_wallet_enum('wallet_type')::values())) {
                throw new InvalidWalletException();
            }
            return $this->morphMany($this->walletModelClass(), 'owner')
                        ->where('wallet_type', $walletType);
        }

        return $this->morphMany($this->walletModelClass(), 'owner');
    }

    /**
     * Retrieve the wallet balance.
     *
     * If a wallet type is provided, returns the balance of that specific wallet.
     * If no type is provided, returns the total balance across all wallets.
     *
     * @param string|null $walletType The wallet type to filter by (optional).
     * @return int|float The wallet balance or total balance.
     *
     * @throws InvalidWalletException If the wallet type is invalid.
     */
    public function getBalance(string $walletType = null): int|float
    {
        return $this->wallets($walletType)->value('balance') ?? 0;
    }

    /**
     * Check if the wallet has a positive balance.
     *
     * If a wallet type is provided, checks that wallet's balance.
     * Otherwise, checks if the total balance is greater than zero.
     *
     * @param string|null $walletType The wallet type to check (optional).
     * @return bool True if balance is positive, false otherwise.
     *
     * @throws InvalidWalletException If the wallet type is invalid.
     */
    public function hasBalance(string $walletType = null): bool
    {
        return $this->getBalance($walletType) > 0;
    }

    /**
     * Determine if the wallet has a sufficient balance.
     *
     * If a wallet type is provided, checks if the specific wallet has the required balance.
     * If no wallet type is given, checks against the total balance.
     *
     * @param int|float $amount The amount to compare with.
     * @param string|null $walletType The wallet type to check (optional).
     * @return bool True if balance is sufficient, false otherwise.
     *
     * @throws InvalidWalletException If the wallet type is invalid.
     */
    public function hasSufficientBalance(int|float $amount, string $walletType = null): bool
    {
        return $this->getBalance($walletType) >= $amount;
    }
}