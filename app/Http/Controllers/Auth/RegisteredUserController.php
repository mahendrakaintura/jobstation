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
use Illuminate\Support\Facades\Auth;

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
            // Validation
            $validatedData = $request->validate([
                'email' => [
                    'required',
                    'string',
                    'lowercase',
                    'email:rfc,dns',
                    'max:255',
                    'unique:' . User::class
                ],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'max:32',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
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

            $user = User::create([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'nationality' => $validatedData['nationality'] === 'その他'
                    ? $validatedData['other_nationality']
                    : $validatedData['nationality'],
            ]);
            
            // Convert the User model to an array
            $userData = $user->toArray();  // Convert User model object to array
            
            // Send confirmation email
            Mail::to($user->email)->send(new RegistrationConfirmation($userData));  // Pass the array instead of the User object
            
            // Optionally log the user in
            Auth::login($user);
            
            return redirect()->route('home'); // Redirect to the home page or another route
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Registration error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors(['email' => '登録処理中にエラーが発生しました。']);
        }
    }
}
