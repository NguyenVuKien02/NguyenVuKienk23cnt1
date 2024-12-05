<?php

use App\Http\Controllers\NamedProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Routes view kết nối với NVK.Blade.php
Route::get('/VuKien', function () {
    return view('NVK');
});
Route::get('/hello', function () {
    return 'Nguyễn Vũ Kiên';
});
Route::get('/devmaster', function () {
    return '<h1>Welcome to, Devmaster Academy!<h1>';
});
//Redirect Routes
Route::redirect('/here','/there');
Route::get('/there', function () {
    return '<h1>redirect: here to there<h1>';
});
//Required Parameters lấy $id truyền xuống sau devmaster
Route::get('/id/{id}', function ($id) {
    return '<h1>Devmaster '.$id;
});
Route::get('/posts/{post}/comments/{comment}', function ($postid, $commentid) {
    return '<h1> Post: $postid ; Comments: $commentid';
});
Route::get('/user/{id}', function (Request $request, $id) {
    return '<h1> user ->'.$id;
});
//Optional Parameters
Route::get('/dev/{name}', function ($name = null) {
    return "<h1>Welcome to, $name";
});
Route::get('/user-dev/{name?}', function ($name = 'vcl') {
    return "<h1>Welcome to, $name";
});
//Regular Expression Constraints xác định số hay chữ
Route::get('/user-constraint/{name}', function ($name) {
    return "<h1> Route Constraint [A-Za-z]+";
})->where('name', '[A-Za-z]+');
Route::get('/user-constraint/{id}', function ($id) {
    return "<h1> Route Constraint [0-9]+";
})->where('id', '[0-9]+');
Route::get('/user-constraint/{id}/{name}', function ($id, $name) {
    return "<h1> Route Constraint ['id' => '[0-9]+', 'name' => '[A-Za-z]+']";
})->where(['id' => '[0-9]+', 'name' => '[A-Za-z]+']);
Route::get('/user-check/{id}/{name}', function ($id, $name) {
    return "<h1> user check where Number('id')->whereAlpha('name')[$id, $name] ";
})->whereNumber('id')->whereAlpha('name');
Route::get('/user-check/{name}', function ($name) {
    return "<h1> user check whereAlphaNumeric('name') => [$name] ";
})->whereAlphaNumeric('name');
Route::get('/user-check/{id}', function ($id) {
    return "<h1> user check whereUuid('id') => [$id] ";
})->whereUuid('id');
//endcoded Foward Slashes
Route::get('/search/{search}', function ($search) {
    return "<h1> Tham số trên url là unicode: $search ";
})->where('search','.*');
//named routes
Route::get('/named/profile', function () {
    return "<h1> Đặt tên Routes ";
})->name('named.profile');
Route::get('/named/display',
            [NamedProfileController::class, 'display']
)->name('display.profile');
Route::get('/named/show',[NamedProfileController::class, 'show']);
//Route Group prefix
Route::group(['prefix'=>'admin'],function(){
    Route::get('/',function(){return "<h1> Admin home";});
    Route::get('/account',function(){return "<h1> Admin account";});
    Route::get('/product',function(){return "<h1> Admin product";});
});
