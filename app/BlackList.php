<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    //
  

     protected $table = 'black_list';

    public $timestamps = true;
    protected $fillable = array('name', 'mobile', 'desc');

}
