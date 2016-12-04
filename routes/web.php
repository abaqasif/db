<?php

use App\Salesmen;
use App\User;
use App\Page;
use App\Stock;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\App;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//WELCOME PAGE BEFORE LOGGED IN 

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


//HOME PAGE AFTER LOGGED IN 

Route::get('/home', 'HomeController@index')->middleware('isAdmin'); //if admin
Route::get('/home_user', 'HomeController@home_user'); //if user
Route::get('/show_own_right', 'UserController@show_own_right');


//ADMIN FUNCTIONS
Route::get('/edit_user_form', 'adminController@edit_user_form')->middleware('isAdmin');
Route::get('/register_user_form', 'adminController@register_user_form')->middleware('isAdmin');
Route::get('/delete_user_form', 'adminController@delete_user_form')->middleware('isAdmin');

Route::post('/register_user','adminController@register_user');
Route::post('/edit_user', 'adminController@edit_user');

Route::post('/delete_user', 'adminController@delete_user');

Route::get('/show_user', 'adminController@show_user')->middleware('isAdmin');

Route::get('/search_user', 'adminController@search_user')->middleware('isAdmin');
Route::get('/search', 'adminController@search')->middleware('isAdmin');




Route::get('/create_page_form', 'adminController@create_page_form')->middleware('isAdmin');
Route::post('/create_page', 'adminController@create_page')->middleware('isAdmin');

Route::get('/edit_page_form', 'adminController@edit_page_form')->middleware('isAdmin');
Route::post('/edit_page', 'adminController@edit_page');

Route::get('/delete_page_form', 'adminController@delete_page_form')->middleware('isAdmin');
Route::post('/delete_page', 'adminController@delete_page');

Route::get('/show_page', 'adminController@show_page')->middleware('isAdmin');

Route::get('/search_page', 'adminController@search_page')->middleware('isAdmin');
Route::get('/p_search', 'adminController@p_search')->middleware('isAdmin');
Route::get('/page_details', 'adminController@page_details')->middleware('isAdmin');




Route::get('/create_right_form', 'adminController@create_right_form')->middleware('isAdmin');
Route::post('/create_right', 'adminController@create_right')->middleware('isAdmin');

Route::get('/edit_right_form', 'adminController@edit_right_form')->middleware('isAdmin');
Route::post('/edit_right', 'adminController@edit_right');

Route::get('/delete_right_form', 'adminController@delete_right_form')->middleware('isAdmin');
Route::post('/delete_right', 'adminController@delete_right');

Route::get('/show_right', 'adminController@show_right')->middleware('isAdmin');

Route::get('/search_right', 'adminController@search_right')->middleware('isAdmin');
Route::get('/r_search', 'adminController@r_search')->middleware('isAdmin');


//PURCHASE MODULE
/*Route::get('/purchase_home', 'PurchasesController@purchase_home')->middleware('purchase_access');*/


//RAW MATERIALS
Route::get('/create_raw_materials_form', 'PurchasesController@create_raw_materials_form')->middleware('page_access');
Route::post('/create_raw_materials', 'PurchasesController@create_raw_materials')->middleware('page_access');
Route::get('/show_raw_materials','PurchasesController@show_raw_materials')->middleware('page_access');
Route::post('/delete_raw_materials','PurchasesController@delete_raw_materials')->middleware('page_access');
Route::get('/edit_raw_material_form','PurchasesController@edit_raw_material_form')->middleware('page_access');
Route::post('/edit_raw_material','PurchasesController@edit_raw_material')->middleware('page_access');
Route::get('/rm_det', 'PurchasesController@rm_det')->middleware('page_access');


//SUPPLIERS
Route::get('/create_suppliers_form','PurchasesController@create_suppliers_form')->middleware('page_access');
Route::post('/create_suppliers','PurchasesController@create_suppliers')->middleware('page_access');
Route::get('/show_suppliers','PurchasesController@show_suppliers')->middleware('page_access');
Route::post('/delete_suppliers','PurchasesController@delete_suppliers')->middleware('page_access');
Route::post('/edit_supplier_form','PurchasesController@edit_supplier_form')->middleware('page_access');
Route::post('/edit_supplier','PurchasesController@edit_supplier')->middleware('page_access');
Route::get('/supp_det', 'PurchasesController@supp_det')->middleware('page_access');




//PURCHASE ORDER AND PURCHASE ORDER LINES

