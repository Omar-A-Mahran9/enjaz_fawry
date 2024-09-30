<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order_estfsar extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $appends = ['status_name'];
    public function orderUser()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function processing()
    {
        return $this->hasOne('App\Status', 'id', 'processing_id');
    }
    
    public function bank()
    {
        return $this->hasOne('App\Bank', 'id', 'bank_id');
    }

    public function getStatusNameAttribute()
    {
        $st = $this->attributes['status'];

        if($st == "-1" || $st == "0"){
            $status = 'جديد';
        }elseif($st == "1"){
            $status = 'مقبول ';
        }elseif($st == "-2"){
            $status = 'مرفوض من العميل ';
        }elseif($st == "-3"){
            $status = 'مرفوض ';
        }elseif($st == "2"){
            $status = 'قيد الاجراء';
        }elseif($st == "3"){
            $status = 'معلق';
        }elseif($st == "5" || $st == "4"){
            $status = 'تم الانجاز';
        }elseif($st == "-4"){
            $status = 'ملاحظات على الطلب';
        }elseif($st == "-5"){
            $status = 'تم الرد على الملاحظات';
        }else{
            $status = 'N/A';
        }

        return  $status;
    }
}
