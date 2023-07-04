<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'member_id',
        'transaction_type',
        'amount',
        'status',
        'comment',
        'date',
    ];

    public function sacco_member()
    {
        return $this->belongsTo(SaccoMember::class);
    }
}
