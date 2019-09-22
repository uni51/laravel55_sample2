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

// ユーザー登録
Route::get('signup', 'SignupController@index')->name('signup.index');
Route::post('signup', 'SignupController@postIndex');
Route::get('signup/confirm', 'SignupController@confirm')->name('signup.confirm');
Route::post('signup/confirm', 'SignupController@postConfirm');
Route::get('signup/thanks', 'SignupController@thanks')->name('signup.thanks');


// 管理者
Route::prefix('admin')->namespace('Admin')->as('admin.')->group(function () {
    // ユーザー末認証の時にしか、アクセスできなくなる
    Route::middleware('guest:admin')->group(function () {
        // ログイン画面
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
    });

    // ユーザーが認証している時しかアクセスできなくなる
    Route::middleware('auth:admin')->group(function () {
        // ログアウト
        Route::get('logout', 'LoginController@logout')->name('logout');
        // 管理者画面TOP
        Route::get('', 'IndexController@index')->name('top');
    });

});