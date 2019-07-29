<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|a
*/


Route::get('/', function () {
	    return view('login');
	});
Route::post('/', 'AdminController@login');
Route::group(['middleware' => 'CustomAuthUser'], function(){
	Route::get('/user', 'UserController@dashboard');
	Route::get('/user/laporan/','UserController@list');
	Route::get('/user/profile/data/{nim}','UserController@input');
	Route::post('/user/profile/data/{nim}','UserController@save');
	Route::get('/user/profile/data/','UserController@delete');
	Route::get('/user/report/data/{nomor}', 'UserController@inputreport');
	Route::post('/user/report/data/{nomor}', 'UserController@savereport');
	Route::get('/user/report/data/delete/{nomor}/{nip}', 'UserController@deletereport');
	Route::get('/download/{nomor}','SuratController@download');
	Route::get('/user/surat','SuratController@listsuratuser');
	Route::get('/user/download/{nomor}','SuratController@download');
	Route::get('/user/download/laporan/{nomor}/{file}','SuratController@downloadlaporan');
	Route::get('/user/report/','UserController@listreport');
	Route::get('/user/data/pegawai/{nim}', 'UserController@inputdatadiri');
	Route::post('/user/data/pegawai/{nim}', 'UserController@savedatadiri');
	});


Route::group(['middleware' => 'CustomAuth'], function(){
	Route::get('/admin',function () {
	    return view('admin.dashboard');
	});
	Route::get('/admin/user/report/', 'AdminController@listreport');
	Route::get('/admin/user/report/data/{nomor}', 'AdminController@inputreport');
	Route::post('/admin/user/report/data/{nomor}', 'AdminController@savereport');
	Route::get('/admin/user/report/data/delete/{nomor}/{nip}', 'AdminController@deletereport');
	Route::get('/admin/list/pegawai','AdminController@list');
	Route::get('/admin/data/pegawai/{nim}', 'AdminController@input');
	Route::post('/admin/data/pegawai/{nim}', 'AdminController@save');
	Route::get('/admin/list/pegawai/delete/{nim}', 'AdminController@delete');
	Route::get('/admin/arsip','SuratController@list');
	Route::get('/admin/surat/jenis', 'AdminController@listjenis');
	Route::get('/admin/surat/jenis/{kode}', 'AdminController@inputjenis');
	Route::post('/admin/surat/jenis/{kode}', 'AdminController@savejenis');
	Route::get('/admin/surat/jenis/delete/{kode}', 'AdminController@deletejenis');
	Route::get('/admin/surat/data/{nomor}', 'SuratController@input');
	Route::post('/admin/surat/data/{nomor}', 'SuratController@save');
	Route::get('/admin/arsip/delete/{nomor}', 'SuratController@deletesurat');
	Route::get('/admin/surat/penerima', 'SuratController@listpenerima');
	Route::get('/admin/surat/penerima/data/{nomor}', 'SuratController@inputpenerima');
	Route::post('/admin/surat/penerima/data/{nomor}', 'SuratController@savepenerima');
	Route::get('/admin/surat/penerima/delete/{nomor}', 'SuratController@deletepenerima');
	Route::get('/admin/unit','AdminController@listsekretariat');
	Route::get('/admin/unit/data/{kode}', 'AdminController@inputsekretariat');
	Route::post('/admin/unit/data/{kode}', 'AdminController@savesekretariat');
	Route::get('/admin/unit/delete/{kode}', 'AdminController@deletesekretariat');
	Route::get('/admin/user/surat','AdminController@listsuratuser');
	Route::get('/admin/penugasan/','AdminController@listpenugasan');
	Route::get('/admin/penugasan/list/{nomor}','AdminController@listlaporanpenugasan');
	Route::get('/download/{nomor}','SuratController@download');
	// Route::get('/admin/user/list/penugasan/', 'UserController@listsurattugasuser');
	// Route::get('/admin/user/report/','UserController@listreport');
	Route::get('/download/laporan/{nomor}/{file}','SuratController@downloadlaporan');
	Route::get('/kirimemail','SuratController@kirimemail');
});

Route::group(['middleware' => 'CustomAuthAdminUnit'], function(){
	Route::get('/adminunit', 'AdminUnitController@listdashboard');
	Route::get('/adminunit/arsip', 'AdminUnitController@list');
	Route::get('/adminunit/download/{nomor}','SuratController@download');
	Route::get('/adminunit/user/surat','AdminUnitController@listsuratuser');
	Route::get('/adminunit/user/report/','AdminUnitController@listreport');
	Route::get('/adminunit/user/report/data/{nomor}', 'AdminUnitController@inputreport');
	Route::post('/adminunit/user/report/data/{nomor}', 'AdminUnitController@savereport');
	Route::get('/adminunit/user/report/data/delete/{nomor}/{nip}', 'AdminUnitController@deletereport');
	Route::get('/adminunit/data/pegawai/{nim}', 'AdminUnitController@inputdatadiri');
	Route::post('/adminunit/data/pegawai/{nim}', 'AdminUnitController@savedatadiri');
});
Route::get('/logout', 'AdminController@logout');