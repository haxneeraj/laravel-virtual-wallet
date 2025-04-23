<?php

namespace Haxneeraj\LaravelVirtualWallet\Tests\Enums;

use Haxneeraj\LaravelVirtualWallet\Traits\EnumTrait;

/**
 * CurrencyEnum defines various types of currencies used in the application, including both traditional currencies and cryptocurrencies.
 * 
 * Examples of traditional currencies:
 * - **USD**: United States Dollar
 * - **INR**: Indian Rupee
 * - **EUR**: Euro
 * 
 * Examples of cryptocurrencies:
 * - **Bitcoin**: A popular decentralized digital currency.
 * - **Ethereum**: A cryptocurrency that supports smart contracts.
 * 
 * This enum uses the EnumTrait to provide additional functionality, such as validation of enum values. Each case represents a specific type of currency.
 * 
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 */
enum CurrencyEnum: string
{
    use EnumTrait;

    /**
     * Enum case representing the United States Dollar (USD).
     * 
     * USD is the official currency of the United States and is widely used in international transactions.
     */
    case USD = 'usd';

    /**
     * Enum case representing the Indian Rupee (INR).
     * 
     * INR is the official currency of India.
     */
    case INR = 'inr';

    /**
     * Enum case representing the Euro (EUR).
     * 
     * EUR is the official currency of the Eurozone, which includes many European countries.
     */
    case EUR = 'eur';

    /**
     * Enum case representing Bitcoin (BTC).
     * 
     * Bitcoin is a decentralized digital currency and the first cryptocurrency.
     */
    case BITCOIN = 'bitcoin';

    /**
     * Enum case representing Ethereum (ETH).
     * 
     * Ethereum is a cryptocurrency and blockchain platform that supports smart contracts.
     */
    case ETHEREUM = 'ethereum';

    // Add additional currencies as needed.
}
