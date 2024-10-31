<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//管理画面
Route::namespace('admin')
	->name('admin.')
	->prefix('admin')
	//->middleware('')
	->group(function() {

		Route::get('/', fn () => 'adminログイン画面')->name('login');	//ログイン画面

		//メール送信テスト用
		Route::get('mail', function () {
			Mail::raw('test mail',function ($message) {$message->to('test@to.com')->subject('test subject');});
			return 'テストメール送信完了。';
		});

		//マッチしなかったURLは全てログイン画面へリダイレクト
		Route::any('{all}', fn () => Redirect::route('admin.login')->setStatusCode(RedirectResponse::HTTP_SEE_OTHER));

	});