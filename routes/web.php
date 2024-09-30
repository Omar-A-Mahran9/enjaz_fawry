<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**************************
 * Front End Routes
 ------------------------*/


    Route::view('/service-request','engazFawry.landing-page')->name('landing-page');

    Route::get('/visa', 'HomeController@visa')->name('visa');
    Route::get('/payment-test', 'HomeController@paymentTest')->name('paymentTest');

    Route::get('/blog', 'HomeController@blog')->name('blog');
    Route::get('/article/{id}', 'HomeController@article')->name('article');


    Route::get('/', 'HomeController@index')->name('index');

    Route::get('/invoice', 'HomeController@invoice')->name('invoice');

    // Auth::routes();

    Route::get('/verifyphone', 'Auth\RegisterController@validatePhone')->name('verifyphone');

    Route::get('/user/verify/{token}', 'HomeController@verifyUser')->name('verify_user_mail');
    Route::post('/verifyphone', 'UserController@verifyPhone')->name('verify_form');
    Route::post('/resend_otp', 'UserController@resendOtp')->name('resend_otp');




    // Login
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login_front');
    Route::post('/login', 'Auth\LoginController@login')->name('login_form');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout_front');

    // SignUp
    Route::get('/signup', 'Auth\RegisterController@showClientRegisterForm')->name('signup');
    Route::post('/signup', 'Auth\RegisterController@createClient')->name('signup_form');
    Route::post('/signup/vendor', 'Auth\RegisterController@createVendor')->name('signup_form_vendor');
    Route::get('/signup/vendor', 'Auth\RegisterController@showVendorRegisterForm')->name('signup_vendor');

    Route::view('account-created', 'engazFawry.thank-you')->name('thank-you');

    /**
     * ***************************************************************************************************************
     * ***************************************************************************************************************
     * ***************************************************************************************************************
     * ***************************************************************************************************************
     * ***************************************************************************************************************
     *
     * Need Login To View
     *
     * ***************************************************************************************************************
     * ***************************************************************************************************************
     * ***************************************************************************************************************
     * ***************************************************************************************************************
     *
     */

      Route::get('mail', function(){
    
            return view('customEmail.clients.vendor_newOrder',['name' => 'name']);
      });

    Route::middleware('auth')->group( function () {


        Route::get('file-upload', 'FileController@index');
        Route::post('file-upload', 'FileController@upload')->name('upload');
        Route::post('delete_image', 'FileController@deleteImage')->name('delete_image');




        Route::get('/save-device-token', 'UserController@saveToken')->name('save-device-token');

      //  Route::resource('/upload', 'UploadController');

        /** Front Need Auth  => middleware ("auth","verifyphone")*/
        Route::get('/account', 'UserController@dashboard')->name('account')->middleware('verifyPhone','auth:web');
        Route::get('/client_panel', 'UserController@dashboard')->name('client_dashboard');
        Route::get('/client_panel/setting', 'UserController@setting')->name('panel.setting');
        Route::post('/client_panel/bank/stroe', 'UserController@storeVendorBank')->name('bank.store');
        Route::put('/client_panel/bank/edit/{id}', 'UserController@editVendorBank')->name('bank.edit');
        Route::post('/client_panel/setting/identity', 'UserController@identityProve')->name('user.id.send');

        Route::get('/client_panel/setting/edit', 'UserController@EditAccountDetails')->name('user.setting.edit');
        Route::put('/client_panel/setting/edit', 'UserController@UpdateAccountDetails')->name('user.setting.submit');


        // ****************** Client Orders ************************/
        // vendor Recieve all mo3amla orders
        Route::get('/client_panel/new_orders', 'ClientOrderController@indexNew')->name('orders.new');
        Route::get('/client_panel/on_going', 'ClientOrderController@indexOnGoing')->name('orders.on_going');
        Route::get('/client_panel/closed_orders', 'ClientOrderController@indexFinished')->name('orders.finished');
        Route::get('/client_panel/order/{id}', 'ClientOrderController@show')->name('order.show');
        Route::put('/client_panel/submit_proposal/', 'ClientOrderController@submitProposal')->name('submit.proposal');
        Route::put('/client_panel/answerNote/', 'ClientOrderController@answerNote')->name('vendor.answerNote');

        Route::put('/client_panel/mo3amla/vendorUpdateStatus/{oid}', 'ClientOrderController@vendorUpdateStatus')->name('vendor.update.status');

        Route::put('/client_panel/mo3amla/vendorUpdateEnjazProve/{oid}', 'ClientOrderController@vendorUpdateEnjazProve')->name('vendor.update.enjazProve');


        // ****************** Estfsar ************************/
        // user dashboard Estfsar
        Route::get('/client_panel/estfsar', 'OrderEstfsarController@index')->name('panel.estfsar');
        Route::get('/client_panel/estfsar/{oid}', 'OrderEstfsarController@estfsarShow')->name('estfsar.show');
        Route::post('/client_panel/estfsar', 'OrderEstfsarController@estfsarProve')->name('estfsar.payment.prove');

        Route::post('/client_panel/estfsar/review/{oid}', 'ReviewsController@storeEstfsar')->name('estfsar.review');
        Route::get('/client_panel/estfsar/invoice/{oid}', 'OrderEstfsarController@printInvoice')->name('print.invoice.estfsar');



        // ****************** Ta3med ************************/
        // user dashboard Ta3med
        Route::get('/client_panel/ta3med', 'OrderTa3medController@index')->name('panel.ta3med');
        Route::get('/client_panel/ta3med/{oid}', 'OrderTa3medController@ta3medShow')->name('ta3med.show');
        Route::post('/client_panel/ta3med', 'OrderTa3medController@ta3medProve')->name('ta3med.payment.prove');

        Route::post('/client_panel/ta3med/review/{oid}', 'ReviewsController@storeTa3med')->name('ta3med.review');
        Route::get('/client_panel/ta3med/invoice/{oid}', 'OrderTa3medController@printInvoice')->name('print.invoice.ta3med');



                // ****************** Guarante ************************/
        // user dashboard Guarante
        Route::get('/client_panel/guarante', 'OrderGuaranteController@index')->name('panel.guarante');
        Route::get('/client_panel/guarante/{oid}', 'OrderGuaranteController@guaranteShow')->name('guarante.show');
        Route::post('/client_panel/guarante', 'OrderGuaranteController@guaranteProve')->name('guarante.payment.prove');

        Route::post('/client_panel/guarante/review/{oid}', 'ReviewsController@storeGuarante')->name('guarante.review');
        Route::get('/client_panel/guarante/invoice/{oid}', 'OrderGuaranteController@printInvoice')->name('print.invoice.guarante');


        // ****************** Mo3amla ************************/
        // user dashboard Mo3amla
        Route::get('/client_panel/mo3amla', 'OrderMo3amlaController@index')->name('panel.mo3amla');
        Route::get('/client_panel/mo3amla/{oid}', 'OrderMo3amlaController@mo3amlaShow')->name('mo3amla.show');
        Route::post('/client_panel/mo3amla', 'OrderMo3amlaController@mo3amlaProve')->name('mo3amla.payment.prove');
        Route::post('/client_panel/addNewFiles', 'OrderMo3amlaController@mo3amlaAddNewFiles')->name('mo3amla.addNew.files');
        Route::put('/client_panel/mo3amla/confirmReject/{oid}', 'OrderMo3amlaController@confirmReject')->name('mo3amla.confirmReject');

        Route::post('/client_panel/mo3amla/review/{oid}', 'ReviewsController@storeMo3amla')->name('mo3amla.review');
        Route::get('/client_panel/mo3amla/invoice/{oid}', 'OrderMo3amlaController@printInvoice')->name('print.invoice.mo3amla');


        // ****************** Balance ************************/
        // user dashboard Balance
        Route::get('/client_panel/balance', 'BalanceController@index')->name('panel.balance');
        Route::get('/client_panel/balance/{oid}', 'BalanceController@mo3amlaShow')->name('balance.show');
        Route::post('/client_panel/withdraw', 'BalanceController@askWithdraw')->name('balance.ask.withdraw');

        Route::get('/client_panel/withdraw', 'BalanceController@withdrawIndex')->name('withdrawal.index');
        Route::get('/client_panel/withdraw/{wid}', 'BalanceController@withdrawShow')->name('withdraw.show');
        Route::get('/client_panel/tranfer', 'BalanceController@tranferIndex')->name('tranfers.index');


        // ****************** Bills ************************/
        // user dashboard Bills
        Route::get('/client_panel/bills', 'BillsController@index')->name('panel.bills');
        Route::get('/client_panel/my_new_orders', 'AllOrdersController@index')->name('my.orders.new');
        Route::get('/client_panel/my_onprocess_orders', 'AllOrdersController@onProcess')->name('my.orders.onprocess');
        Route::get('/client_panel/my_finished_orders', 'AllOrdersController@finished')->name('my.orders.finished');

    });


    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    // ****************** Estfsar ************************/
    // user send estfsar
    Route::get('/estfsar', 'OrderEstfsarController@estfsar')->name('estfsar');
    Route::post('/estfsar', 'OrderEstfsarController@estfsar_send')->name('estfsar_send');

    // ****************** Ta3med ************************/
    // user send Ta3med
    Route::get('/ta3med', 'OrderTa3medController@ta3med')->name('ta3med');
    Route::post('/ta3med', 'OrderTa3medController@ta3med_send')->name('ta3med_send');


    // ****************** Guarante ************************/
    // user send Guarante
    Route::get('/guarante', 'OrderGuaranteController@guarante')->name('guarante');
    Route::post('/guarante', 'OrderGuaranteController@guarante_send')->name('guarante_send');

    // ****************** Mo3amla ************************/
    // user send Mo3amla
    Route::get('/mo3amla', 'OrderMo3amlaController@mo3amla')->name('mo3amla');
    Route::post('/mo3amla', 'OrderMo3amlaController@mo3amla_send')->name('mo3amla_send');

    Route::get('/vendors', 'HomeController@vendors')->name('vendors');
    Route::get('/vendors-company', 'HomeController@vendors_company')->name('vendors-company');
    Route::get('/vendor/{id}', 'HomeController@vendor')->name('vendor');
    Route::post('/vendorData', 'HomeController@vendorData')->name('ajax.vendorData');



    Route::get('/sharkat', 'HomeController@sharkat')->name('sharkat');
    Route::post('/sharkat', 'HomeController@sharkat_send')->name('sharkat_send');

    //Route::get('home', 'HomeController@index')->name('home');

    Route::get('/contact', 'HomeController@contact')->name('contact');
    Route::post('/contact', 'HomeController@storeContact')->name('store.contact');
    Route::get('/faq', 'HomeController@faq')->name('faq');


