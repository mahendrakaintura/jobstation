<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Skillsheet\SkillsheetController;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Inertia\Response as InertiaResponse;


class UserSkillSheetController extends Controller
{
    public function edit(): InertiaResponse
    {
        try {
            $config = [
                'basic_info' => config('constants.basic_info'),
                'self_analysis' => config('constants.self_analysis')
            ];

            return Inertia::render('Entry/Skillsheet', [
                'constants' => $config,
                'user' => auth()->user()->load('workExperiences'),
                'temporaryData' => session('temporary_skillsheet'),
                'isMypage' => true
            ]);
        } catch (\Exception $e) {
            Log::error('Error in showSkillsheet', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $skillsheetController = new SkillsheetController();
            $skillsheetController->store($request);
            return response()->json(['message' => 'スキルシートを更新しました。']);
        } catch (\Exception $e) {
            return back()->withErrors([
                'message' => 'スキルシートの更新に失敗しました',
                'system' => $e->getMessage()
            ])->with('error', 'スキルシートの更新に失敗しました');
        }
    }
}
