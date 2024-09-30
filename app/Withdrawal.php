<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    //

 
    public function user()
    {
        return $this->belongsTo('App\User', 'vendor_id', 'id');
    }

    // public function user()
    // {
    //     return $this->belongsTo('App\User', 'vendor_id', 'id');
    // }
    public function balance()
    {
        return $this->hasMany('App\Balance', 'withdraw_id');
    }
}
