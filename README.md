# 💳 Laravel Virtual Wallet

A lightweight, plug-and-play Laravel package for managing virtual wallets, supporting multiple wallet types, transaction logs, and seamless integration with any model like User.

## 🚀 Features

- **💼 Multi-Wallet Support** — Create and manage multiple wallet types per user.
- **📜 Transaction Logs** — All wallet operations are recorded for full traceability.
- **🔐 Secure & Reliable** — Built using Laravel's Eloquent, enums, morphs & policy-friendly structure.
- **⚙️ Highly Configurable** — Override models, table names, and more via config.
- **🧩 Easy Integration** — Just use a trait on your model and you're ready to go.
- **💸 Balance Management** — Simple credit, debit, transfer, and balance APIs.

## 📦 Installation

```bash
composer require haxneeraj/laravel-virtual-wallet
php artisan vendor:publish --provider="Haxneeraj\LaravelVirtualWallet\LaravelVirtualWalletServiceProvider"
php artisan migrate
```

## 🧑‍💻 Setup in Model

```bash
use Haxneeraj\LaravelVirtualWallet\Interfaces\WalletInterface;
use Haxneeraj\LaravelVirtualWallet\Traits\HasVirtualWallet;

class User extends Authenticatable implements WalletInterface
{
    use HasVirtualWallet;
}
```

## 🔗 Links

- **🧠 Author**: Neeraj Saini
- **🛠️ GitHub**: [github.com/haxneeraj/laravel-virtual-wallet](https://github.com/haxneeraj/laravel-virtual-wallet)
- **📩 Email**: [hax-neeraj@outlook.com](mailto:hax-neeraj@outlook.com)
- **📝 License**: Licensed under the MIT License.
