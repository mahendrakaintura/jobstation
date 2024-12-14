<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class NewPasswordController extends Controller
{

    public function create(Request $request): Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            $tokenData = DB::table('user_password_reset_tokens')
                ->where('email', $request->email)
                ->whereRaw('LOWER(token) = ?', [strtolower($request->token)])
                ->first();

            if (!$tokenData) {
                throw ValidationException::withMessages([
                    'email' => 'トークンが無効です。',
                ]);
            }

            if (now()->diffInMinutes($tokenData->created_at) > 60) {
                DB::table('user_password_reset_tokens')
                    ->where('email', $request->email)
                    ->delete();
                throw ValidationException::withMessages([
                    'email' => 'トークンの有効期限が切れています。',
                ]);
            }

            DB::table('users')
                ->where('email', $request->email)
                ->update([
                    'password' => Hash::make($request->password),
                ]);

            DB::table('user_password_reset_tokens')
                ->where('email', $request->email)
                ->delete();

            return redirect()->route('login')->with('status', 'パスワードを再設定しました。');
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'パスワードの再設定に失敗しました。',
            ]);
        }
    }
}
