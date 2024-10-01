<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_order extends Model
{
   
    protected $table = 'contact_orders';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'service_id',"service");

    public function serviceOrder(){
 
        return $this->belongsTo('App\Service', 'service_id', 'id');
        
    }
}
