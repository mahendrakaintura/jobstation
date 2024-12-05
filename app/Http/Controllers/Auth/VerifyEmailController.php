<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request)
    {
        Log::debug('Verification route hit', ['request' => $request->all()]);
        return $this->processVerification($request);
    }

    private function processVerification(Request $request)
    {
        try {
            if (!$request->hasValidSignature()) {
                Log::debug('Invalid signature detected');
                throw new \Exception('Invalid signature');
            }

            $userData = decrypt($request->data);
            $user = User::where('email', $userData['email'])->first();
            if (!$user) {
                $user = User::create([
                    'email' => $userData['email'],
                    'password' => $userData['password'],
                    'nationality' => $userData['nationality'],
                ]);
            }

            $user->markEmailAsVerified();
            Auth::login($user);
            $entryProjectId = session('entry_project_id');
            if ($entryProjectId) {
                return redirect()->route('entry.skillsheet');
            }

            return redirect()->route('home')->with('alert', [
                'message' => 'メールアドレスの認証が完了しました'
            ]);
        } catch (\Exception $e) {
            Log::error('Verification failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('register');
        }
    }
}