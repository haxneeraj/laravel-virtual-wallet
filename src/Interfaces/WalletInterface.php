<?php

namespace Haxneeraj\LaravelVirtualWallet\Interfaces;

use Haxneeraj\LaravelVirtualWallet\DataObjects\PaymentData;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Interface WalletInterface
 *
 * Contract for wallet operations including balance checks, transactions, payments, and deposits.
 *
 * @package haxneeraj\laravel-virtual-wallet
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 * @version 1.0.0
 * @license MIT
 */
interface WalletInterface
{
    /**
     * Get the class name of the Wallet model.
     *
     * @return string
     */
    public function walletModelClass(): string;

    /**
     * Get the class name of the WalletTransaction model.
     *
     * @return string
     */
    public function walletTransactionModelClass(): string;

    /**
     * Define the polymorphic wallet relationship.
     *
     * @param string|null $walletType
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function wallets(string $walletType = null): MorphMany;

    /**
     * Get the wallet balance or total balance (if no wallet type is specified).
     *
     * @param string|null $walletType
     * @return int|float
     */
    public function getBalance(string $walletType = null): int|float;

    /**
     * Check if the wallet or total wallet has a balance greater than 0.
     *
     * @param string|null $walletType
     * @return bool
     */
    public function hasBalance(string $walletType = null): bool;

    /**
     * Check if the wallet or total wallets have sufficient balance for the amount.
     *
     * @param int|float $amount
     * @param string|null $walletType
     * @return bool
     */
    public function hasSufficientBalance(int|float $amount, string $walletType = null): bool;

    /**
     * Process payment by deducting amount from single or multiple wallets.
     *
     * @param PaymentData $paymentData
     * @return void
     */
    public function pay(PaymentData $paymentData): void;

    /**
     * Process deposit by adding amount to a wallet (wallet_type required).
     *
     * @param PaymentData $paymentData
     * @return void
     */
    public function deposit(PaymentData $paymentData): void;

     /**
     * Define the polymorphic transaction relationship.
     *
     * @param string|null $walletType
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function transactions(string $walletType = null): MorphMany;

    /**
     * Get paginated transactions for the model.
     *
     * @param string|null $walletType
     * @param int $perPage
     * @param int $page
     * @param array $dateRange
     * @param string $sortBy
     * @param string $sortOrder
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginatedTransactions(
        string $walletType = null,
        int $perPage = 20,
        int $page = 1,
        array $dateRange = [],
        string $sortBy = 'id',
        string $sortOrder = 'desc'
    ): LengthAwarePaginator;
}
