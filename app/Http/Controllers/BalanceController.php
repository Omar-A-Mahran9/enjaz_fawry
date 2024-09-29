<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance;
use App\Order_mo3amla;
use App\User;
use App\Withdrawal;
use Mail;
use App\Setting;


class BalanceController extends Controller
{
    
    // Display Vendor Balance 
    public function index(Request $r)
    {
        
        $user = User::find(auth()->user()->id);

        $notify= $user->processMo3ala->where('status','=','-1')->count();

        $balance = $user->balance->whereIn('status', ['-1',0])->sortByDesc('id');
        $balance_count = $user->balance->count();

        $balance_amount = $user->balance->sum('vendor_price');

        return view('engazFawry.dashboard.index_balance', [
            'pagetitle' => __('index_balance'),
            'balance' =>  $balance ,
            'balance_count' =>  $balance_count ,
            'balance_amount' =>  $balance_amount ,
            'user' =>  $user ,
            'notify' =>  $notify ,
            
        ]);

    }
    
    

    public function withdrawShow($wid)
    {
        // if(!auth()->user()->hasAnyPermission(['order_show'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $user = User::find(auth()->user()->id);


        $notify= $user->processMo3ala->where('status','=','-1')->count();

       
        $withdraw = Withdrawal::find($wid);

        // dd($process);
        if(isset($withdraw)){
            
            return view('engazFawry.dashboard.show_withdraw', ['withdraw' => $withdraw,  'user' =>  $user ,]);

        }else{

            $vendor_withdrawal = $user->vendor_withdrawal;
            $vendor_withdrawal_count = $user->vendor_withdrawal->count();

            return view('engazFawry.dashboard.index_withdrawal', ['vendor_withdrawal' => $vendor_withdrawal,
            'vendor_withdrawal_count' => $vendor_withdrawal_count,
             'user' =>  $user ,
             'notify' =>  $notify ,
             
             ]);

        }
    }

    // Display Vendor Balance 
    public function withdrawIndex()
    {
        $user = User::find(auth()->user()->id);

        $notify= $user->processMo3ala->where('status','=','-1')->count();

        $vendor_withdrawal = $user->vendor_withdrawal->whereIn('status', [0, '-1'])->sortByDesc('id');
        $vendor_withdrawal_count = $user->vendor_withdrawal->count();

        //$balance_amount = $user->balance->sum('vendor_price');

        return view('engazFawry.dashboard.index_withdrawal', [
            'pagetitle' => __('index_balance'),
            'vendor_withdrawal' =>  $vendor_withdrawal ,
            'vendor_withdrawal_count' =>  $vendor_withdrawal_count ,
            'user' =>  $user ,
            'notify' =>  $notify ,
        ]);


    }

     // Display Vendor Balance 
    public function tranferIndex()
    {
        $user = User::find(auth()->user()->id);

        $notify= $user->processMo3ala->where('status','=','-1')->count();

        $vendor_withdrawal = $user->vendor_withdrawal->where('status', '=', 1)->sortByDesc('id');
        $vendor_withdrawal_count = $user->vendor_withdrawal->count();

        //$balance_amount = $user->balance->sum('vendor_price');

        return view('engazFawry.dashboard.index_transfer', [
            'pagetitle' => __('index_balance'),
            'vendor_withdrawal' =>  $vendor_withdrawal ,
            'vendor_withdrawal_count' =>  $vendor_withdrawal_count ,
            'user' =>  $user ,
            'notify' =>  $notify ,
        ]);


    }


     
    
    // vendor ask for withdrawal 
    public function askWithdraw(Request $r)
    {
        $user = User::find(auth()->user()->id);

        // 1- check if this user is logged in user 
        if($user->id == $r->vendor_id){
           
            // 2- check if user balance == post balance 
            $balance_amount = $user->balance->whereIn('status', ['-1','0'])->sum('vendor_price');
            if($balance_amount == $r->TotalBalance){
                
                // get all user balance id
                $balance = $user->balance->whereIn('status', ['-1','0'])->sortByDesc('id');
                $bId = [];
                
                foreach ($balance as $b) {
                    array_push($bId, $b->id); 
                }

                $bids = implode($bId, ',');

                // 3- check if posted ids ==  vendo balance id 
                if($bids == $r->balanceIds){

                    // 4- save into DB
                    //-------------------

                    // 4-A - save one record to withdraw table 
                    $withdraw = new Withdrawal;
                    $withdraw->vendor_id    =  $r->vendor_id;
                    $withdraw->balances     = $r->balanceIds;
                    $withdraw->total_amount = $r->TotalBalance;
                    $withdraw->save();
            
                    $insertedId = $withdraw->id;

                    // 4-B - update balance record with new withdraw id
                    $balanceIds = explode(',' ,$r->balanceIds );

                    foreach ($balanceIds as $bbid) {
                      
                        $balance = Balance::find($bbid);
                        $balance->withdraw_id = $insertedId;
                        $balance->save();
                    }


                    $data = array(
                        'wid' => $insertedId,
                        'vendor_name' => $withdraw->user->name,
                        'total_amount' => $withdraw->total_amount,
                        );
            
            
                    $setting = Setting::first();
            
                    Mail::send('customEmail.ask_withdrawal', $data, function($message) use ($data,$setting){
                        $message->from('no-replay@enjaz-fawry.com');
                        $message->to($setting->email);
                        $message->cc($setting->secmail);
                        $message->subject('انجاز فوري : طلب سحب رصيد  جديد - بقيمة '.$data['total_amount']);
                    });
            

                    

                    // 4-c Redirect back with msg
                    $notification = array(
                        'message' => 'تم ارسال طلب السحب بنجاح .',
                        'alert-type' => 'success'
                    );


                    return redirect()->route('withdrawal.index')->with($notification); 




                }else{
                    abort(403, 'Unauthorized action. code-> B03');
                }

            }else{
                abort(403, 'Unauthorized action. code-> B02');
            }
        }else{
            abort(403, 'Unauthorized action. code-> B01');
        }
    }
}