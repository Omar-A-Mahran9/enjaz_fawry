<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mo3amlaProcessing extends Model
{
    //

    protected $table = 'mo3amla_processing';
    public $timestamps = true;


    public function userz()
    {
        return $this->belongsTo('App\User','user_id', 'id');
    }

    public function mo3amla()
    {
        return $this->belongsTo('App\Order_mo3amla', 'mo3amla_id', 'id');
    }
    
}
