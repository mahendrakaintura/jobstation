<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; 
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class AuthenticatedSessionController extends Controller
{
   public function create(): Response
   {
       return Inertia::render('Auth/Login', [
           'canResetPassword' => Route::has('password.request'),
           'status' => session('status'),
       ]);
   }

   public function store(LoginRequest $request): RedirectResponse
   {
       $request->authenticate();

       if ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail()) {
           Auth::guard('web')->logout();
           return redirect()->route('login')->withErrors([
               'email' => 'メールアドレスの認証が必要です。確認メールをご確認ください。',
           ]);
       }

       $request->session()->regenerate();

       Log::info('Login session check:', [
           'entry_project_id' => session('entry_project_id'),
           'intended' => session('url.intended'),
           'all' => session()->all()
       ]);

       return redirect()->intended(route('entry.skillsheet'));
   }

   public function destroy(Request $request): RedirectResponse
   {
       Auth::guard('web')->logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return redirect('/');
   }

   protected function authenticated(Request $request, $user)
   {
       if (empty($user->name)) {
           return redirect()->route('entry.skillsheet');
       }

       if ($request->session()->has('entry_project_id')) {
           return redirect()->route('entry.skillsheet');
       }

       return redirect()->intended(route('home'));
   }
}