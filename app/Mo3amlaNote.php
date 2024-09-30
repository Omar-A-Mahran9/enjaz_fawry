<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mo3amlaNote extends Model
{
    //
    protected $table = 'mo3amla_notes';

    public function mo3amla()
    {
        return $this->belongsTo('App\Order_mo3amla', 'mo3amla_id', 'id');
    }
}

