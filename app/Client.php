<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable;


    protected $guard = 'client';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'verification_code', 'type',
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
    // protected $casts = [
    //     'phone_verified_at' => 'datetime',
    // ];


    public function hasVerifiedPhone()
    {
        return ! is_null($this->phone_verified_at);
    }

    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function callToVerify()
    {
        //$code = random_int(100000, 999999);
        $code = 0000;
        
        $this->forceFill([
            'verification_code' => $code
        ])->save();

        // $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        // $client->calls->create(
        //     $this->phone,
        //     "+15306658566", // REPLACE WITH YOUR TWILIO NUMBER
        //     ["url" => "http://your-ngrok-url>/build-twiml/{$code}"]
        // );
    }

    
}
