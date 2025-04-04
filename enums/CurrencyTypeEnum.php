<?php

namespace App\Enums;

use Haxneeraj\LaravelVirtualWallet\Traits\EnumTrait;

/**
 * CurrencyTypeEnum defines various types of currencies used in the application, such as cryptocurrency and fiat currency.
 * 
 * - **Cryptocurrency**: A type of digital or virtual currency that uses cryptography for security and operates on decentralized networks without a central authority (e.g., Bitcoin, Ethereum).
 * - **Fiat Currency**: Traditional money issued by a government, not backed by a physical commodity. Its value is derived from the trust placed in the issuing government (e.g., USD, EUR).
 * 
 * This enum uses the EnumTrait to add additional functionality, such as validation of enum values. Each case represents a specific type of currency.
 * 
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 */
enum CurrencyTypeEnum: string
{
    use EnumTrait;

    /**
     * Enum case representing cryptocurrency.
     * 
     * Cryptocurrency is a type of digital or virtual currency that operates on decentralized networks and uses cryptography for security.
     */
    case CRYPTOCURRENCY = 'cryptocurrency';

    /**
     * Enum case representing fiat currency.
     * 
     * Fiat currency is traditional money issued by a government. It is not backed by a physical commodity but derives its value from the trust in the issuing government.
     */
    case FIAT_CURRENCY = 'fiat_currency';
}
