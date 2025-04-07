<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\WalletTypeEnum;
use App\Enums\CurrencyEnum;
use App\Enums\CurrencyTypeEnum;
use App\Enums\TransactionTypeEnum;
use App\Enums\TransactionMethodEnum;
use App\Enums\TransactionStatusEnum;

return new class () extends Migration {
    /**
     * Run the migrations to create the 'wallet_transactions' table. (Don't Change the Table name else if you want so you have to change in modal too.)
     * 
     * This method defines the schema for the 'wallet_transactions' table, which will store information about wallet transactions.
     * 
     * Columns:
     * - `id`: Auto-incrementing primary key.
     * - `owner`: Polymorphic relationship for the owner of the transaction (e.g., user or another entity).
     * - `owner_from`: Polymorphic relationship for the source of the transaction (e.g., who sent the amount). Nullable for internal transfers.
     * - `txid`: Unique transaction identifier.
     * - `amount`: Amount involved in the transaction.
     * - `platform_fee`: Fee charged by the platform for processing the transaction.
     * - `total`: Total amount after fees.
     * - `wallet_type`: Type of wallet involved, using values from `WalletTypeEnum`.
     * - `currency`: Currency of the transaction, using values from `CurrencyEnums`. Defaults to USD.
     * - `currency_type`: Type of currency, whether fiat or cryptocurrency, using values from `CurrencyTypeEnum`. Defaults to fiat currency.
     * - `transaction_type`: Type of transaction, using values from `TransactionTypeEnum`.
     * - `transaction_method`: Method of the transaction, using values from `TransactionMethodEnum`.
     * - `status`: Status of the transaction, using values from `TransactionStatusEnums`. Defaults to active.
     * - `timestamps`: Created at and updated at timestamps.
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('laravel-virtual-wallet.tables.transactions'), function (Blueprint $table) {
            $table->id();
            $table->morphs('owner'); // Polymorphic relationship for the owner of the transaction.
            $table->nullableMorphs('owner_from'); // Polymorphic relationship for the source of the transaction (nullable).
            $table->string('txid', 255)->unique(); // Unique transaction identifier.
            $table->decimal('amount', 16, 2)->default(0); // Amount involved in the transaction.
            $table->text('description')->nullable(); // Description of the transaction.
            $table->tinyInteger('is_hidden')->default(0); // Is Hidden Transaction (0 = false, 1 = true) for the system.
            $table->enum('wallet_type', WalletTypeEnum::values()); // Type of wallet (enum values).
            $table->enum('currency', CurrencyEnum::values())->default(CurrencyEnum::USD->value); // Currency of the transaction (enum values).
            $table->enum('currency_type', CurrencyTypeEnum::values())->default(CurrencyTypeEnum::FIAT_CURRENCY->value); // Type of currency (enum values).
            $table->enum('transaction_type', TransactionTypeEnum::values()); // Type of transaction (enum values).
            $table->enum('transaction_method', TransactionMethodEnum::values()); // Method of transaction (enum values).
            $table->enum('status', TransactionStatusEnum::values())->default(TransactionStatusEnum::APPROVED->value); // Status of the transaction (enum values).
            $table->timestamps(); // Created at and updated at timestamps.
        });
    }

    /**
     * Reverse the migrations to drop the 'wallet_transactions' table.
     * 
     * This method drops the 'wallet_transactions' table if it exists.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(config('laravel-virtual-wallet.tables.transactions'));
    }
};
