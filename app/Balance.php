<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    //

 
    public function order()
    {
        return $this->belongsTo('App\Order_mo3amla', 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'vendor_id', 'id');
    }

    public function withdraw()
    {
        return $this->belongsTo('App\Withdrawal', 'withdraw_id', 'id');
    }
}
