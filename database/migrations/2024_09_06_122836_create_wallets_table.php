<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            
            $table->enum('wallet_type', resolve_wallet_enum('wallet_type')::values());
            $table->enum('currency', resolve_wallet_enum('currency')::values())
                  ->default(resolve_wallet_enum('currency')::USD->value);
            $table->enum('currency_type', resolve_wallet_enum('currency_type')::values())
                  ->default(resolve_wallet_enum('currency_type')::FIAT_CURRENCY->value);
            $table->enum('status', resolve_wallet_enum('wallet_status')::values())
                  ->default(resolve_wallet_enum('wallet_status')::ACTIVE->value);
        
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
