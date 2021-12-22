<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CustomerReportController;

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

Route::get('/', function () {
    return view('auth.login');
});



Auth::routes();

//--------if i do not need registeration-----
// Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
});

Route::resource('invoices','InvoiceController');
Route::resource('sections','SectionController');
Route::resource('products','ProductController');
Route::resource('Archive', 'InvoiceAchiveController');
Route::resource('InvoiceAttachments', 'InvoiceAttachmentsController');

Route::get('/section/{id}','InvoiceController@getproducts');
Route::get('/InvoicesDetails/{id}','InvoiceDetailsController@edit');

Route::get('View_file/{invoice_number}/{file_name}', 'InvoiceDetailsController@open_file');
Route::get('download/{invoice_number}/{file_name}', 'InvoiceDetailsController@get_file');
Route::post('delete_file', 'InvoiceDetailsController@destroy')->name('delete_file');
Route::get('/edit_invoice/{id}', 'InvoiceController@edit');

Route::get('/Status_show/{id}', 'InvoiceController@show')->name('Status_show');
Route::post('/Status_Update/{id}', 'InvoiceController@Status_Update')->name('Status_Update');

Route::get('Invoice_Paid','InvoiceController@Invoice_Paid');
Route::get('Invoice_UnPaid','InvoiceController@Invoice_UnPaid');
Route::get('Invoice_Partial','InvoiceController@Invoice_Partial');

Route::get('Print_invoice/{id}','InvoiceController@Print_invoice');

Route::get('export_invoices', 'InvoiceController@export');

Route::get('invoices_report', 'ReportController@index');

Route::post('Search_invoices', 'ReportController@Search_invoices');

Route::get('customers_report', 'CustomerReportController@index')->name("customers_report");

Route::post('Search_customers', 'CustomerReportController@Search_customers');

Route::get('MarkAsRead_all','InvoiceController@MarkAsRead_all')->name('MarkAsRead_all');

Route::get('/{page}', 'AdminController@index');




