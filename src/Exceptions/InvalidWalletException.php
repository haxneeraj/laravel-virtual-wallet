<?php

namespace Haxneeraj\LaravelVirtualWallet\Exceptions;

use Exception;
use Throwable;

/**
 * Class InvalidWalletException
 *
 * This exception is thrown when an invalid wallet is referenced or an operation
 * is attempted on a wallet that is not recognized or does not exist.
 * 
 * @package Haxneeraj\LaravelVirtualWallet\Exceptions
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 */
class InvalidWalletException extends Exception
{
    /**
     * The HTTP status code associated with this exception.
     *
     * @var int
     */
    protected int $statusCode;

    /**
     * InvalidWalletException constructor.
     * 
     * Initializes the exception with a custom message or the default message
     * 'invalid_wallet' from the language file.
     *
     * @param string|null $message The custom error message (optional).
     * @param int $code The error code (default is 0).
     * @param Throwable|null $previous The previous exception (optional).
     */
    public function __construct(string $message = null, int $code = 0, int $statusCode = 400, ?Throwable $previous = null)
    {
        // If no custom message is provided, use the localized 'invalid_wallet' message.
        $message = $message ?? __('LaravelVirtualWallet::message.invalid_wallet');
        
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
