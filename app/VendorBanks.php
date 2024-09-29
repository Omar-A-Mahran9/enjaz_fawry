<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorBanks extends Model 
{

    protected $table = 'vendor_banks';
    public $timestamps = true;
    //protected $fillable = array('user_id', 'name');


    public function user()
    {
        return $this->BelongsTo('App\User', 'id', 'user_id');
    }

}
