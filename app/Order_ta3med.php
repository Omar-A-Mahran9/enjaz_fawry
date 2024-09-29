<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_ta3med extends Model
{
    //
    
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function orderUser()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function processing()
    {
        return $this->hasOne('App\Status', 'id', 'processing_id');
    }

    public function bank()
    {
        return $this->hasOne('App\Bank', 'id', 'bank_id');
    }
}
