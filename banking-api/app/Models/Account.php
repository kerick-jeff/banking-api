<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'account_type',
        'customer_id',
        'branch_code',
        'balance',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function deposit($amount)
    {
        $this->balance += $amount;
        $this->save();
    }

    public function withdraw($amount)
    {
        $this->balance -= $amount;
        $this->save();
    }

    public function transfer($amount, $account)
    {
        $this->withdraw($amount);
        $account->deposit($amount);
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function getAccountNumber()
    {
        return $this->account_id;
    }

    public function getAccountType()
    {
        return $this->account_type;
    }

    
}
