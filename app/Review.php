<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = 'review';
    protected $fillable = [
        'order_id', 'client_id', 'vendor_id', 'description', 'status',
    ];
    protected $appends = ['client_name'];

     

    public function user_did_reviwes()
    {
        return $this->belongsTo('App\User', 'client_id');
    }

    public function vendor_has_reviwes()
    {
        return $this->belongsTo('App\User', 'vendor_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Order_mo3amla', 'order_id');
    }

    public function getClientNameAttribute()
    {

        $user = User::find($this->attributes['client_id']);
        return $user->name;
    }


}
