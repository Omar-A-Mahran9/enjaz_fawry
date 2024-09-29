<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Setting;
        $setting->name= 'انجاز فوري';
        $setting->description = 'انجاز فوري';
        $setting->facebook = 'facebook.com';
        $setting->linkedin = 'linkedin.com';
        $setting->snapchat = 'snapchat.com';
        $setting->twitter = 'twitter.com';
        $setting->instagram = 'instagram.com';
        $setting->youtube = 'youtube';
        $setting->email = 'email@enjaz-fawry.com';
        $setting->phone = '12345678999';
        $setting->general_whats = '12345678999';
        $setting->keywords = 'تعقيب';
        $setting->logo = 'logo';
        $setting->slogan = 'السلوجان هنا';
        $setting->small_logo = 'small_logo';
        $setting->address = 'المملكة العربية السعودية';

        $setting->save();
        
    }
}