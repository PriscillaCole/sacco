<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'sacco_id',
        'address',
        'city',
        'tin',
        'loan_amount',
        'purpose',
        'guarantor',   
        'source_of_repayment',
        'picture_id',
        'are_you_a_member',
        'collateral_description',
        'term_required',
        'status',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sacco()
    {
        return $this->belongsTo(Sacco::class);
    }


}
