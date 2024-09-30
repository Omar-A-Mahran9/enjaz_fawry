<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

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
    public function index()
    {
        
        $user =  request()->user();

        // $balance = $user->balance->whereIn('status', ['-1',0])->sortByDesc('id');
        $balance = $user->balance()->whereIn('status', ['-1',0])->get();
     //   $balance =     $user->with('balance')->whereIn('status', ['-1',0])->get();
    



        if($balance->count() > 0){
            $balance_count = $user->balance()->whereIn('status', ['-1',0])->count();
            $balance_amount = $user->balance()->whereIn('status', ['-1',0])->sum('vendor_price');

        }else{
            $balance_count = 0;
            $balance_amount = 0;

        }

        // check if have previous withdrawal in process 

        if($balance_count > 0 ){

            $bb = 0;
            $bId = [];

            foreach($balance as $b){
                $bb += $b->vendor_price;

            }
            $have_pending_withdraw = 0;

            if($user->vendor_withdrawal()->exists()){

                    
                $have_pending_withdraw = 0;
            
            
                if($user->vendor_withdrawal->whereIn('status', ['-1', 0])->count() > 0){


                    foreach ($user->vendor_withdrawal as $wi){
                        
                        $have_pending_withdraw = 0;
                        if($wi->status == '-1' ){
                            $have_pending_withdraw++;
                        }
                    } // foreach
                } // if 3
                
            }  // if 2
        } // if 1 
        else{



            return response()->json([
                'status' => 0,
                'type' => 'warning',
                'msg' => 'not found',
            ]);


        }



        if($have_pending_withdraw > 0 && $bb > 0){


            return response()->json([
                'status' => 0,
                'type' => 'warning',
                'msg' => 'يوجد طلب سحب رصيد سابق قيد المعالجة',
            ]);
    
        }elseif($have_pending_withdraw == 0 && $bb == 0){



        }elseif($have_pending_withdraw == 0 && $bb > 0){


            return response()->json([
                'status' => 1,
                'type' => 'success',
                'balance' =>  $balance ,
                'balance_count' =>  $balance_count ,
                'balance_amount' =>  $balance_amount ,
                'msg' => 'يوجد ارصدة معلقة يمكنك اجراء طلب سحب',
            ]);
  
        }else{

            return response()->json([
                'status' => 1,
                'type' => 'success',
                'balance' =>  $balance ,
                'balance_count' =>  $balance_count ,
                'balance_amount' =>  $balance_amount ,
                'msg' => 'يوجد ارصدة معلقة يمكنك اجراء طلب سحب',
            ]);  
        }




        // if($balance_count > 0 ){

        //     return response()->json([
        //         'status' => 1,
        //         'type' => 'success',
        //         'balance' =>  $balance ,
        //         'balance_count' =>  $balance_count ,
        //         'balance_amount' =>  $balance_amount ,
        //     ]);

        // }else{

        //     return response()->json([
        //         'status' => 0,
        //         'type' => 'warning',
        //         'msg' => 'not found',
        //     ]);


        // }
     

    }
    

      //  withdrowal index 
      public function withdrawIndex()
      {
          $user =  request()->user();
    
          //$vendor_withdrawal = $user->vendor_withdrawal->whereIn('status', [0, '-1'])->sortByDesc('id');
          $vendor_withdrawal = $user->vendor_withdrawal()->whereIn('status', [0, '-1'])->get();
          $vendor_withdrawal_count = $user->vendor_withdrawal()->count();


          if( $vendor_withdrawal_count > 0 ){

            return response()->json([
                'status' => 1,
                'type' => 'success',
                'msg' => 'success',
                'vendor_withdrawal' =>  $vendor_withdrawal ,
                'vendor_withdrawal_count' =>  $vendor_withdrawal_count ,
            ]);


          }else{
            return response()->json([
                'status' => 0,
                'type' => 'warning',
                'msg' => 'not found',
            ]);

          }

  
      }
    

    public function withdrawShow(Request $r)
    {
        // return response()->json([
        //     'status' => $r,
        // ]);

        $r->validate([
            'withdraw_id' => ['required'],
        ]);

        $wid = $r->withdraw_id;
        $user =  request()->user();
       
        $withdraw = Withdrawal::find($wid);

        if(isset($withdraw)){


            return response()->json([
                'status' => 1,
                'type' => 'success',
                'withdraw' => $withdraw
            ]);
            
        }else{

            $vendor_withdrawal = $user->vendor_withdrawal;
            $vendor_withdrawal_count = $user->vendor_withdrawal->count();

             return response()->json([
                'status' => 1,
                'type' => 'warning',
                'msg' => 'لايوجد طلبات سحب الرصيد ',
                'vendor_withdrawal' =>  $vendor_withdrawal ,
                'vendor_withdrawal_count' =>  $vendor_withdrawal_count ,
            ]);

        }
    }

  

     // Display Vendor Balance 
    public function tranferIndex()
    {
        $user =  request()->user();

        //$notify= $user->processMo3ala->where('status','=','-1')->count();

        $vendor_withdrawal = $user->vendor_withdrawal()->where('status', '=', 1)->get();
        $vendor_withdrawal_count = $user->vendor_withdrawal()->where('status', '=', 1)->count();

        //$balance_amount = $user->balance->sum('vendor_price');


        if( $vendor_withdrawal_count > 0 ){

            return response()->json([
                'status' => 1,
                'type' => 'success',
                'msg' => 'success',
                'vendor_withdrawal' =>  $vendor_withdrawal ,
                'vendor_withdrawal_count' =>  $vendor_withdrawal_count ,
            ]);


          }else{
            return response()->json([
                'status' => 0,
                'type' => 'warning',
                'msg' => 'not found',
            ]);

          }

    }


     
    
    // vendor ask for withdrawal 
    public function askWithdraw(Request $r)
    {

        $r->validate([
            'vendor_id' => ['required'],
            'TotalBalance' => ['required'],
            'balanceIds' => ['required'],
        ]);
        $user =  request()->user();


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
                    return response()->json([
                        'status' => 1,
                        'type' => 'success',
                        'msg' => 'تم ارسال طلب السحب بنجاح .',
                    ]);
        

                }else{

                    return response()->json([
                        'status' => 0,
                        'type' => 'warning',
                        'msg' => 'عملية غير مصرح بها كود B03',
                    ]);
        
                }

            }else{
                return response()->json([
                    'status' => 0,
                    'type' => 'warning',
                    'msg' => 'عملية غير مصرح بها كود B02',
                ]);
            }
        }else{
            return response()->json([
                'status' => 0,
                'type' => 'warning',
                'msg' => 'عملية غير مصرح بها كود B01',
            ]);
        }
    }
}