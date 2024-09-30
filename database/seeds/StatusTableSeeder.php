<?php

use Illuminate\Database\Seeder;
use App\Status;


class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
  
        $status = new Status;
        $status->name = 'تحت الاجراء';
        $status->sms = 0;
        $status->sms_text = 0;
        $status->needAction = 0;
        $status->save();


        $status = new Status;
        $status->name = 'ملاحظات علي الطلب';
        $status->sms = 1;
        $status->sms_text = 'يوجد ملاحظات على الطلب ';
        $status->needAction = 1;
        $status->save();

        
    }
}
