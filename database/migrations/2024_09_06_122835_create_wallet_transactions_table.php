<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {    
    public function up(): void
    {
        Schema::create(config('laravel-virtual-wallet.tables.transactions'), function (Blueprint $table) {
            $table->id();
            $table->morphs('owner'); 
            $table->nullableMorphs('owner_from');
            $table->string('txid', 255)->unique();
            $table->decimal('amount', 16, 2)->default(0);
            $table->text('description')->nullable();
            $table->tinyInteger('is_hidden')->default(0);
        
            $table->enum('wallet_type', resolve_wallet_enum('wallet_type')::values());
            $table->enum('currency', resolve_wallet_enum('currency')::values())
                  ->default(resolve_wallet_enum('currency')::USD->value);
            $table->enum('currency_type', resolve_wallet_enum('currency_type')::values())
                  ->default(resolve_wallet_enum('currency_type')::FIAT_CURRENCY->value);
            $table->enum('transaction_type', resolve_wallet_enum('transaction_type')::values());
            $table->enum('transaction_method', resolve_wallet_enum('transaction_method')::values());
            $table->enum('status', resolve_wallet_enum('transaction_status')::values())
                  ->default(resolve_wallet_enum('transaction_status')::APPROVED->value);
        
            $table->timestamps();
        });        
    }
    
    public function down(): void
    {
        Schema::dropIfExists(config('laravel-virtual-wallet.tables.transactions'));
    }
};
