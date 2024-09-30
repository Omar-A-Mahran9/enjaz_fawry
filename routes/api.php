<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',  function ()
{
    echo "hello from API";
});



// Register
Route::post('register_user', 'Api\RegisterController@createClient');
Route::post('register_vendor', 'Api\RegisterController@createVendor');


// Login 
Route::post('login', 'Api\LoginController@login');


// forget password 



Route::post('forget_pasword_send_code', 'Api\RegisterController@forgetPaswordSendCode');
Route::post('save_new_password', 'Api\RegisterController@saveNewPass');




// Send Orders 
Route::post('new_order_shrkat', 'Api\SendOrdersController@sharkat_send');

// General
Route::post('terms', 'Api\GeneralController@terms');
Route::get('cities', 'Api\GeneralController@cities');
Route::get('setting', 'Api\GeneralController@setting');
Route::get('services', 'Api\GeneralController@services');
Route::get('banks', 'Api\GeneralController@banks');
Route::get('faq', 'Api\GeneralController@faq');
Route::get('about_us', 'Api\GeneralController@aboutUs');
Route::get('site_reviews', 'Api\GeneralController@SiteReviews');


Route::post('contact', 'Api\GeneralController@storeContact');
Route::post('blacklist', 'Api\GeneralController@blacklist');





// Home 
Route::get('home', 'Api\HomeController@home');

Route::get('vendors', 'Api\HomeController@vendors');
Route::get('vendorsC', 'Api\HomeController@vendors_company');
Route::get('blogs', 'Api\HomeController@blogs');
Route::get('article', 'Api\HomeController@article');

Route::get('vendor_data', 'Api\HomeController@vendorData');



Route::get('estfsar_payment_callback', 'Api\OrderEstfsarController@estfsar_payment_callback');
Route::get('ta3med_payment_callback',  'Api\OrderTa3medController@ta3med_payment_callback');
Route::get('guarante_payment_callback',  'Api\OrderGuaranteController@guarante_payment_callback');
Route::get('mo3amla_payment_callback', 'Api\OrderMo3amlaController@mo3amla_payment_callback');



// Vendor Orders

// Route::get('test', function() {
//     return response()->json(request()->user()->id);
// });

Route::group(['prefix' => 'user', 'middleware' => ['auth:api']], function() {
    Route::get('/', function() {
        return response()->json(request()->user());
    });

    // Vendor orders
    Route::get('vendor_new_orders', 'Api\VendorOrdersController@indexNew'); 
    Route::get('vendor_ongoing_orders', 'Api\VendorOrdersController@indexOnGoing'); 
    Route::get('vendor_finished_orders', 'Api\VendorOrdersController@indexFinished');
    Route::get('vendor_show_order', 'Api\VendorOrdersController@show');
    Route::post('vendor_send_his_price', 'Api\VendorOrdersController@submitProposal');
    Route::post('vendor_answer_note', 'Api\VendorOrdersController@answerNote');
    Route::post('vendor_upload_enjaz_prove', 'Api\VendorOrdersController@vendorUpdateEnjazProve');
    Route::post('vendor_update_order_status', 'Api\VendorOrdersController@vendorUpdateStatus');
 
    
    // Vendor Balance & accounts 
    Route::get('vendor_display_balances', 'Api\BalanceController@index');
    Route::get('vendor_withdrawal_index', 'Api\BalanceController@withdrawIndex');
    Route::get('vendor_show_withdraw', 'Api\BalanceController@withdrawShow');
    Route::get('vendor_transfer_index', 'Api\BalanceController@tranferIndex');
    Route::post('vendor_ask_withdrawal', 'Api\BalanceController@askWithdraw');



    // Vendor & User Profile Update 
    Route::get('profile_page', 'Api\UserApiController@profilePage');
    Route::post('store_vendor_bank', 'Api\UserApiController@storeVendorBank');
    Route::post('edit_vendor_bank', 'Api\UserApiController@editVendorBank');
    Route::post('vendor_idintity_prove', 'Api\UserApiController@identityProve');

    Route::post('update_account_details', 'Api\UserApiController@UpdateAccountDetails');

    

    // user orders
    Route::get('client_new_orders', 'Api\AllOrdersController@index'); 
    Route::get('client_ongoing_orders', 'Api\AllOrdersController@onProcess'); 
    Route::get('client_finished_orders', 'Api\AllOrdersController@finished'); 


    // verify phone
    Route::post('verify_phone', 'Api\RegisterController@verifyPhone');
    Route::post('resend_otp', 'Api\RegisterController@resendOtp');


    // Send Orders 
    Route::post('new_order_estfsar', 'Api\SendOrdersController@estfsar_send');
    Route::post('new_order_mo3amla', 'Api\SendOrdersController@mo3amla_send');
    Route::post('new_order_ta3med', 'Api\SendOrdersController@ta3med_send');
    Route::post('new_order_guarante', 'Api\SendOrdersController@guarante_send');


    // Order Estfsar 
    Route::get('order_estfsar_details', 'Api\OrderEstfsarController@estfsarShow');
    Route::post('estfsar_payment_prove', 'Api\OrderEstfsarController@estfsarProve');
    Route::post('estfsar_print_invoice', 'Api\OrderEstfsarController@printInvoice');
    Route::post('confirm_online_payment', 'Api\OrderEstfsarController@confirm_online_payment');
    Route::post('rate_estfsar', 'Api\OrderEstfsarController@ReviewEstfsar');
    

    // Order Ta3med 
    Route::get('order_ta3med_details', 'Api\OrderTa3medController@ta3medShow');
    Route::post('ta3med_payment_prove', 'Api\OrderTa3medController@ta3medProve');
    Route::post('ta3med_print_invoice', 'Api\OrderTa3medController@printInvoice');
    Route::post('confirm_online_payment_ta3med', 'Api\OrderTa3medController@confirm_online_payment');
    Route::post('rate_ta3med', 'Api\OrderTa3medController@ReviewTa3med');



    // Order Guarante 
    Route::get('order_guarante_details', 'Api\OrderGuaranteController@guaranteShow');
    Route::post('guarante_payment_prove', 'Api\OrderGuaranteController@guaranteProve');
    Route::post('guarante_print_invoice', 'Api\OrderGuaranteController@printInvoice');
    Route::post('confirm_online_payment_guarante', 'Api\OrderGuaranteController@confirm_online_payment');
    Route::post('rate_guarante', 'Api\OrderGuaranteController@ReviewGuarante');


    // Order Mo3amla 
    Route::get('order_mo3amla_details', 'Api\OrderMo3amlaController@mo3amlaShow');
    Route::post('mo3amla_payment_prove', 'Api\OrderMo3amlaController@mo3amlaProve');
    Route::post('mo3amla_print_invoice', 'Api\OrderMo3amlaController@printInvoice');
    Route::post('confirm_online_payment_mo3amla', 'Api\OrderMo3amlaController@confirm_online_payment');
    Route::post('rate_mo3amla', 'Api\OrderMo3amlaController@ReviewMo3amla');
    Route::post('mo3amla_select_payment', 'Api\OrderMo3amlaController@SelectPayment');
    Route::post('mo3amla_approve_or_reject_price', 'Api\OrderMo3amlaController@approveOrRejectPrice');
    Route::post('add_new_files_and_answer_notes', 'Api\OrderMo3amlaController@AddNewFilesAndAnswerNote');

    
    


    Route::get('payment_keys', 'Api\GeneralController@paymentKeys');
    
});