// http://127.0.0.1:8000/rate_site/2/b8e35

    Route::get('rate_site/{id}/{token}', 'RateSiteController@rate')->name('rate_site');
    Route::post('rate_site/', 'RateSiteController@submitRate')->name('rate_site.submit');

    Route::get('black_list', 'Dashboard\BlackListController@front')->name('black_list');
    Route::POST('black_list/query', 'Dashboard\BlackListController@query')->name('black_list.query');



//Auth::routes();
/*************************
 *    Back-End Routes    *
 *************************/
    Route::post('dashboard/login', 'Auth\AdminLoginController@adminLogin');
    Route::post('dashboard/logout', 'Auth\AdminLoginController@logout')->name('logout');
    Route::get('dashboard/login', 'Auth\AdminLoginController@showLoginForm')->name('login');

    Route::name('dashboard.')->middleware('auth:admin')->prefix('dashboard')->group( function () {

    // Search
    Route::get('search/admin', 'Dashboard\SearchController@search')->name('search.new');
    Route::post('sms/send', 'Dashboard\HomeController@customSMS')->name('order.sendCustomSMS');

    // Services
    Route::resource('service', 'Dashboard\ServiceController')->except('show');
    Route::resource('sub_service', 'Dashboard\SubServiceController')->except('show');
    Route::get('contact_order', 'Api\RequstController@getAll')->name("contact_order.All");
    Route::get('contact_order/show/{id}', 'Api\RequstController@show')->name("contact_order.show");
    Route::DELETE('contact_order/delete/{id}', 'Api\RequstController@destroy')->name('contact_order.destroy');
 

    Route::get('contact_order/{id}', 'Api\RequstController@service')->name("contact_order.service");

    // Clients
    Route::get('clients', 'Dashboard\UsersController@indexClient')->name('clients.index');
    Route::get('client/edit/{id}', 'Dashboard\UsersController@editClient')->name('users.client_edit');
    Route::get('client/show/{id}', 'Dashboard\UsersController@showClient')->name('users.client_show');
    Route::put('client/edit/{id}', 'Dashboard\UsersController@updateClient')->name('users.client_update');
    //Route::get('client/destroy', 'Dashboard\UsersController@destroyClient')->name('users.client_destroy');

    // Vendors
    Route::get('vendors', 'Dashboard\UsersController@indexVendor')->name('vendors.index');
    Route::get('vendor/edit/{id}', 'Dashboard\UsersController@editVendor')->name('vendor.vendor_edit');
    Route::get('vendor/show/{id}', 'Dashboard\UsersController@showVendor')->name('vendor.vendor_show');
    Route::put('vendor/edit/{id}', 'Dashboard\UsersController@updateVendor')->name('vendor.vendor_update');
    Route::get('vendor/push/{id}', 'Dashboard\UsersController@sendPushNotification')->name('vendor.vendor_pushTest');
   //Route::get('vendor/destroy', 'Dashboard\UsersController@destroyVendor')->name('vendor.vendor_destroy');

    Route::resource('sub_service', 'Dashboard\SubServiceController')->except('show');

    // orders company
    Route::get('order/company', 'Dashboard\OrderCompanyController@index')->name('order.company.index');
    Route::get('order/company/{id}', 'Dashboard\OrderCompanyController@showCompany')->name('order.company.show');
    Route::DELETE('order/company/delete/{id}', 'Dashboard\OrderCompanyController@destroy')->name('order.company.destroy');
    Route::put('order/company/update/{id}', 'Dashboard\OrderCompanyController@update')->name('order.company.update');
    Route::post('order/company/update', 'Dashboard\OrderCompanyController@statusUpdate')->name('order.company.statusUpdate');

    // orders Estfsar
    Route::get('order/estfsar', 'Dashboard\OrderEstfsarController@index')->name('order.estfsar.index');
    Route::get('order/estfsar/{id}', 'Dashboard\OrderEstfsarController@showEstfsar')->name('order.estfsar.show');
    Route::DELETE('order/estfsar/delete/{id}', 'Dashboard\OrderEstfsarController@destroy')->name('order.estfsar.destroy');
    Route::put('order/estfsar/update/{id}', 'Dashboard\OrderEstfsarController@update')->name('order.estfsar.update');
    Route::put('order/estfsar/paymentStatus/{id}', 'Dashboard\OrderEstfsarController@paymentStatusEstfsar')->name('order.estfsar.paymentStatus');
    Route::post('order/estfsar/update', 'Dashboard\OrderEstfsarController@statusUpdate')->name('order.estfsar.statusUpdate');

    Route::put('order/estfsar/status/{id}', 'Dashboard\OrderEstfsarController@changeStatus')->name('order.estfsar.changeStatus');

    // orders Ta3med
    Route::get('order/ta3med', 'Dashboard\OrderTa3medController@index')->name('order.ta3med.index');
    Route::get('order/ta3med/{id}', 'Dashboard\OrderTa3medController@showTa3med')->name('order.ta3med.show');
    Route::DELETE('order/ta3med/delete/{id}', 'Dashboard\OrderTa3medController@destroy')->name('order.ta3med.destroy');
    Route::put('order/ta3med/update/{id}', 'Dashboard\OrderTa3medController@update')->name('order.ta3med.update');
    Route::put('order/ta3med/paymentStatus/{id}', 'Dashboard\OrderTa3medController@paymentStatusTa3med')->name('order.ta3med.paymentStatus');
    Route::post('order/ta3med/update', 'Dashboard\OrderTa3medController@statusUpdate')->name('order.ta3med.statusUpdate');

    Route::put('order/ta3med/status/{id}', 'Dashboard\OrderTa3medController@changeStatus')->name('order.ta3med.changeStatus');


    // orders Guarante
    Route::get('order/guarante', 'Dashboard\OrderGuaranteController@index')->name('order.guarante.index');
    Route::get('order/guarante/{id}', 'Dashboard\OrderGuaranteController@showTa3med')->name('order.guarante.show');
    Route::DELETE('order/guarante/delete/{id}', 'Dashboard\OrderGuaranteController@destroy')->name('order.guarante.destroy');
    Route::put('order/guarante/update/{id}', 'Dashboard\OrderGuaranteController@update')->name('order.guarante.update');
    Route::put('order/guarante/paymentStatus/{id}', 'Dashboard\OrderGuaranteController@paymentStatusTa3med')->name('order.guarante.paymentStatus');
    Route::post('order/guarante/update', 'Dashboard\OrderGuaranteController@statusUpdate')->name('order.guarante.statusUpdate');

    Route::put('order/guarante/status/{id}', 'Dashboard\OrderGuaranteController@changeStatus')->name('order.guarante.changeStatus');



    // orders Mo3amla
    Route::get('order/mo3amla', 'Dashboard\OrderMo3amlaController@index')->name('order.mo3amla.index');
    Route::get('order/mo3amla/archive', 'Dashboard\OrderMo3amlaController@archive')->name('order.mo3amla.archive');
    Route::get('order/mo3amla/{id}', 'Dashboard\OrderMo3amlaController@show')->name('order.mo3amla.show');
    Route::DELETE('order/mo3amla/delete/{id}', 'Dashboard\OrderMo3amlaController@destroy')->name('order.mo3amla.destroy');
    Route::put('order/mo3amla/update/{id}', 'Dashboard\OrderMo3amlaController@update')->name('order.mo3amla.update');
    Route::put('order/mo3amla/paymentStatus/{id}', 'Dashboard\OrderMo3amlaController@paymentStatusMo3amla')->name('order.mo3amla.paymentStatus');
    Route::post('order/mo3amla/update', 'Dashboard\OrderMo3amlaController@statusUpdate')->name('order.mo3amla.statusUpdate');

    Route::post('order/mo3amla/enjaz_prove', 'Dashboard\OrderMo3amlaController@enjazProve')->name('order.mo3amla.enjaz_prove');


    Route::put('order/status/{id}', 'Dashboard\OrderMo3amlaController@changeStatus')->name('order.mo3amla.changeStatus');

    // Proccess Mo3amla
    Route::post('ajax/mo3amla/1', 'Dashboard\OrderMo3amlaController@AjaxMo3amlaOne')->name('ajax.mo3amla.one');
    Route::post('ajax/mo3amla/2', 'Dashboard\OrderMo3amlaController@AjaxMo3amlaTwo')->name('ajax.mo3amla.two');
    Route::post('ajax/mo3amla/2a', 'Dashboard\OrderMo3amlaController@AjaxMo3amlaTwoA')->name('ajax.mo3amla.two.a');
    Route::post('ajax/mo3amla/2c', 'Dashboard\OrderMo3amlaController@AjaxMo3amlaTwoC')->name('ajax.mo3amla.two.c');
    Route::post('ajax/mo3amla/3', 'Dashboard\OrderMo3amlaController@AjaxMo3amlaThree')->name('ajax.mo3amla.three');
    Route::post('ajax/mo3amla/assignTo', 'Dashboard\OrderMo3amlaController@AjaxMo3amlaAssignTo')->name('ajax.mo3amla.assignTo');
    Route::post('ajax/mo3amla/reAssignTo', 'Dashboard\OrderMo3amlaController@AjaxMo3amlaReAssignTo')->name('ajax.mo3amla.reAssignTo');

    Route::post('ajax/mo3amla/AsignSubmit', 'Dashboard\OrderMo3amlaController@Mo3amlaAsignSubmit')->name('order.mo3amla.AsignSubmit');
    Route::post('ajax/mo3amla/AsignReSubmit', 'Dashboard\OrderMo3amlaController@Mo3amlaAsignReSubmit')->name('order.mo3amla.AsignReSubmit');

    Route::post('assign/mo3amla', 'Dashboard\OrderMo3amlaController@assignMo3amla')->name('assign.mo3amla');
    Route::post('mo3amla/sendNotes', 'Dashboard\OrderMo3amlaController@sendNotes')->name('order.mo3amla.sendNotes');
    Route::post('mo3amla/sendNewNotes', 'Dashboard\OrderMo3amlaController@sendNewNotes')->name('order.mo3amla.sendNewNotes');

    Route::get('setting', 'Dashboard\SettingController@edit')->name('setting.edit');
    Route::put('setting', 'Dashboard\SettingController@update')->name('setting.update');
    Route::get('terms_and_cond/setting', 'Dashboard\SettingController@termsGet')->name('termsGet');
    Route::put('terms_and_cond/setting', 'Dashboard\SettingController@termsUpdate')->name('termsUpdate');

    // Route::get('home/setting', 'Dashboard\SettingController@HomeEdit')->name('HomeEdit');
    // Route::put('home/setting', 'Dashboard\SettingController@homeUpdate')->name('homeUpdate');

    Route::get('home/setting', 'Dashboard\SettingController@HomeEdit')->name('HomeEdit');
    Route::put('home/setting', 'Dashboard\SettingController@homeUpdate')->name('home.update');

    Route::resource('banks', 'Dashboard\BankController')->except('show');
    Route::resource('reviews', 'Dashboard\ReviewsController')->except('show');
    Route::get('reviews/approve/{id}', 'Dashboard\ReviewsController@Approve')->name('reviews.approve');
    Route::get('reviews/reject/{id}', 'Dashboard\ReviewsController@Reject')->name('reviews.reject');

    Route::resource('status', 'Dashboard\StatusController')->except('show');

    // Accounts
    Route::get('accounts/index', 'Dashboard\AccountsController@index')->name('accounts.index');
    Route::post('accounts/index', 'Dashboard\AccountsController@indexDate')->name('accounts.index.dates');
    Route::post('accounts/index/template', 'Dashboard\AccountsController@dateTemplate')->name('accounts.index.dateTemplate');
    Route::post('accounts/index/displayDate', 'Dashboard\AccountsController@displayDate')->name('accounts.index.displayDate');
    Route::post('accounts/index/exportXls', 'Dashboard\AccountsController@exportExcel')->name('accounts.index.exportExcel');

    Route::get('accounts/balance', 'Dashboard\AccountsController@balanceIndex')->name('accounts.balance.index');
    Route::get('accounts/withdraw', 'Dashboard\AccountsController@withdrawIndex')->name('accounts.withdraw.index');
    Route::get('accounts/withdraw/archive', 'Dashboard\AccountsController@withdrawArchive')->name('accounts.withdraw.archive');
    Route::get('accounts/statement', 'Dashboard\AccountsController@statementIndex')->name('accounts.statement.index');

    Route::get('accounts/balance/{id}', 'Dashboard\AccountsController@balanceShow')->name('accounts.balance.show');
    Route::get('accounts/withdraw/{id}', 'Dashboard\AccountsController@withdrawShow')->name('accounts.withdraw.show');
    Route::put('accounts/withdraw/update/{id}', 'Dashboard\AccountsController@withdrawUpdate')->name('accounts.withdraw.update');



    Route::get('profile/{id}', 'Dashboard\ProfileController@show')->name('profile.show');

    Route::put('profile', 'Dashboard\ProfileController@update')->name('profile.update');

    Route::put('profile/changePassword', 'Dashboard\ProfileController@changePassword')->name('profile.changePassword');

    Route::resource('blog', 'Dashboard\BlogController')->except('show');

    Route::resource('cities', 'Dashboard\CitiesController');

    Route::resource('contact', 'Dashboard\ContactController');

    Route::resource('common_questions', 'Dashboard\CommonQuestionController');

    Route::get('cars/rename', 'Dashboard\ProductController@rename')->name('cars.rename');

    Route::get('/home', 'Dashboard\HomeController@home')->name('home');

    Route::get('dashboard/home', 'Dashboard\HomeController@home')->name('dashboard.home');

   // Route::post('ajax/models', 'Dashboard\ProductController@AjaxModelsByBrandID')->name('ajax.getModelsByBrandID');

   // Route::post('ajax/model_types', 'Dashboard\ProductController@AjaxModelTypesByModelID')->name('ajax.AjaxModelTypesByModelID');

    Route::get('export/contact', 'Dashboard\ContactController@export')->name('contact.export');

    Route::post('contact/status/update', 'Dashboard\ContactController@statusUpdate')->name('contact.statusUpdate');

    // Route::resource('order', 'Dashboard\OrderController');

    // Route::get('export/order', 'Dashboard\OrderController@export')->name('order.export');

    Route::post('order/status/update', 'Dashboard\OrderController@statusUpdate')->name('order.statusUpdate');

    // Route::put('updateData/order', 'Dashboard\OrderController@updateData')->name('order.updateData');

    Route::get('status_change/{model}/{id}/{status}', 'Dashboard\PublicController@statusChange')->name('status_change');

    Route::post('sorting_change/{model}/{id}', 'Dashboard\PublicController@sortingChange')->name('sortingChange');



    Route::get('site_review', 'Dashboard\SiteReviewController@index')->name('site_review.index');
    Route::post('site_review/create', 'Dashboard\SiteReviewController@create')->name('site_review.create');

    Route::get('blacklist', 'Dashboard\BlackListController@index')->name('blacklist.index');
    Route::get('blacklist/create', 'Dashboard\BlackListController@create')->name('blacklist.create');
    Route::post('blacklist/store', 'Dashboard\BlackListController@store')->name('blacklist.store');
    Route::DELETE('blacklist/destroy/{id}', 'Dashboard\BlackListController@destroy')->name('blacklist.destroy');


    Route::get('site_reviews/approve/{id}', 'Dashboard\SiteReviewController@Approve')->name('site_review.approve');
    Route::get('site_reviews/reject/{id}', 'Dashboard\SiteReviewController@Reject')->name('site_review.reject');


    //export
    // Route::get('export/one_export', 'Dashboard\ExportController@one_export')->name('one_export');
    // Route::get('export/tow_export', 'Dashboard\ExportController@tow_export')->name('tow_export');
    // Route::get('export/three_export', 'Dashboard\ExportController@three_export')->name('three_export');
    // Route::get('export/four_export', 'Dashboard\ExportController@four_export')->name('four_export');
    // Route::get('export/special_order_export', 'Dashboard\ExportController@special_order_export')->name('special_order_export');
    // Route::get('export/phone_list', 'Dashboard\ExportController@phone_list_export')->name('phone_list.export');
    //export
});

