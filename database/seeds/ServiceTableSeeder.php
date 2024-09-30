<?php

use Illuminate\Database\Seeder;
use App\Service;


class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        $service = new Service;
        $service->name = 'الادارة العامة للجوازات';
        $service->status = 1;
        $service->save();


        $service1 = new Service;
        $service1->name = 'مكتب العمل';
        $service1->status = 1;
        $service1   ->save();


        $service3 = new Service;
        $service3->name = 'وزارة الداخلية';
        $service3->status = 1;
        $service3->save();
    }
}