Route::get('/create_purchases_form','PurchasesController@create_purchases_form')->middleware('page_access');
Route::get('/supplier_rm','PurchasesController@supplier_rm')->middleware('page_access');
Route::get('/rm_name_det','PurchasesController@rm_name_det')->middleware('page_access');
Route::post('/create_purchase_order', 'PurchasesController@create_purchase_order')->middleware('page_access');
Route::post('/create_purchase_order_line', 'PurchasesController@create_purchase_order_line')->middleware('page_access');
Route::get('/printInvoice/{id}', 'PurchasesController@printInvoice')->middleware('page_access');


Route::get('/payments/{id}', 'PurchasesController@payments')->middleware('page_access');
Route::get('/view_purchase_order','PurchasesController@show_purchases')->middleware('page_access');

Route::get('/view_purchase_order_details/{id}','PurchasesController@show_purchase_order_details')->middleware('page_access');

Route::get('/delete_purchase_order_details/{id}','PurchasesController@delete_purchase_order_details')->middleware('page_access');

Route::get('/delete_purchase_order/{id}','PurchasesController@delete_purchase_order')->middleware('page_access');

Route::get('/create_purchase_receipt','PurchasesController@create_purchase_receipt')->middleware('page_access');

Route::get('/create_purchase_return','PurchasesController@create_purchase_return')->middleware('page_access');


Route::get('/purchase_order_dreport/{date}','PurchasesController@purchase_order_dreport')->middleware('page_access');
Route::get('/purchase_order_greport','PurchasesController@purchase_order_greport')->middleware('page_access');






Route::get('/view_purchase_receipt','PurchasesController@view_purchase_receipt')->middleware('page_access');

Route::get('/invoice_purchase_receipt/{id}','PurchasesController@invoice_purchase_receipt')->middleware('page_access');

Route::get('/invoice_purchase_return/{id}','PurchasesController@invoice_purchase_return')->middleware('page_access');


Route::get('/invoice_group_purchase_receipt/{id}','PurchasesController@invoice_group_purchase_receipt')->middleware('page_access');

Route::get('/invoice_group_purchase_return/{id}','PurchasesController@invoice_group_purchase_return')->middleware('page_access');


Route::get('/purchase_return_dreport/{date}','PurchasesController@purchase_return_dreport')->middleware('page_access');

Route::get('/purchase_receipt_dreport/{date}','PurchasesController@purchase_receipt_dreport')->middleware('page_access');


Route::get('/view_purchase_return','PurchasesController@view_purchase_return')->middleware('page_access');
Route::get('/test','PurchasesController@show_test');


Route::get('/delete_purchase_receipt/{id}','PurchasesController@delete_purchase_receipt')->middleware('page_access');
Route::get('/delete_purchase_return/{id}','PurchasesController@delete_purchase_return')->middleware('page_access');
Route::get('/purchase_order_det_edit','PurchasesController@purchase_order_det_edit')->middleware('page_access');
Route::post('/edit_purchase_order_det','PurchasesController@edit_purchase_order_det')->middleware('page_access');



Route::post('/post_create_payments','PurchasesController@post_create_payments')->middleware('page_access');
Route::get('/outstanding_payments_report','PurchasesController@outstanding_payments_report')->middleware('page_access');

Route::get('/view_purchase_payments','PurchasesController@view_purchase_payments')->middleware('page_access');

Route::get('/delete_purchase_payments/{id}','PurchasesController@delete_purchase_payments')->middleware('page_access');

Route::get('/purchase_payments_det','PurchasesController@purchase_payments_det')->middleware('page_access');

Route::post('/update_purchase_payments','PurchasesController@update_purchase_payments')->middleware('page_access');



Route::get('/raw_materials_ledger_report/{id}','PurchasesController@raw_materials_ledger_report')->middleware('page_access');

Route::get('/payment_voucher/{id}','PurchasesController@payment_voucher')->middleware('page_access');


Route::get('/list_of_suppliers','PurchasesController@list_of_suppliers')->middleware('page_access');

Route::get('/payables_ledger/{dateto}/{datefrom}','PurchasesController@payables_ledger')->middleware('page_access');

Route::get('/rm_ageing_report','PurchasesController@rm_ageing_report')->middleware('page_access');




/*--------------------------------------------------------*/
/*--------------------------------------------------------*/
/*--------------------------------------------------------*/
/*--------------------------------------------------------*/




/*UROOOSA'S ROUTES FOR PRODUCTION MODULE AND FINISHED GOODS INVENTORY*/

