<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit26526dc2f2e3f90f1f2466c9950aaa65
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kongulov\\Traits\\' => 16,
        ),
        'H' => 
        array (
            'Haxneeraj\\LaravelVirtualWallet\\' => 31,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kongulov\\Traits\\' => 
        array (
            0 => __DIR__ . '/..' . '/kongulov/interact-with-enum/src',
        ),
        'Haxneeraj\\LaravelVirtualWallet\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit26526dc2f2e3f90f1f2466c9950aaa65::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit26526dc2f2e3f90f1f2466c9950aaa65::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit26526dc2f2e3f90f1f2466c9950aaa65::$classMap;

        }, null, ClassLoader::class);
    }
}
