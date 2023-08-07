<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Encore\Admin\Facades\Admin;
use App\Models\AdminRoleUser;

class SaccoMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'sacco_id',
        'user_id',
        'full_name',
        'date_of_birth',
        'gender',
        'image',
        'nationality',
        'identification_number',
        'physical_address',
        'postal_address',
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
        'status',
        'password',
    ];

    public function sacco()
    {
        return $this->belongsTo(Sacco::class);
    }
   //callback before saving, to has a unique id
    public static function boot()
    {
         parent::boot();
         self::creating(function ($model) {

 
        if(Admin::user()->isRole('sacco')){
        //add a sacco member to the users table
            $member = new User();
            $member->password = Hash::make('password');
            $member->name = $model->full_name;
            $member->username = $model->full_name;
            $member->email = $model->email;
            $member->save();

        }
        });

         self::created(function ($model){
        //give the member the sacco-member  role of 3
            $member = User::where('email', $model->email)->first();
            $new_role = new AdminRoleUser();
            $new_role->user_id = $member->id;
            $new_role->role_id = 3;
            $new_role->save();

            $model->user_id = $member->id;
            $model->save();

         });

         self::updating(function ($model) {
         
           
        });

        self::updated(function ($model){
        //give the member the sacco-member  role of 3 after they have been accepted
        if($model->status == 'accepted'){
                AdminRoleUser::where([
                    'user_id' => $model->user_id
                ])->delete();
            $new_role = new AdminRoleUser();
            $new_role->user_id = $model->user_id;
            $new_role->role_id = 3;
            $new_role->save();
        }
        });
   
        
    }
}
