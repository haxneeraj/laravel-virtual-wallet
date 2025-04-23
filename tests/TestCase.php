<?php

namespace Haxneeraj\LaravelVirtualWallet\Tests;

use Haxneeraj\LaravelVirtualWallet\LaravelVirtualWalletServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    public function getEnvironmentSetUp($app)
    {
        config()->set('app.key', 'base64:EWcFBKBT8lKlGK8nQhTHY+wg19QlfmbhtO9Qnn3NfcA=');

        config()->set('database.default', 'testing');

         // Merge your package config manually
        $app['config']->set(
            'laravel-virtual-wallet',
            require __DIR__ . '/config/laravel-virtual-wallet.php'
        );

        $migration = include __DIR__.'/database/migrations/create_users_table.php';
        $migration->up();

        $migration = include __DIR__.'/../database/migrations/2024_09_06_122836_create_wallets_table.php';
        $migration->up();

        $migration = include __DIR__.'/../database/migrations/2024_09_06_122835_create_wallet_transactions_table.php';
        $migration->up();
    }

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Haxneeraj\\LaravelVirtualWallet\\Tests\\Database\\Factories\\'.class_basename(
                $modelName
            ).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelVirtualWalletServiceProvider::class,
        ];
    }
}