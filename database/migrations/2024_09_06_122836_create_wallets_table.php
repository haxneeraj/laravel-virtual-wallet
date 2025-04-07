<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\WalletTypeEnum;
use App\Enums\WalletStatusEnum;
use App\Enums\CurrencyEnum;
use App\Enums\CurrencyTypeEnum;

return new class () extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create(config('laravel-virtual-wallet.tables.wallets'), function (Blueprint $table) {
            $table->id();
            $table->morphs('owner'); 
            $table->decimal('balance', 16, 2)->default(0);   
            $table->enum('wallet_type', WalletTypeEnum::values());
            $table->enum('currency', CurrencyEnum::values())->default(CurrencyEnum::USD->value);
            $table->enum('currency_type', CurrencyTypeEnum::values())->default(CurrencyTypeEnum::FIAT_CURRENCY->value);
            $table->enum('status', WalletStatusEnum::values())->default(WalletStatusEnum::ACTIVE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('laravel-virtual-wallet.tables.wallets'));
    }
};
