<?php

namespace Haxneeraj\LaravelVirtualWallet\Tests\Enums;

use Haxneeraj\LaravelVirtualWallet\Traits\EnumTrait;

/**
 * TransactionMethodEnum defines various methods used in transactions within the application, such as Offline, Online, Withdraw, Deposit, Automatic, Manual, and Wallet transfers.
 * 
 * This enum uses the EnumTrait to provide additional functionality, including validation methods for enum values.
 * Each case represents a specific transaction method type.
 * 
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 */
enum TransactionMethodEnum: string
{
    use EnumTrait;

    /**
     * Enum case representing a offline method.
     */
    // case OFFLINE = 'offline';

    /**
     * Enum case representing a online method.
     */
    // case ONLINE = 'online';

    /**
     * Enum case representing a withdrawal method.
     */
    // case WITHDRAW = 'withdraw';

    /**
     * Enum case representing a deposit method.
     */
    // case DEPOSIT = 'deposit';

    /**
     * Enum case representing an automatic transaction method.
     */
    case AUTOMATIC = 'automatic';

    /**
     * Enum case representing a manual transaction method.
     */
    case MANUAL = 'manual';

    /**
     * Enum case representing a transfer from Wallet 1 to Wallet 2.
     */
    // case WALLET_TRANSFER = 'wallet_transfer';
}