<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Service extends Model 
{
 use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'services';
    public $timestamps = true;
    protected $fillable = array('name');

    // public function subServices()
    // {
    //     return $this->hasMany('App\SubService');
    // }


}
