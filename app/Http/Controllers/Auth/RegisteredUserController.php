<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\RegistrationConfirmation;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    protected $messages = [
        'email.required' => 'メールアドレスは必須です',
        'email.email' => '有効なメールアドレスを入力してください',
        'email.unique' => 'このメールアドレスは既に登録されています',
        'password.regex' => 'パスワードは大文字、小文字、数字、特殊文字を含む必要があります',
        'nationality.in' => '無効な国籍が選択されています',
        'other_nationality.regex' => '国籍は文字のみ使用可能です'
    ];

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => [
                    'required',
                    'string',
                    'lowercase',
                    'email:rfc,dns',
                    'max:255',
                    'unique:' . User::class,
                    'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
                ],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'max:32',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                    Rules\Password::defaults()
                ],
                'nationality' => [
                    'required',
                    'string',
                    'in:日本,その他'
                ],
                'other_nationality' => [
                    'nullable',
                    'string',
                    'required_if:nationality,その他',
                    'regex:/^[a-zA-Zぁ-んァ-ン一-龥\s]+$/'
                ]
            ], $this->messages);

            $userData = [
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'nationality' => $validatedData['nationality'] === 'その他'
                    ? $validatedData['other_nationality']
                    : $validatedData['nationality'],
            ];

            Mail::to($userData['email'])->send(new RegistrationConfirmation($userData));

            return back();
        } catch (\Exception $e) {
            Log::error('Registration error:', ['error' => $e->getMessage()]);
            return back()->withErrors(['email' => '登録処理中にエラーが発生しました。']);
        }
    }
}
