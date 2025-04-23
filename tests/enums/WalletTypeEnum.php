<?php

namespace Haxneeraj\LaravelVirtualWallet\Tests\Enums;

use Haxneeraj\LaravelVirtualWallet\Traits\EnumTrait;

/**
 * WalletTypeEnum represents different types of wallets in the application.
 * 
 * This enum uses the EnumTrait trait to provide additional functionality 
 * for interacting with the enum values.
 * 
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 */
enum WalletTypeEnum: string
{
    use EnumTrait;

    /**
     * Enum case representing the first type of wallet.
     */
    case WALLET1 = 'wallet1';

    /**
     * Enum case representing the second type of wallet.
     */
    case WALLET2 = 'wallet2';
}
