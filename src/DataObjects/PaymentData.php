<?php

namespace Haxneeraj\LaravelVirtualWallet\DataObjects;

class PaymentData
{
    public $owner_type;
    public $owner_id;
    public $txid;
    public $amount;
    public $description = null;
    public $wallet_type;
    public $method;
    public $transaction_type;
    public $status;
    public $currency;
    public $currency_type;

    // Constructor that accepts an optional array of properties
    public function __construct(array $data = [])
    {
        $this->setData($data);
    }

    // Setters for each property using fluent interface (method chaining)
    public function setOwnerType($owner_type): self
    {
        $this->owner_type = $owner_type;
        return $this;
    }

    public function setOwnerId($owner_id): self
    {
        $this->owner_id = $owner_id;
        return $this;
    }

    public function setTxid($txid): self
    {
        $this->txid = $txid;
        return $this;
    }

    public function setAmount($amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setWalletType($wallet_type): self
    {
        $this->wallet_type = $wallet_type;
        return $this;
    }


    public function setMethod($method): self
    {
        $this->method = $method;
        return $this;
    }

    public function setStatus($status): self
    {
        $this->status = $status;
        return $this;
    }

    public function setCurrency($currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function setCurrencyType($currency_type): self
    {
        $this->currency_type = $currency_type;
        return $this;
    }

    public function setTransactionType($transaction_type): self
    {
        $this->transaction_type = $transaction_type;
        return $this;
    }

    // Method to set all properties from an associative array
    public function setData(array $data): self
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
        return $this;
    }
}
