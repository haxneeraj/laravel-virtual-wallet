<?php

// Author: Neeraj Saini
// Email: hax-neeraj@outlook.com
// GitHub: https://github.com/haxneeraj/
// LinkedIn: https://www.linkedin.com/in/hax-neeraj/

namespace Haxneeraj\LaravelVirtualWallet;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class LaravelVirtualWalletServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Register any services or bindings if needed in the future
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Load the package's resources (config, translations, migrations, enums)
        $this->addConfigFiles();
        $this->addTranslations();
        $this->addMigrations();
        $this->addEnums();
    }

    /**
     * Register the package's configuration files.
     *
     * @return void
     */
    private function addConfigFiles(): void
    {
        // Make the config file publishable to allow users to modify it in their app
        $this->publishes([
            __DIR__ . '/../config/laravel-virtual-wallet.php' => config_path('laravel-virtual-wallet.php'),
        ], 'config');
    }

    /**
     * Load and publish the package's translation files.
     *
     * @return void
     */
    private function addTranslations(): void
    {
        // Rename Migrations Before Publish
        $this->renameMigrations();

        // Load translations for use by the package
        // $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'LaravelVirtualWallet');

        // Make the translations publishable so they can be modified by the user
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/haxneeraj/laravel-virtual-wallet/lang'),
        ], 'lang');
    }

    /**
     * Load and publish the package's migration files.
     *
     * @return void
     */
    private function addMigrations(): void
    {
        // Make migrations publishable so they can be modified or customized
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'migrations');
    }

    /**
     * Publish the package's enums.
     *
     * @return void
     */
    private function addEnums(): void
    {
        // Make enums publishable so they can be customized by the user
        $this->publishes([
            __DIR__ . '/../enums' => app_path('Enums'),
        ], 'enums');
    }

    public function renameMigrations()
    {
        $migrationPath = __DIR__ . '/../database/migrations';
        $datePrefix = now()->format('Y_m_d_His') . '_';
        $datePattern = '/^\d{4}_\d{2}_\d{2}_\d{6}_/';

        $files = File::files($migrationPath);

        foreach ($files as $file) {
            $fileName = $file->getFilename();

            // Skip renaming if the filename already starts with a date prefix
            if (preg_match($datePattern, $fileName)) {
                continue;
            }

            $newName = $datePrefix . $fileName;

            if ($fileName !== $newName) {
                File::move($file->getPathname(), $file->getPath() . '/' . $newName);
            }
        }
    }
}