<?php

namespace Haxneeraj\LaravelVirtualWallet\Tests;

use Haxneeraj\LaravelVirtualWallet\Models\Wallet;
use Haxneeraj\LaravelVirtualWallet\Tests\Models\User;

use Haxneeraj\LaravelVirtualWallet\DataObjects\PaymentData;

use Illuminate\Foundation\Testing\RefreshDatabase;

class LaravelVirtualWalletTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $wallet1;
    protected $wallet2;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user once before each test
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('secret'),
        ]);

        // Step 2: Assign wallets (for example: MAIN and BONUS)
        $this->wallet1 = $this->user->wallets()->create([
            'wallet_type' => 'wallet1',
            'balance' => 0,
            'currency' => 'usd',
            'currency_type' => 'fiat_currency',
        ]);

        $this->wallet2 = $this->user->wallets()->create([
            'wallet_type' => 'wallet2',
            'balance' => 0,
            'currency' => 'usd',
            'currency_type' => 'fiat_currency',
        ]);  
    }

    /** @test */
    public function it_can_create_user(): void
    {
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    /** @test */
    public function it_can_assign_wallets_to_user(): void
    {
        // Step 1: Get the user we seeded earlier
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);              

        // Step 3: Assertions
        $this->assertEquals(2, $this->user->wallets()->count());
        $this->assertTrue($this->user->wallets->contains($this->wallet1));
        $this->assertTrue($this->user->wallets->contains($this->wallet2));
    }

    /** @test */
    public function it_can_deposit_to_user_wallet(): void
    {
        // Step 1: Get the user
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
        $this->assertDatabaseHas('wallets', ['owner_id' => $this->user->id]);


        // Step 2: Deposit to the wallet
        $paymentData = new PaymentData([
            'owner_type' => User::class,
            'owner_id' => $this->user->id,
            'txid' => 'test-txid',
            'amount' => 100,
            'description' => 'Test deposit',
            'wallet_type' => 'wallet1',
            'method' => 'automatic',
            'transaction_type' => 'deposit',
            'status' => 'approved',
            'currency' => 'usd',
            'currency_type' => 'fiat_currency'
        ]);
        $this->user->deposit($paymentData);

        // Step 3: Assertions
        $this->assertEquals(100, $this->user->getBalance('wallet1'));

        // Step 4: Deposit to the wallet2
        $paymentData = new PaymentData([
            'owner_type' => User::class,
            'owner_id' => $this->user->id,
            'txid' => 'test-txid2',
            'amount' => 100,
            'description' => 'Test deposit',
            'wallet_type' => 'wallet2',
            'method' => 'automatic',
            'transaction_type' => 'deposit',
            'status' => 'approved',
            'currency' => 'usd',
            'currency_type' => 'fiat_currency'  
        ]);

        $this->user->deposit($paymentData);

        // Step 5: Assertions
        $this->assertEquals(100, $this->user->getBalance('wallet2'));
    }

    public function it_can_withdraw_from_user_wallet(): void
    {
        // Step 1: Get the user
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);

        // Step 2: Withdraw from the wallet
        $paymentData = new PaymentData([
            'owner_type' => User::class,
            'owner_id' => $this->user->id,
            'txid' => 'test-txid-withdraw1',
            'amount' => 50,
            'description' => 'Test withdrawal', 
            'wallet_type' => 'wallet1',
            'method' => 'automatic',
            'transaction_type' => 'withdraw',
            'status' => 'approved',
            'currency' => 'usd',
            'currency_type' => 'fiat_currency'
        ]);

        $this->user->pay($paymentData);

        // Step 3: Assertions
        $this->assertEquals(50, $this->user->wallets('wallet1')->balance);

        // Step 4: Withdraw from the wallet2
        $paymentData = new PaymentData([
            'owner_type' => User::class,
            'owner_id' => $this->user->id,
            'txid' => 'test-txid-withdraw2',
            'amount' => 50,
            'description' => 'Test withdrawal',
            'wallet_type' => 'wallet2',
            'method' => 'automatic',
            'transaction_type' => 'withdraw',
            'status' => 'approved',
            'currency' => 'usd',
            'currency_type' => 'fiat_currency' 
        ]);

        $this->user->pay($paymentData);

        // Step 5: Assertions
        $this->assertEquals(50, $this->user->wallets('wallet2')->balance); 
    }

    public function it_can_show_wallet_balance(): void 
    {
        // Step 1: Get the user
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);

        // Step 2: Get the wallet balance
        $checkBalance = $this->user->hasBalance('wallet1');
        $this->assertTrue($checkBalance);

        $walletBalance = $this->user->getBalance('wallet1');

        // Step 3: Assertions
        $this->assertEquals(50, $walletBalance);

        // Step 4: Get the wallet balance
        $checkBalance = $this->user->hasBalance('wallet1');
        $this->assertTrue($checkBalance);

        $walletBalance = $this->user->getBalance('wallet2');

        // Step 5: Assertions
        $this->assertEquals(50, $walletBalance);
    }

    public function user_has_sufficient_balance(): void
    {
        // Step 1: Get the user
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);

        // Step 2: Check if the user has sufficient balance
        $checkBalance = $this->user->hasSufficientBalance(100);
        $this->assertTrue($checkBalance);

        $checkBalance = $this->user->hasSufficientBalance(50, 'wallet1');
        $this->assertTrue($checkBalance);

        $checkBalance = $this->user->hasSufficientBalance(50, 'wallet2');
        $this->assertTrue($checkBalance);

        // Check for false 
        $checkBalance = $this->user->hasSufficientBalance(101);
        $this->assertFalse($checkBalance);

        $checkBalance = $this->user->hasSufficientBalance(51, 'wallet1');
        $this->assertFalse($checkBalance);

        $checkBalance = $this->user->hasSufficientBalance(51, 'wallet2');
        $this->assertFalse($checkBalance);
    }

    public function it_can_fetch_transactions(): void
    {
        // Step 1: Get the user
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);

        // Step 2: Get the transactions
        $transactions = $this->user->transactions;

        // Step 3: Assertions
        $this->assertCount(4, $transactions);
    }
}
