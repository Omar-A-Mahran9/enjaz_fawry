<?php

use Illuminate\Database\Seeder;
use App\Terms;

class TermsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $terms = new Terms;

        $terms->terms_ta3med  = 'هنا شروط واحكام طلب التعميد';
        $terms->terms_mo3amla = 'هنا شروط واحكام طلب المعاملة';
        $terms->terms_estfsar = 'هنا شروط واحكام طلب استفسار مدفوع';
        $terms->terms_shrkat  = 'هنا شروط واحكام شركات';
        $terms->terms_vendor  = 'هنا شروط واحكام تسجيل معقب / مكتب خدمات';
        $terms->terms_client  = 'هنا شروط واحكام تسجيل عميل';


        $terms->save();
        
    }
}
