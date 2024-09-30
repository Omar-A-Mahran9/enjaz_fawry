<?php

use Illuminate\Database\Seeder;
use App\Home;

class HomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $home = new Home;
        $home->sitWork_icon1= 'fa fa-usd';
        $home->sitWork_text1 = 'شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي';
        $home->sitWork_icon2 = 'fa fa-hand-pointer-o';
        $home->sitWork_text2 = 'شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي';
        $home->sitWork_icon3 = 'fa fa-search';
        $home->sitWork_text3 = 'شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي';
        $home->counter1_icon = 'fa fa-user-circle';
        $home->counter1_no = '2000';
        $home->counter1_title = 'عميل';
        $home->counter2_icon = 'fa fa-handshake-o';
        $home->counter2_no = '5000';
        $home->counter2_title = 'عملية تمت';
        $home->counter3_icon = 'fa fa-briefcase';
        $home->counter3_no = '320';
        $home->counter3_title = 'معقب / مكتب خدمات';

        $home->save();
        
    }
}
