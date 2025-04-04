<?php

namespace Haxneeraj\LaravelVirtualWallet\Exceptions;

use Exception;
use Throwable;

/**
 * Class InsufficientBalanceException
 *
 * This exception is thrown when a wallet does not have sufficient balance 
 * to complete a transaction or operation.
 * 
 * @package Haxneeraj\LaravelVirtualWallet\Exceptions
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 */
class InsufficientBalanceException extends Exception
{
    /**
     * The HTTP status code associated with this exception.
     *
     * @var int
     */
    protected int $statusCode;

    /**
     * InsufficientBalanceException constructor.
     * 
     * Initializes the exception with a custom message or the default message 
     * 'insufficient_balance' from the language file.
     *
     * @param string|null $message The custom error message (optional).
     * @param int $code The error code (default is 0).
     * @param Throwable|null $previous The previous exception (optional).
     */
    public function __construct(string $message = null, int $code = 0, int $statusCode = 400, ?Throwable $previous = null)
    {
        // If no custom message is provided, use the localized 'insufficient_balance' message.
        $message = $message ?? __('LaravelVirtualWallet::message.insufficient_balance');
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
