<?php 

namespace Haxneeraj\LaravelVirtualWallet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Exceptions\InvalidWalletException;
use Illuminate\Support\Facades\DB;


class WalletTransaction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * The table name is dynamically set via the configuration file for
     * the virtual wallet package.
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     * 
     * These fields can be filled via mass assignment using
     * methods like `create()` or `update()`.
     */
    protected $fillable = [
        'owner_type',
        'owner_id',
        'txid',
        'amount',
        'description',
        'wallet_type',
        'currency',
        'currency_type',
        'transaction_type',
        'transaction_method',
        'status',
    ];
    

    /**
     * The attributes that aren't mass assignable.
     * 
     * Preventing 'id' from being overwritten during mass assignment.
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     * 
     * These fields will be cast to specific enumerated types.
     */
    protected $casts = [];

    /**
     * Class constructor.
     * 
     * Set the table name dynamically from the configuration file.
     * The config file 'laravel-virtual-wallet' contains the table names, and here
     * we're setting the table to the value specified for 'transactions'.
     */
    public function __construct(array $attributes = [])
    {
        $this->table = config('laravel-virtual-wallet.tables.transactions');

        // Call the parent constructor
        parent::__construct($attributes);


        // Set Casts
        $this->casts = array_merge($this->casts, [
            'wallet_type' => resolve_wallet_enum('wallet_type'),
            'currency' => resolve_wallet_enum('currency'),
            'currency_type' => resolve_wallet_enum('currency_type'),
            'transaction_type' => resolve_wallet_enum('transaction_type'),
            'transaction_method' => resolve_wallet_enum('transaction_method'),
            'status' => resolve_wallet_enum('transaction_status'),
        ]);
    }

    /**
     * Get the owning model of the transaction.
     * 
     * Defines a polymorphic relationship where the owner of the transaction
     * can be of any model type (e.g., User, Vendor, etc.).
     */
    public function owner(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the source of the transaction (if any).
     * 
     * Defines a polymorphic relationship for the source of the transaction.
     * This can represent the model that initiated the transaction.
     */
    public function ownerFrom(): MorphTo
    {
        return $this->morphTo('owner_from');
    }    
}
