<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/',function(){
    return redirect()->route('home');

});

// Route::get('/nagaonlab', function () {
//     return view('auth.login');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//  Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('coll_center',[App\Http\Controllers\CollectionCenterController::class, 'index'])->name('collcenter');

	Route::get('investigation',[App\Http\Controllers\InvestigationController::class, 'index'])->name('investigation');

    //Route::get('patientdetails', [App\Http\Controllers\PatientDetailsController::class, 'dropdown'])->name('patientdetails_dropdown');
  Route::get('/patient-details', [App\Http\Controllers\PatientDetailsController::class, 'index'])->name('patientdetails');

    Route::get('referrer',[App\Http\Controllers\ReferrerController::class, 'index'])->name('referrer');
    Route:: get('add-permissions', [App\Http\Controllers\PermissionsController::class, 'index'])->name('add-permissions');


});
    Route::prefix('masters')->middleware('auth')->group(function () {

       //Route::get('/coll_center', [App\Http\Controllers\CollectionCenterController::class, 'create'])->name('collcenter');
        Route::put('/coll_center', [App\Http\Controllers\CollectionCenterController::class, 'store'])->name('coll_store');
        Route::get('/coll_center', [App\Http\Controllers\CollectionCenterController::class, 'index'])->name('coll_center_view');
        Route::delete('/coll_center/{id}', [App\Http\Controllers\CollectionCenterController::class, 'destroy'])->name('coll_center_deleted');
        Route::put('/add-patient-center', [App\Http\Controllers\PatientDetailsController::class, 'submitcenter'])->name('add-patient-center');
        Route::get('/edit-coll-center/{id}', [App\Http\Controllers\CollectionCenterController::class, 'edit'])->name('coll-center-edit');
        Route::put('/updated-coll-center/{id}', [App\Http\Controllers\CollectionCenterController::class, 'update'])->name('coll-center-updataed');

        Route::get('/edit-permissions/{id}', [App\Http\Controllers\PermissionsController::class, 'edit'])->name('edit-permissions');
        Route::put('/update-permissions/{id}', [App\Http\Controllers\PermissionsController::class, 'update'])->name('update-permissions');



        Route::put('/investigation',[App\Http\Controllers\InvestigationController::class, 'store'])->name('investigation_store');
        Route::delete('/investigation/{id}', [App\Http\Controllers\InvestigationController::class, 'destroy'])->name('investigation_delete');
        Route::get('/edit-investigation/{id}', [App\Http\Controllers\InvestigationController::class, 'edit'])->name('investigation-edit');
        Route::put('/update-investigation/{id}',[App\Http\Controllers\InvestigationController::class, 'update'])->name('update-investigation');

        Route::put('/referrer', [App\Http\Controllers\ReferrerController::class, 'store'])->name('referrer_view');
        Route::delete('/referrer/{id}', [App\Http\Controllers\ReferrerController::class, 'destroy'])->name('deleted_referrer');
        Route::get('/edit-referrer/{id}', [App\Http\Controllers\ReferrerController::class, 'edit'])->name('edit-referrer');
        Route::put('/update-referrer/{id}', [App\Http\Controllers\ReferrerController::class, 'update'])->name('update-referrer');

        Route::put('/add-patient-referrer',[App\Http\Controllers\PatientDetailsController::class, 'submit'])->name('add-patient-referrer');
        Route::put('/patient-details-view', [App\Http\Controllers\PatientDetailsController::class, 'store'])->name('patient-details-view');
        Route::get('/patient-details/{id}', [App\Http\Controllers\PatientDetailsController::class, 'view'])->name('patient-details-modal-view');

        Route::get('/edit-patient-details/{id}', [App\Http\Controllers\PatientDetailsController::class, 'edit'])->name('edit-patient-details');
       Route::put('/update-patient-details/{id}', [App\Http\Controllers\PatientDetailsController::class, 'update'])->name('update-patient-details');

        Route::get('/patient-details-receipt/{id}', [App\Http\Controllers\PatientDetailsController::class, 'show'])->name('patient-details-receipt');
        Route::delete('/patient-details/{id}',[App\Http\Controllers\PatientDetailsController::class, 'destroy'])->name('patient-details-delete');

        Route::get('/add-patient-details',[App\Http\Controllers\PatientDetailsController::class, 'home'])->name('add-patient-details');
        Route::get('/case-receipt/{id}' ,[App\Http\Controllers\PatientDetailsController::class, 'receipt'])->name('case-receipt');
        Route::put('/add-new-test/{id}', [App\Http\Controllers\PatientDetailsController::class, 'view'])->name('add-new-test');

        Route::get('/edit-status/{id}',  [App\Http\Controllers\PatientDetailsController::class, 'editstatus'])->name('edit-status');
        Route::put('/update-new-status/{id}', [App\Http\Controllers\PatientDetailsController::class, 'UpdateStatus'])->name('update-new-status');

        Route::get('/add-new-test/{id}', [App\Http\Controllers\PatientDetailsController::class, 'addNewTest'])->name('add-new-test');
        Route::put('/add-new-test-old-case', [App\Http\Controllers\PatientDetailsController::class, 'addNewCase'])->name('add-new-test-old-case');

        Route::get('/collection-agents', [App\Http\Controllers\CollectionAgentController::class, 'index'])->name('collectionAgents');
        // Route::get('/collection-agents-view', [App\Http\Controllers\CollectionAgentController::class, 'dropdown'])->name('collectionAgentsview');
        Route::put('/collectionAgents', [App\Http\Controllers\CollectionAgentController::class, 'store'])->name('collectionAgents-add');
        Route::delete('/collection-Agents/{id}', [App\Http\Controllers\CollectionAgentController::class,'destroy'])->name('collection-Agent-deleted');
        Route::put('/add-patient-agent', [App\Http\Controllers\PatientDetailsController::class, 'submitagent'])->name('add-patient-agent');
        Route::get('/edit-coll-agents/{id}', [App\Http\Controllers\CollectionAgentController::class, 'edit'])->name('edit-coll-agents');
        Route::put('/update-coll-agents/{id}', [App\Http\Controllers\CollectionAgentController::class, 'update'])->name('collection-agent-update');
        //  refreshdropdown
        Route::get('/ajax-referrer-all',[App\Http\Controllers\PatientDetailsController::class, 'getreferrer'])->name('ajax-referrer-all');
        Route::get('/ajax-center-all', [App\Http\Controllers\PatientDetailsController::class, 'getcenter'])->name('ajax-center-all');
        Route::get('/ajax-agent-all', [App\Http\Controllers\PatientDetailsController::class, 'getagent'])->name('ajax-agent-all');
    });

    Route::prefix('reports')->middleware('auth')->group(function(){
        Route::get('/collections-report', [App\Http\Controllers\ReportController::class, 'index'])->name('collections-report');
        Route::get('/test-count-report', [App\Http\Controllers\ReportController::class, 'viewTestCount'])->name('test-count-report');


    });

    Route::get('/recharge-wallet',[App\Http\Controllers\PaymentController::class,'index'])->name('recharge-wallet');
    Route::post('/order_id_generate', [App\Http\Controllers\PaymentController::class, 'orderIdGenerate'])->name('order_id_generate');
    Route::get('payment', [App\Http\Controllers\PaymentController::class, 'paymentIndex'])->name('payment');
    Route::post('/store-payment', [App\Http\Controllers\PaymentController::class, 'storePayment'])->name('store-payment');


    Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    // Route::get('profile-view', ['as' => 'profile.view', 'uses' => 'App\Http\Controllers\ProfileController@index']);

    Route::prefix('reports')->middleware('auth')->group(function () {
        Route::get('/collections-report', [App\Http\Controllers\ReportController::class, 'index'])->name('collections-report');
        Route::get('/test-count-report', [App\Http\Controllers\ReportController::class, 'viewTestCount'])->name('test-count-report');
    });

    Route::prefix('price')->middleware('auth')->group(function () {
        Route::get('/index', [App\Http\Controllers\PriceListController::class, 'index'])->name('price.list.index');
        Route::get('/add-items', [App\Http\Controllers\PriceListController::class, 'addItems'])->name('price.list.add-items');
    });
});
