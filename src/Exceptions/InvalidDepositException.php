<?php

namespace Haxneeraj\LaravelVirtualWallet\Exceptions;

use Exception;
use Throwable;

/**
 * Class InvalidDepositException 
 *
 * This exception is thrown when an invalid currency is used in a wallet transaction
 * or operation, such as when the currency does not match the allowed values or is
 * not recognized by the system.
 * 
 * @package Haxneeraj\LaravelVirtualWallet\Exceptions
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 */
class InvalidDepositException  extends Exception
{
    /**
     * The HTTP status code associated with this exception.
     *
     * @var int
     */
    protected int $statusCode;

    /**
     * InvalidDepositException  constructor.
     * 
     * Initializes the exception with a custom message or a default message from the
     * language file if no custom message is provided.
     *
     * @param string|null $message The custom error message (optional).
     * @param int $code The error code (default is 0).
     * @param Throwable|null $previous The previous exception (optional).
     */
    public function __construct(string $message = null, int $code = 0, int $statusCode = 400, ?Throwable $previous = null)
    {
        // If no custom message is provided, use the default 'invalid_currency' message.
        $message = $message ?? __('LaravelVirtualWallet::message.invalid_deposit');
        
        parent::__construct($message, $code, $previous);

        $this->statusCode = $statusCode;
    }

    /**
     * Get the HTTP status code associated with the exception.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
