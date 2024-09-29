<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\PasswordReset as ResetPasswordNotification;

use Laravel\Passport\HasApiTokens;


// use Illuminate\Support\Facades\PasswordReset;

class User extends Authenticatable
{

    use SoftDeletes;
    use HasApiTokens, Notifiable;
    protected $dates = ['deleted_at'];

    public function estfsar_orders()
    {
        return $this->hasMany('App\Order_estfsar');
    }

    public function mo3amla_orders()
    {
        return $this->hasMany('App\Order_mo3amla');
    }

    public function user_did_reviwes()
    {
        return $this->hasMany('App\Review',  'client_id');
    }

    public function vendor_has_reviwes()
    {
        return $this->hasMany('App\Review',  'vendor_id');
    }

    public function balance()
    {
        return $this->hasMany('App\Balance', 'vendor_id');
    }

    public function vendor_withdrawal()
    {
        return $this->hasMany('App\Withdrawal', 'vendor_id');
    }

    public function ta3med_orders()
    {
        return $this->hasMany('App\Order_ta3med');
    }

    public function guarante_orders()
    {
        return $this->hasMany('App\Order_guarante');
    }

    public function banks()
    {
        return $this->hasMany('App\VendorBanks');
    }

    public function processMo3ala()
    {
        return $this->hasMany('App\Mo3amlaProcessing');
    }


    public function scopeIdDescending($query)
    {
            return $query->orderBy('id','DESC');
    }   

    // public function mo3amlaProcessing()
    // {
    //     return $this->belongsToMany('App\Order_mo3amla');
    // }



    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 
        'verification_code', 'type', 'identity_no', 
        'status', 'identity_file', 'identity_status', 'mail_token', 'firebase_token', 'phone_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'phone_verified_at' => 'datetime',
    ];

    // public function hasVerifiedPhone()
    // {
    //     return ! is_null($this->phone_verified_at);
    // }

    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
            'phone_status' => 1,
        ])->save();
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function findForPassport($identifier) {
        return $this->orWhere('phone', $identifier)->first();
    }

    public function reviews()
    {
        return $this->hasMany('App\Review', 'vendor_id');
    }

    public function mo3amlat()
    {
        return $this->hasMany('App\Order_mo3amla', 'user_id');
    }
    
}
