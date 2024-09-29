<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
// namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Setting;
// use App\Bank;

// use App\Order_mo3amla;
use App\User;
use App\VendorBanks;
use Slim\Exception\Pass;
use Illuminate\Support\Facades\Hash;

// use App\Mo3amlaProcessing;
// use App\Mo3amlaNote;


// use Auth;

class UserApiController extends Controller
{

   


  public function profilePage()
    {
        //
        $user = request()->user();

        $banks = $user->banks()->get();

        if($banks->count() > 0 ){

            $userBanks = $banks;
        }else{
            $userBanks = [];
        }
        return response()->json([
            'status' => 1, 
            'type' => 'Success',
            'user' =>  $user ,
            'banks' =>  $userBanks ,
        ]);

    }



    public function storeVendorBank(Request $r)
    {
        $user = request()->user();
        $r->validate([
            'bank_name' => ['required', 'string', 'max:90'],
            'accountName' => ['required', 'string'],
            'accountNo' => ['required', 'string', 'min:10'],
            'accountIban' => ['required', 'string', 'min:10'],
        ]);

        $bank = new VendorBanks;
        $bank->name = $r->bank_name;
        $bank->user_id = $user->id;
        $bank->accountName = $r->accountName;
        $bank->accountNo = $r->accountNo;
        $bank->accountIban = $r->accountIban;
        $bank->status = 1;
      
        $bank->save();


        return response()->json([
            'status' => 1, 
            'type' => 'Success',
            'msg' => ' تم اضافة الحساب البنكي بنجاح .',
            'bank' => $bank,
        ]);
    }


    public function editVendorBank(Request $r)
    {
        $r->validate([
            'bank_name' => ['required', 'string', 'max:90'],
            'bank_id' => ['required'],
            'accountName' => ['required', 'string'],
            'accountNo' => ['required', 'string', 'min:10'],
            'accountIban' => ['required', 'string'],
        ]); 

        $id = $r->bank_id;
        $user = request()->user();

        $bank = VendorBanks::find($id);
        $bank->name = $r->bank_name;
        $bank->user_id = $user->id;
        $bank->accountName = $r->accountName;
        $bank->accountNo = $r->accountNo;
        $bank->accountIban = $r->accountIban;
        $bank->status = 1;
      
        $bank->save();

        return response()->json([
            'status' => 1, 
            'type' => 'Success',
            'msg' => ' تم تحديث الحساب البنكي بنجاح .',
            'bank' => $bank,
        ]);
    }

    public function identityProve(Request $r)
    {
        $r->validate([
            'uploadFile' => ['required','mimes:jpeg,png,jpg,pdf'],
            'user_id' => ['required'],
        ]);

        $user = request()->user();


        if($user->id == $r->user_id){
        
            if( $r->hasFile('uploadFile')){

                //file upload and check
                $fileExt            = $r->uploadFile->getClientOriginalExtension();
                $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
                $r->uploadFile->storeAs('public/ids', $fileIdNameNew);

                if(!empty($user->identity_file) || $user->identity_file != Null ){

                    $oldFile = asset('storage/ids') .'/'. $user->identity_file;
                    unlink(storage_path('app/public/ids/'.$user->identity_file));

                }

                $user->identity_file = $fileIdNameNew;
                $user->identity_status = 0;
                $user->save();

            

                return response()->json([
                    'status' => 1, 
                    'type' => 'Success',
                    'msg' => ' تم ارسال الاوراق الثبوتية بنجاح .',
                ]);

                
            } else {

                return response()->json([
                    'status' => 0, 
                    'type' => 'error',
                    'msg' => 'اجراء غير مصرح به A03',
                ]);
            }

        }else{

            return response()->json([
                'status' => 0, 
                'type' => 'error',
                'msg' => 'اجراء غير مصرح به A04',
            ]);
        }
    }
    



    public function UpdateAccountDetails(Request $r)
    {
       
        $user = request()->user();
        $updateUser = User::find($user->id);
        $r->validate([
            'name' => ['required'],
            'gender' => ['required'],
        ]);
        // defaults
        $updateUser->name = $r->name;
        $updateUser->gender = $r->gender;

        

        // check if mobile need change 
        if(!is_null($r->changeMobile)){

            if($updateUser->phone != $r->phone){

                $verifyCode =  rand(1111, 9999);

                $r->validate([
                    'phone' => ['required', 'digits:10', 'unique:users','min:10','max:10', 'regex:/^[0-9]+$/'],
                ]);

                $updateUser->phone = $r->phone;
                $updateUser->verification_code = $verifyCode;
                $updateUser->phone_status = 0;
            }
        } // end if mobile

        // check if mail need change 
        if(!is_null($r->changeMail)){

            if($updateUser->email != $r->email){
                $r->validate([
                    'email' => ['required', 'unique:users', 'email:rfc,dns'],
                ]);
                $updateUser->email = $r->email;
            }
        } // end if mobile

        // check if password need change 
        if(!is_null($r->changePass)){

            if( Hash::check($r->oldPass, $updateUser->password) ){

                $r->validate([
                    'oldPass'   =>['required'],
                    'new_password' => ['required', 'min:6', 'string','confirmed'],
                ]);

                $updateUser->password = Hash::make($r->new_password);

            }else{

                return response()->json([
                    'status' => 0, 
                    'type' => 'error',
                    'msg' => 'كلمة المرور المدخلة غير صحيحة ! ',
                ]);

            }
        } // end if mobile


        if( $r->hasFile('profileImg') ){

            //file upload and check
            $fileExt            = $r->profileImg->getClientOriginalExtension();
            $fileIdNameNew      = uniqid().time().'.'.$fileExt;
            $r->profileImg->storeAs('public/profile_image', $fileIdNameNew);

            $updateUser->vendor_image = $fileIdNameNew;

        } // image check 

        $updateUser->save();
        
        return response()->json([
            'status' => 1, 
            'type' => 'Success',
            'msg' => 'تم تعديل البيانات بنجاح',
            'user' => $updateUser,
        ]);
    }
}