Route::get('/test_sms', function() {

    // MN Test 
    // dd(senSMS('966559693305','Heloo'));

    // Abukhaled test
    dd(senSMS('966566661105','الرسايل الان تعمل بنجاح ... شكرا لك ، تحياتي'));


});

Route::get('/get_balance', function() {
    dd(getSmsBalance());

    // $vNumber = validNumber($order->orderUser->phone);

    //     $sms_msg = "عزيزي العميل تم استلام طلبكم رقم (".$order->order_no.")" ;

        // $send =  senSMS('966556963305', 'ازيك يا هندسة');

        // print($send);
      //  echo senSMS('966556963305', 'ازيك يا هندسة'); // 200

    //    dd( $send);

        // if( $send['statusCode'] == '201' ){

        //     dd( $send);

        // }else {

        //     dd('noooooooooo');
        // }

});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
     Artisan::call('view:clear');
    // Artisan::call('config:clear');
    return redirect()->back()->with('success', 'تم حذف الكاش بنجاح');
})->name('clear_cache');



Route::get('/test-sms', function() {
    // dd(smsBalance());
    $new_msg = " إنجاز فوري: رمز التفعيل الخاص بك : 111111" ;

    $send = senSMS('966556963305', $new_msg);
    dd($send);
});


Route::get('/send-email', function () {
    $details = [
        'title' => 'Mail from MyApp',
        'body' => 'This is a test email.'
    ];

    Mail::send([], [], function ($message) use ($details) {
        $message->to('eng.andrewwagih@gmail.com')
                ->subject($details['title'])
                ->setBody('<h1>' . $details['title'] . '</h1><p>' . $details['body'] . '</p>', 'text/html');
    });
    Mail::send([], [], function ($message) use ($details) {
        $message->to('mawad008@gmail.com')
                ->subject($details['title'])
                ->setBody('<h1>' . $details['title'] . '</h1><p>' . $details['body'] . '</p>', 'text/html');
    });
    

    return 'Email sent successfully!';
});
