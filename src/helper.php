<?php

if (!function_exists('resolve_wallet_enum')) {
    function resolve_wallet_enum(string $key): string
    {
        $enumClass = config("laravel-virtual-wallet.enums.$key");

        // 1. Check if class exists
        if (!class_exists($enumClass)) {
            throw new \InvalidArgumentException("Enum class [$enumClass] does not exist.");
        }

        // 2. Check if values() method exists
        if (!method_exists($enumClass, 'values')) {
            throw new \BadMethodCallException("Method values() does not exist in enum class [$enumClass].");
        }

        // 3. Return class if valid
        return $enumClass;
    }
}
