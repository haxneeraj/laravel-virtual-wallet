<?php

use Illuminate\Support\Facades\Schema;
use Haxneeraj\LaravelVirtualWallet\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class DatabaseSetupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_connect_and_seed_user()
    {
        // ✅ Step 1: Check DB connection
        $this->assertTrue(DB::connection()->getPdo() !== null, 'Database connection failed');

        // ✅ Step 2: Tables exist
        $this->assertTrue(Schema::hasTable('users'), 'Users table not found');
        $this->assertTrue(Schema::hasTable(config('laravel-virtual-wallet.tables.wallets')), 'Wallets table not found');
        $this->assertTrue(Schema::hasTable(config('laravel-virtual-wallet.tables.transactions')), 'Transactions table not found');

        // ✅ Step 3: Insert a test user
        $user = \Haxneeraj\LaravelVirtualWallet\Tests\Models\User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('secret'),
        ]);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);

        // ✅ Step 4: RefreshDatabase auto-cleans up after test
        
    }
}
