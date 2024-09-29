<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model 
{

    protected $table = 'home';
    public $timestamps = true;
    protected $fillable = array(
        'sitWork_icon1',
        'sitWork_text1',
        'sitWork_icon2',
        'sitWork_text2',
        'sitWork_icon2', 
        'sitWork_text2', 
        'counter1_icon', 
        'counter1_no', 
        'counter1_title', 
        'counter2_icon', 
        'counter2_no', 
        'counter2_title',
        'counter3_icon', 
        'counter3_no',
        'counter3_title'
    );

}
