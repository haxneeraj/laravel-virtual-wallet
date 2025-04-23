<?php

namespace Haxneeraj\LaravelVirtualWallet\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use Haxneeraj\LaravelVirtualWallet\Exceptions\InvalidWalletException;

/**
 * Trait WalletTransactionTrait
 *
 * Provides methods to handle wallet transactions for models.
 *
 * @package haxneeraj\laravel-virtual-wallet
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 * @version 1.0.0
 * @license MIT
 */
trait WalletTransactionTrait
{
    /**
     * Define a polymorphic one-to-many relationship with the wallet transaction model.
     *
     * Optionally allows filtering by wallet type.
     *
     * @param string|null $walletType The wallet type to filter by (optional).
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     *
     * @throws InvalidWalletException If the wallet type is invalid.
     */
    public function transactions(string $walletType = null): MorphMany
    {
        $query = $this->morphMany($this->walletTransactionModelClass(), 'owner');

        if (!empty($walletType)) {
            if (!in_array($walletType, resolve_wallet_enum('transaction_type')::values())) {
                throw new InvalidWalletException();
            }
            $query->where('wallet_type', $walletType);
        }

        return $query;
    }

    /**
     * Get paginated wallet transactions with optional filters.
     *
     * Applies wallet type filtering, date range filtering, and sorting.
     *
     * @param string|null $walletType The wallet type to filter by (optional).
     * @param int $perPage Number of records per page (default: 20).
     * @param int $page Current page number (default: 1).
     * @param array $dateRange Optional date range (e.g., ['from_date' => 'YYYY-MM-DD', 'to_date' => 'YYYY-MM-DD']).
     * @param string $sortBy Column name to sort by (default: 'id').
     * @param string $sortOrder Sort direction: 'asc' or 'desc' (default: 'desc').
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     *
     * @throws InvalidWalletException If the wallet type is invalid.
     */
    public function paginatedTransactions(
        string $walletType = null,
        int $perPage = 20,
        int $page = 1,
        array $dateRange = [],
        string $sortBy = 'id',
        string $sortOrder = 'desc'
    ):LengthAwarePaginator
     {
        $query = $this->transactions($walletType);

        if (!empty($dateRange['from_date']) && !empty($dateRange['to_date'])) {
            $query->whereBetween('created_at', [$dateRange['from_date'], $dateRange['to_date']]);
        }

        return $query->orderBy($sortBy, $sortOrder)->paginate($perPage, ['*'], 'page', $page);
    }
}