# Trait for convenient use of ENUM in PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kongulov/interact-with-enum?style=flat-square)](https://packagist.org/packages/kongulov/interact-with-enum)
![Licence](https://img.shields.io/github/license/kongulov/interact-with-enum?style=flat-square)
[![Total Downloads](https://poser.pugx.org/kongulov/interact-with-enum/downloads?format=flat-square)](https://packagist.org/packages/kongulov/interact-with-enum)

This package contains the `InteractWithEnum.php` trait, which you can use to conveniently work with ENUMs.

## Requirements

- `php: >=8.1`

## Installation

Install the package via Composer:

```bash
# Install interact-with-enum
composer require kongulov/interact-with-enum
```

## Usage

Imagine you have ENUM `StatusEnum.php` where we already use the `InteractWithEnum` trait:

```php
<?php

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;

enum StatusEnum: string {
    use InteractWithEnum;

    case Pending = 'pending';
    case Active = 'active';
    case Inactive = 'inactive';
}
```

### After using the trait, you can call methods:

* **names()**
```php
StatusEnum::names()
```
Return:
<pre>
array:3 [
  0 => "Pending"
  1 => "Active"
  2 => "Inactive"
]
</pre>

* **values()**
```php
StatusEnum::values()
```
Return:
<pre>
array:3 [
  0 => "pending"
  1 => "active"
  2 => "inactive"
]
</pre>

* **array()**
```php
StatusEnum::array()
```
Return:
<pre>
array:3 [
  "pending" => "Pending"
  "active" => "Active"
  "inactive" => "Inactive"
]
</pre>

* **find($needle)**
```php
StatusEnum::find('Active') // Find by name
StatusEnum::find('active') // Find by value
```
Return:
<pre>
App\Enums\StatusEnum {
  name: "Active"
  value: "active"
}
</pre>