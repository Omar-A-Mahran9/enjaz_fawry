<?php

use Illuminate\Database\Seeder;
use App\Order_mo3amla;


class OrderMo3amlaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $mo3amla = new Order_mo3amla;
        $mo3amla->order_no = 'm-0001';
        $mo3amla->user_id = 1;
        $mo3amla->service_id = 1;
        $mo3amla->mo3amla_subject = 'test mo3amla subject';
        $mo3amla->mo3amla_details = 'test mo3amla details';
        $mo3amla->mo3amla_details = 'test mo3amla details';
        $mo3amla->attachments = '00';
        $mo3amla->subservice_id = 1;
        $mo3amla->mo3amla_budget = '1000';
        $mo3amla->city_id = 1;
        $mo3amla->save();



      


        
    }
}
