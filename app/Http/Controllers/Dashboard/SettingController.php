<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Home;
use App\Terms;

class SettingController extends Controller
{
    public function edit()
    {
        // if(!auth()->user()->hasAnyPermission(['setting'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        $setting = Setting::first();
        return view('dashboard.setting.general_setting',['setting' => $setting]);
    }

    
    public function update(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['setting'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'facebook' => ['required', 'string', 'max:255'],
            'linkedin' => ['required', 'string', 'max:255'],
            'snapchat' => ['required', 'string', 'max:255'],
            'twitter' => ['required', 'string', 'max:255'],
            'instagram' => ['required', 'string', 'max:255'],
            'youtube' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'general_whats' => ['required'],
            'keywords' => ['required', 'string', 'max:255'],
            'paginate' => ['required'],
            'onlinePayment' => ['required'],
            'bankPayment' => ['required'],
            'ta3med_price' => ['required'],
            'guarante_percentage' => ['required'],
            
            'estfsar_price' => ['required'],
            'slogan' => ['required'],
            'address' => ['required'],
            
        ]);
        
        $setting = Setting::first();
        $setting->name = $r->name;
        $setting->description = $r->description;
        $setting->facebook = $r->facebook;
        $setting->snapchat = $r->snapchat;
        $setting->linkedin = $r->linkedin;
        $setting->twitter = $r->twitter;
        $setting->instagram = $r->instagram;
        $setting->youtube = $r->youtube;
        $setting->email = $r->email;
        $setting->phone = $r->phone;
        $setting->general_whats = $r->general_whats;
        $setting->keywords = $r->keywords;
        $setting->paginate = $r->paginate;
        $setting->bankPayment = $r->bankPayment;
        $setting->onlinePayment = $r->onlinePayment;
        $setting->ta3med_price = $r->ta3med_price;
        $setting->tameed_percentage = $r->ta3med_price;
        $setting->guarante_percentage = $r->guarante_percentage;

        
        $setting->estfsar_price = $r->estfsar_price;
        $setting->slogan = $r->slogan;
        $setting->address = $r->address;

        $setting->warning_on       = $r->warning_on;
        $setting->warning_title    = $r->warning_title;
        $setting->warning_text     = $r->warning_text;
        $setting->warning_text_app = $r->warning_text_app;

        if($r->hasFile('logo')) {
            if (is_file('public' . '/' . $setting->logo)) {
                Storage::delete('public' . '/' . $setting->logo);
            }
            $fileExt            = $r->logo->getClientOriginalExtension();
            $fileNameNew        = uniqid() . time() . '.' . $fileExt;
            $r->logo->storeAs('public/', $fileNameNew);
            $setting->logo = $fileNameNew;
        }

        if($r->hasFile('small_logo')) {
            if (is_file('public' . '/' . $setting->small_logo)) {
                Storage::delete('public' . '/' . $setting->small_logo);
            }
        
            $fileExt            = $r->small_logo->getClientOriginalExtension();
            $fileNameNew        = uniqid() . time() . '.' . $fileExt;
            $r->small_logo->storeAs('public/', $fileNameNew);
            $setting->small_logo = $fileNameNew;
        }

        $setting->save();

        return redirect()->back()->with('success', 'تم تحديث الاعدادات بنجاح');
    }


    public function HomeEdit()
    {
        // if(!auth()->user()->hasAnyPermission(['setting'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        $home = Home::first();
        return view('dashboard.setting.home_data',['home' => $home]);
    }


    public function homeUpdate(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['setting'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'sitWork_icon1' => ['required', 'string', 'max:255'],
            'sitWork_text1' => ['required', 'string', 'max:1000'],
            'sitWork_icon2' => ['required', 'string', 'max:255'],
            'sitWork_text2' => ['required', 'string', 'max:1000'],
            'sitWork_icon3' => ['required', 'string', 'max:255'],
            'sitWork_text3' => ['required', 'string', 'max:1000'],
            'counter1_icon' => ['required', 'string', 'max:255'],
            'counter1_no'   => ['required', 'string', 'max:255'],
            'counter1_title'=> ['required', 'string', 'max:255'],
            'counter2_icon' => ['required', 'string', 'max:255'],
            'counter2_no'   => ['required', 'string', 'max:255'],
            'counter2_title'=> ['required', 'string', 'max:255'],
            'counter3_icon' => ['required', 'string', 'max:255'],
            'counter3_no'   => ['required', 'string', 'max:255'],
            'counter3_title'=> ['required', 'string', 'max:255'],

        ]);
  
        
        $home = Home::first();
       
        $home->sitWork_icon1= $r->sitWork_icon1;
        $home->sitWork_text1 = $r->sitWork_text1;
        $home->sitWork_icon2 = $r->sitWork_icon2;
        $home->sitWork_text2 = $r->sitWork_text2;
        $home->sitWork_icon3 = $r->sitWork_icon3;
        $home->sitWork_text3 = $r->sitWork_text3;
        $home->counter1_icon = $r->counter1_icon;
        $home->counter1_no   = $r->counter1_no;
        $home->counter1_title = $r->counter1_title;
        $home->counter2_icon = $r->counter2_icon;
        $home->counter2_no = $r->counter2_no;
        $home->counter2_title = $r->counter2_title;
        $home->counter3_icon = $r->counter3_icon;
        $home->counter3_no = $r->counter3_no;
        $home->counter3_title = $r->counter3_title;

        $home->save();
        
        return redirect()->back()->with('success', 'تم تحديث اعدادات الصفحة الرئيسية بنجاح');
    }

    public function termsGet()
    {
        // if(!auth()->user()->hasAnyPermission(['setting'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        $data = Terms::first();
        return view('dashboard.setting.terms_and_cond',['data' => $data]);
    }


    public function termsUpdate(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['setting'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'terms_ta3med' => ['required', 'string'],
            'terms_guarante' => ['required', 'string'],
            'terms_mo3amla' => ['required', 'string'],
            'terms_estfsar' => ['required', 'string'],
            'terms_shrkat' => ['required', 'string'],
            'terms_vendor' => ['required', 'string'],
            'terms_client' => ['required', 'string'],
        ]);

        $data = Terms::first();

        $data->terms_ta3med = $r->terms_ta3med;
        $data->terms_guarante = $r->terms_guarante;
        $data->terms_mo3amla = $r->terms_mo3amla;
        $data->terms_estfsar = $r->terms_estfsar;
        $data->terms_shrkat = $r->terms_shrkat;
        $data->terms_vendor = $r->terms_vendor;
        $data->terms_client = $r->terms_client;
        $data->save();
        
        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح');
    }

}