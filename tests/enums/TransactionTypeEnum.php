<?php

namespace Haxneeraj\LaravelVirtualWallet\Tests\Enums;

use Haxneeraj\LaravelVirtualWallet\Traits\EnumTrait;

/**
 * TransactionTypeEnum represents various types of transactions within the application, such as Deposit, Withdraw, Bonus, Credit, etc.
 * 
 * This enum uses the EnumTrait to provide additional functionality for interacting with enum values, including validation methods.
 * 
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 */
enum TransactionTypeEnum: string
{
    use EnumTrait;

    /**
     * Enum case representing a deposit transaction.
     */
    case DEPOSIT = 'deposit';

    /**
     * Enum case representing a withdrawal transaction.
     */
    case WITHDRAW = 'withdraw';

    /**
     * Enum case representing a bonus transaction.
     */
    // case BONUS = 'bonus';

    /**
     * Enum case representing a credit transaction.
     */
    // case CREDIT = 'credit';

    /**
     * Enum case representing a debit transaction.
     */
    // case DEBIT = 'debit';
}

