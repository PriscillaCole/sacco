<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaccoUser extends Model
{
    use HasFactory;

    protected $table = 'sacco_users';

    protected $fillable = [
        'sacco_member_id',
        'sacco_id',
    ];

    public function member()
    {
        return $this->belongsTo(SaccoMember::class);
    }

    public function sacco()
    {
        return $this->belongsTo(Sacco::class);
    }
}

