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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    // role
    Route::get('role','RoleController@index');
    Route::get('role/getroles','RoleController@getroles');
    Route::post('createrole','RoleController@store')->name('addrole');
    Route::post('updaterole/{role_id}','RoleController@update');
    Route::post('deleterole/{role_id}','RoleController@destroy');

    // permission
    Route::get('permission','PermissionController@index');
    Route::get('permission/getpermissions','PermissionController@getpermissions');
    Route::post('createpermission','PermissionController@store')->name('addpermission');
    Route::post('updatepermission/{permission_id}','PermissionController@update');
    Route::post('deletepermission/{permission_id}','PermissionController@destroy');

    // role-permission
    Route::get('rolepermission','RupController@showrolepermissions');
    Route::get('getrolepermissions','RupController@getrolepermissions');
    Route::get('attachpr/{role_id}','RupController@attachprfrm');
    Route::post('attachpr/{role_id}','RupController@attachpermissiontorole');
    Route::get('detachpr/{role_id}','RupController@detachpermissiontorole');

    // role-user
    Route::get('roleuser','RupController@showroleuser');
    Route::get('getroleusers','RupController@getroleusers');
    Route::get('attachru/{user_id}','RupController@attachrufrm');
    Route::post('attachru/{user_id}','RupController@attachroleuser');
    Route::get('detachru/{user_id}','RupController@detachroleuser');

    //kategori berita
    Route::get('kategori','KategoriBerita@index');
    Route::get('getkategori','KategoriBerita@show');
    Route::post('addkat','KategoriBerita@store')->name('addkat');
    Route::post('updatekat/{kat_id}','KategoriBerita@update');
    Route::post('deletekat/{kat_id}','KategoriBerita@destroy');

    //dashboard berita
    Route::get('dashberita','BeritaController@index');
    Route::get('getberitadashboard','BeritaController@getberita');
    Route::get('createberita','BeritaController@create');
    Route::post('createberita','BeritaController@store');
    Route::get('updateberita/{slug}','BeritaController@show');
    Route::post('updateberita/{slug}','BeritaController@edit');
    Route::post('deleteberita/{id}','BeritaController@destroy');
    Route::post('publishberita/{id}','BeritaController@update');

    // visimisi
    Route::get('visimisi','DashboardController@show');
    Route::post('visimisi','DashboardController@store');

    //kontak
    Route::get('kontak','DashboardController@kontak');
    Route::post('kontak','DashboardController@create');

    //kategori fasilitas
    Route::get('dash-fas','DashboardController@showdashfas');
    Route::get('getkategorifasilitas','DashboardController@showkategorifasilitas');
    Route::post('addkatfas','DashboardController@addkatfas')->name('addkatfas');
    Route::post('updatekatfas/{kat_Id}','DashboardController@updatekatfas');
    Route::post('deletekatfas/{kat_id}','DashboardController@destroy');
    
    //faslitas
    Route::get('dashboard-fasilitas','DashboardController@showfasilitas');
    Route::get('getfasilitas','DashboardController@getfasilitas');
    Route::post('fasilitas','DashboardController@createfasilitas');
    Route::post('updatefasilitas/{id}','DashboardController@updatefasilitas');
    Route::post('dashboard-fasilitas/{id}','DashboardController@deletefas');

    // Route::get('dashboard-bidang')
});

