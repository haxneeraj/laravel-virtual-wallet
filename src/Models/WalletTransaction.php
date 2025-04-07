<?php 

namespace Haxneeraj\LaravelVirtualWallet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Enums\WalletTypeEnum;
use App\Enums\CurrencyEnum;
use App\Enums\CurrencyTypeEnum;
use App\Enums\TransactionTypeEnum;
use App\Enums\TransactionMethodEnum;
use App\Enums\TransactionStatusEnum;

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
    protected $casts = [
        'wallet_type' => WalletTypeEnum::class,  // Casting wallet_type to WalletTypeEnum
        'currency' => CurrencyEnum::class,      // Casting currency to CurrencyEnums
        'currency_type' => CurrencyTypeEnum::class, // Casting currency_type to CurrencyTypeEnum
        'transaction_type' => TransactionTypeEnum::class,  // Casting transaction_type to TransactionTypeEnum
        'transaction_method' => TransactionMethodEnum::class,  // Casting transaction_method to TransactionMethodEnum
        'status' => TransactionStatusEnum::class,  // Casting status to TransactionStatusEnums
    ];

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

    /**
     * Define a one-to-one relationship with WalletCryptoTransaction.
     * 
     * This links a transaction to its corresponding crypto transaction.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cryptoTransaction(): HasOne
    {
        return $this->hasOne(WalletCryptoTransaction::class, 'wallet_transaction_id', 'id');
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_type', 'wallet_type');
    }
}
