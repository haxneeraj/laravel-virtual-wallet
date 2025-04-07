<?php

namespace App\Enums;

use Haxneeraj\LaravelVirtualWallet\Traits\EnumTrait;

/**
 * TransactionStatusEnum defines various statuses used in the application to track the state of transactions.
 * 
 * - **Approved**: Indicates that the transaction has been approved and processed successfully.
 * - **Pending**: Indicates that the transaction is awaiting approval or processing.
 * - **Declined**: Indicates that the transaction has been rejected or not processed.
 * 
 * This enum utilizes the EnumTrait to provide additional functionality, such as validation of enum values. Each case represents a specific transaction status.
 * 
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 */
enum TransactionStatusEnum: string
{
    use EnumTrait;    

    /**
     * Enum case representing a pending transaction.
     * 
     * Pending status indicates that the transaction is still awaiting approval or processing.
     */
    case PENDING = 'pending';

    /**
     * Enum case representing an approved transaction.
     * 
     * Approved status indicates that the transaction has been successfully processed.
     */
    case APPROVED = 'approved';

    /**
     * Enum case representing a processing transaction.
     * 
     * Processing status indicates that the transaction is still awaiting approval or processing. #Use Case: When a user initiates a transaction from bank (For withdraw the amount or in case of deposite also), the status is set to processing until the transaction is processing by bank.

     */
    case PROCESSING = 'processing';

    /**
     * Enum case representing a declined transaction.
     * 
     * Declined status indicates that the transaction has been rejected or not processed.
     */
    case DECLINED = 'declined';
}
