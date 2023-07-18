<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdminRoleUser;
use Illuminate\Support\Facades\Hash;



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

    public function members()
    {
        return $this->hasMany(SaccoMember::class);
    }

    //boot method to save the sacco in the users table
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {

            $sacco = new User();
            //create a password of 8 characters
         
            $sacco->password = Hash::make('password');
            $sacco->name = $model->name;
            $sacco->username = $model->name;
            $sacco->email = $model->email;
            $sacco->save();

        });

        self::created(function ($model){
            $sacco = User::where('email', $model->email)->first();
            // //create the sacco role
            $new_role = new AdminRoleUser();
            $new_role->user_id = $sacco->id;
            $new_role->role_id = 4;
            $new_role->save();
        });
        
    }
    
}
