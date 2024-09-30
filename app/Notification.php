<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title_en', 'title_ar', 'content_en', 'content_ar', 'type', 'notifiable_id', 'notifiable_type');

    public function notifiable()
    {
        return $this->morphTo();
    }

}