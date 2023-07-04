<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sacco extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'physical_address',
        'email',
        'phone_number',
        'bank_account_number',
        'mobile_money_number',
        'sacco_license'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function savings()
    {
        return $this->hasMany(Saving::class);
    }

    public function member()
    {
        return $this->hasMany(SaccoUser::class);
    }

    
}
