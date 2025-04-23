<?php 

namespace Haxneeraj\LaravelVirtualWallet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Wallet extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * Laravel will automatically use the table name specified here.
     * In this case, the table name is dynamically set via the configuration
     * file for the virtual wallet package.
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     * 
     * These are the fields that can be filled via mass assignment
     * (e.g., using the `create()` or `update()` methods).
     */
    protected $fillable = [
        'owner_type',
        'owner_id',
        'balance',
        'wallet_type',
        'currency',
        'currency_type',
        'status',
    ];

    /**
     * The attributes that aren't mass assignable.
     * 
     * The `id` field is guarded to prevent it from being overwritten during
     * mass assignment.
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     * 
     * This ensures that these fields are cast to specific enumerated types
     * when retrieved from the database.
     */
    protected $casts = [];

    /**
     * Class constructor.
     * 
     * Set the table name dynamically from the configuration file.
     * The config file 'laravel-virtual-wallet' contains the table names, and here
     * we're setting the table to the value specified for 'wallets'.
     */
    public function __construct(array $attributes = [])
    {
        // Set the table name using the config setting
        $this->table = config('laravel-virtual-wallet.tables.wallets');

        // Call the parent constructor
        parent::__construct($attributes);

        // Set Casts
        $this->casts = array_merge($this->casts, [
            'wallet_type' => resolve_wallet_enum('wallet_type'),
            'status' => resolve_wallet_enum('wallet_status'),
            'currency' => resolve_wallet_enum('currency'),
            'currency_type' => resolve_wallet_enum('currency_type'),
        ]);
    }

    /**
     * Get the owning model of the wallet.
     * 
     * This defines a polymorphic relationship between the Wallet and its owner.
     * The owner can be any model that "owns" a wallet, allowing flexibility in 
     * associating the wallet with different models (e.g., User, Company).
     */
    public function owner(): MorphTo
    {
        return $this->morphTo();
    }

    public function hasBalance(): bool
    {
        return $this->balance > 0;
    }
}
