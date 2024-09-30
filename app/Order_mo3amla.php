<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_mo3amla extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'order_mo3amlas';

    public function orderUser()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function city()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }

   public function service()
    {
        return $this->hasOne('App\Service', 'id', 'service_id')->withTrashed();
    }

    // public function subService()
    // {
    //     return $this->hasOne('App\SubService', 'id', 'subservice_id');
    // }

    public function processing()
    {
        return $this->hasOne('App\Status', 'id', 'processing_id');
    }

    public function bank()
    {
        return $this->hasOne('App\Bank', 'id', 'bank_id');
    }

    public function processMo3ala()
    {
        return $this->hasMany('App\Mo3amlaProcessing', 'mo3amla_id', 'id');
    }

    public function notes()
    {
      //  return $this->hasMany('App\Mo3amlaNote');
        return $this->hasMany('App\Mo3amlaNote', 'mo3amla_id', 'id');

    }


    public function user_vendor()
    {
        return $this->belongsToMany('App\User');
    }

    public function order_review()
    {
        return $this->hasOne('App\Review', 'order_id', 'id');
    }

    /* 
        Mutator 
    */
   /*  public function setOrderNoAttribute($value)
    {
        $this->attributes['order_no'] = "m-".($this->id)."-Y";
        // return $this->id + 43600000;

        // return $this->id;
        // return "m-". ($this->id + 1000);
    }
 */



}
