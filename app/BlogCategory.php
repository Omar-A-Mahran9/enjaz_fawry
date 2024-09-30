<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BlogCategory extends Model
{
    //
    protected $table = 'blog_category';
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function posts()
    {
        return $this->hasMany('App\Blog', 'city_id');
    }

    
}
