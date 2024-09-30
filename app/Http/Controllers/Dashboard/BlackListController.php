<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BlackList;
use App\Setting;
use Validator;

class BlackListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $setting = Setting::first();
        $list = BlackList::latest()->paginate($setting->paginate);
        return view('dashboard.blacklist.index', ['list' => $list]);
    }


    
    public function create()
    {
      
        return view('dashboard.blacklist.create');
    }

    public function front()
    {

        return view('engazFawry.black_list');
    }

    public function query(Request $r)
    {

        $validator = Validator::make($r->all(), [
            'phone' => ['required', 'digits:10', 'min:10', 'max:10', 'regex:/^[0-9]+$/'],
        ]);


        if ($validator->passes()) {


            $que = BlackList::where('mobile', '=', $r->phone)->first();

            if($que){

                
                if($que->show_reason == 1){
                    $reason = $que->desc;
                }else{
                    $reason = "";
                }
                if ($que->name != null) {
                    $name = $que->name;
                } else {
                    $name = "";
                }
                $response = array(
                    'found' => 1, 
                    'mobile' =>  $r->phone ,
                    'name' =>  $name, 
                    'reason' =>  $reason,
                );
            }else{

                $response = array(
                    'found' => 0,
                    'mobile' =>  $r->phone,
                );
            }
            $data = view('engazFawry.parts.ajaxBlacklist', compact(['response']))->render();
            return response()->json(['options' => $data, 'msg' => 'success']);

        }

        return response()->json([ 'msg' => 'error', 'options' => $validator->errors()->all()]);





       

      //  dd($r);
        
    }

    public function store(Request $r)
    {

       // dd($r);


        $r->validate([
            'name' => ['required', 'string'],
            'mobile' => ['required', 'digits:10', 'unique:black_list', 'min:10', 'max:10', 'regex:/^[0-9]+$/'],
            'desc' => ['required', 'string'],
            'show_reason' => ['required'],
        ]);


        $list = new BlackList;

        $list->name = $r->name;
        $list->mobile = $r->mobile;
        $list->desc = $r->desc;
        $list->show_reason = $r->show_reason;
        $list->save();


        return redirect()->route('dashboard.blacklist.index')->with('success', 'تم اضافة الرقم بنجاح'); 


        //return view('dashboard.blacklist.create');
    }




    public function destroy($id)
    {
        $list = BlackList::find($id);
        $list->delete();
        return redirect()->back()->with('success', 'تم حذف الرقم بنجاح');
    }
}
