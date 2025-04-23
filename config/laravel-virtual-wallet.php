<?php

/**
 * This configuration file defines the essential settings for the Laravel Virtual Wallet package.
 * 
 * It specifies the model classes for wallets, transactions, and crypto transactions,
 * as well as the associated database table names. Additionally, it provides a development mode
 * setting for controlling error messages and debugging information.
 */

return [
    /**
     * Model class mappings.
     * 
     * Defines the model classes used by the virtual wallet package. These models can
     * be customized by specifying different model classes, allowing developers to extend
     * or modify the default behavior of the package.
     */
    'models' => [
        // The model class used for Wallet.
        'wallet' => \Haxneeraj\LaravelVirtualWallet\Models\Wallet::class,

        // The model class used for Wallet Transactions.
        'transaction' => \Haxneeraj\LaravelVirtualWallet\Models\WalletTransaction::class,
    ],

    /**
     * Database table mappings.
     * 
     * Defines the names of the database tables used by the virtual wallet package.
     * This allows developers to customize table names as per their application’s needs.
     */
    'tables' => [
        // Table name for Wallets.
        'wallets' => 'wallets',

        // Table name for Wallet Transactions.
        'transactions' => 'wallet_transactions',
    ],

    /**
     * Enum Class Mappings.
     *
     * Defines the enum classes used by the virtual wallet package. These enums can
     * be customized by specifying different enum classes, allowing developers to extend
     * or modify the default behavior of the package.
     * 
     * @see \App\Enums\CurrencyEnum
     * @see \App\Enums\CurrencyTypeEnum
     * @see \App\Enums\TransactionMethodEnum
     * @see \App\Enums\TransactionStatusEnum
     * @see \App\Enums\TransactionTypeEnum
     * @see \App\Enums\WalletStatusEnum
     * @see \App\Enums\WalletTypeEnum
     */
    'enums' => [
        'currency' => \App\Enums\CurrencyEnum::class,
        'currency_type' => \App\Enums\CurrencyTypeEnum::class,
        'transaction_method' => \App\Enums\TransactionMethodEnum::class,
        'transaction_status' => \App\Enums\TransactionStatusEnum::class,
        'transaction_type' => \App\Enums\TransactionTypeEnum::class,
        'wallet_status' => \App\Enums\WalletStatusEnum::class,
        'wallet_type' => \App\Enums\WalletTypeEnum::class,
    ],

    /**
     * Development mode setting.
     * 
     * This setting controls how error messages are handled by the package.
     * There are three possible values for 'dev_mode':
     * 
     * - **true**: Enables real-time error messages, showing specific details.
     * - **false**: Disables real-time error messages, showing general errors like "something went wrong."
     * - **dev**: Enables full debugging, displaying real-time error details along with
     *   the message, file, line number, and stack trace using `dd` (dump and die).
     * 
     * The default is set to 'false' unless the environment variable 'HAX_DEBUG_MODE' is explicitly set.
     */
    'dev_mode' => env('HAX_DEBUG_MODE', false),
];
