<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//ログイン画面
Route::get('/login/_sales', fn () => '営業ログイン画面')->name('sales.login');		//営業
Route::get('/login/_admin', fn () => '管理者ログイン画面')->name('admin.login');	//管理者


//営業
Route::namespace('sales')
	->name('sales.')
	->prefix('sales')
	//->middleware('')
	->group(function() {

	});

//管理者
Route::namespace('admin')
	->name('admin.')
	->prefix('admin')
	//->middleware('')
	->group(function() {

		
		//メール送信テスト用
		// Route::get('mail', function () {
		// 	Mail::raw('test mail',function ($message) {$message->to('test@to.com')->subject('test subject');});
		// 	return 'テストメール送信完了。';
		// });

	});

//マッチしなかったURLはトップ画面へリダイレクト
Route::any('{all}', fn () => Redirect::to('/', RedirectResponse::HTTP_SEE_OTHER));