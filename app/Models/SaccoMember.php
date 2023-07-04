<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\SaccoUser;
class SaccoMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'date_of_birth',
        'gender',
        'image',
        'nationality',
        'identification_number',
        'physical_address',
        'email',
        'phone_number',
        'employment_status',
        'employer_name',
        'monthly_income',
        'bank_account_number',
        'bank_name',
        'membership_type',
        'membership_id',
        'date_of_joining',
        'next_of_kin_name',
        'next_of_kin_contact',
        'beneficiary_name',
        'beneficiary_relationship',
        'password',
    ];

    public function sacco()
    {
        return $this->hasMany(SaccoUser::class);
    }
   //callback before saving, to has a unique id
    public static function boot()
    {
         parent::boot();
         self::creating(function ($model) {
              $model->password = bcrypt($model->password);
         });
    }
}
