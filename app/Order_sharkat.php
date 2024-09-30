<?php

namespace App;
use App\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_sharkat extends Model
{   

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'order_sharkat';

    public function processing()
    {
        return $this->hasOne('App\Status', 'id', 'processing_id');
    }

    public function city()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }
    
}
