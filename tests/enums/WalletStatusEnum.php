<?php

namespace Haxneeraj\LaravelVirtualWallet\Tests\Enums;

use Haxneeraj\LaravelVirtualWallet\Traits\EnumTrait;

/**
 * WalletStatusEnum represents different statuses of wallets within the application.
 * 
 * - **Active**: Indicates that the wallet is currently active and usable.
 * - **Inactive**: Indicates that the wallet is currently inactive and not usable.
 * 
 * This enum uses the EnumTrait to provide additional functionality for interacting with the enum values, such as validation and other methods.
 * 
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 */
enum WalletStatusEnum: string
{
    use EnumTrait;

    /**
     * Enum case representing an active wallet.
     * 
     * The active status indicates that the wallet is currently enabled and available for transactions.
     */
    case ACTIVE = 'active';

    /**
     * Enum case representing an inactive wallet.
     * 
     * The inactive status indicates that the wallet is currently disabled and not available for transactions.
     */
    case INACTIVE = 'inactive';
}
