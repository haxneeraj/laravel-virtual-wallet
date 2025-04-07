<?php 

namespace Haxneeraj\LaravelVirtualWallet\Traits;

/**
 * Trait ModelTrait
 * 
 * Provides methods to retrieve model classes used in the Laravel Virtual Wallet package.
 * This trait allows accessing the configured model classes for wallets, wallet transactions,
 * and crypto transactions through configuration settings.
 * 
 * @package haxneeraj\laravel-virtual-wallet
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 * @version 1.0.0
 * @license MIT
 */
trait ModelTrait
{
    /**
     * Get the class name of the Wallet model.
     * 
     * Retrieves the model class name for Wallet from the configuration file.
     * 
     * @return string The fully qualified class name of the Wallet model.
     */
    public function walletModelClass(): string
    {
        return config('laravel-virtual-wallet.models.wallet');
    }

    /**
     * Get the class name of the WalletTransaction model.
     * 
     * Retrieves the model class name for Wallet Transactions from the configuration file.
     * 
     * @return string The fully qualified class name of the WalletTransaction model.
     */
    public function walletTransactionModelClass(): string
    {
        return config('laravel-virtual-wallet.models.transaction'); // Fixed key to match config
    }
}
