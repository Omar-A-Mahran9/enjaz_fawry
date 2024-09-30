<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'setting';
    public $timestamps = true;
    protected $fillable = array(
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'facebook', 
        'twitter', 
        'instagram', 
        'youtube', 
        'email', 
        'phone', 
        'keywords_ar', 
        'keywords_en',
        'paginate', 
        'slider',
        'site_down'
    );

}