Route::resource('/inventory','InventoryController');
Route::resource('/production/recipe', 'RecipeController');
Route::resource('/production/batch', 'BatchController');
Route::resource('/production/batch/{batch}/tests','Test');
Route::resource('/production/recipe/{recipe}/rm','RMController');
Route::resource('/production/batch/{batch}/fill', 'FillingController');
Route::resource('/production/wastage','WastageController');


Route::get('/production', 'ProductionController@home');

//batch stuff
Route::get('/production/batch/{batch}/update_home', 'BatchController@update_home');
Route::post('/production/batch/{batch}/update_rm', 'BatchController@update_rm');
Route::get('/production/batch/{batch}/update_add/{raw_material}', 'BatchController@update_add');
Route::get('/production/batch/{batch}/complete_batch', 'BatchController@complete_batch');
Route::get('/production/batch/{batch}/update_header', 'BatchController@update_header');
Route::patch('/production/batch/{batch}/header_update_store', 'BatchController@header_update_store');
Route::patch('/production/batch/{batch}/update_add/{raw_material}/rm_update_store', 'BatchController@rm_update_store');
Route::post('/production/batch/{batch}/add_rm', 'BatchController@additional_rm');
Route::get('/production/batch/{batch}/del_rm/{raw_material}', 'BatchController@delete_rm');
Route::get('/production/batch/{batch}/del_update/{raw_material}', 'BatchController@delete_update');
Route::post('/production/batch/{batch}/done', 'BatchController@batch_done');

//Filling of a batch
Route::get('/production/batch/{batch}/lock_filling', 'FillingController@lock');
Route::get('/production/batch/{batch}/fill', 'FillingController@home');

//Batch Test
//Route::get('/production/batch/{batch}/tests/create_home', 'Test@lock');


//Items
Route::get('/production/item', 'ItemController@home');
Route::post('/production/item/rtrv', 'ItemController@rtrv_item');

//Inventory
Route::get('/inventory' , 'InventoryController@index');
Route::post('/inventory/transfer' , 'InventoryController@transfer_to_warehouse');

//Recipe
Route::get('/production/recipe/{recipe}/update', 'RecipeController@update_home');
Route::get('/production/recipe/{recipe}/rm_list', 'RecipeController@rm_list');
Route::post('/production/recipe/{recipe}/update_done', 'RecipeController@update_recipe_done');
Route::get('/production/recipe/{recipe}/{raw_material_id}/delete', 'RecipeController@delete_rm');
Route::get('/production/recipe/{recipe}/add_rm', 'RMController@add_rm');

//Reports
Route::get('production/dpr', 'ReportController@dpr_home');
Route::post('production/dpr_get', 'ReportController@get_dpr');
Route::get('production/mixing_paper/select_batch', 'ReportController@mixing_home');
Route::post('production/mixing_paper', 'ReportController@get_mixing_paper');
Route::get('production/mixing_cost/select_batch', 'ReportController@mixing_cost_home');
Route::post('production/mixing_paper_cost', 'ReportController@get_mixing_cost');


////////////////////////////         SALES          //////////////////////////////////
Route::get('/home', 'HomeController@index');
Route::resource('/users','userController');
Route::resource('/pages','PageController');
Route::resource('/access','PageAccessController');
Route::resource('/salesmen','SalesmenController');
Route::resource('/party','PartyController');
Route::resource('/stock','StockController');
Route::resource('/order','SalesController');
Route::resource('/return','ReturnController');
Route::resource('/payment','payController');

//        Sales Order report
Route::get('/order/report/{id}', function ($id) {
    $orders = \App\Sales_order::findOrFail($id);
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadView('reports.order',compact('orders'));
    return $pdf->stream();
})->name('order');


//        Sales Return report
Route::get('/return/report/{id}', function ($id) {
    $orders = \App\Goods_return::findOrFail($id);
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadView('reports.return',compact('orders'));
    return $pdf->stream();
})->name('return');


//        Sales Ledger report
Route::get('/party/report/{id}', function ($id) {
    $party = \App\Party::findOrFail($id);
 //   return $party->payment;
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadView('reports.sales_ledger',compact('party'));
    return $pdf->stream();
})->name('sales_ledger');

//        Sales route report
Route::get('/salesmen/report/{id}', function ($id) {
//    return 'asd';
    $sm = Salesmen::all();
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadView('reports.route',compact('sm'));
    return $pdf->stream();
})->name('route');

