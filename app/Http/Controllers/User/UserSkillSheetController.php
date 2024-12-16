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
use Symfony\Component\HttpFoundation\Response as HttpResponse;


class UserSkillSheetController extends Controller
{
    public function edit(): InertiaResponse
    {
        try {
            $config = [
                'basic_info' => config('constants.basic_info'),
                'self_analysis' => config('constants.self_analysis')
            ];

            return Inertia::render('Mypage/Skillsheet', [
                'constants' => $config,
                'user' => auth()->user()->load('workExperiences'),
                'temporaryData' => session('temporary_skillsheet_edit'),
            ]);
        } catch (\Exception $e) {
            Log::error('Error in editSkillsheet', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function temporarySave(Request $request): JsonResponse
    {
        $data = $request->validate([
            'skillsheet' => 'required|array'
        ]);
        session(['temporary_skillsheet_edit' => $data['skillsheet']]);
        return response()->json([
            'success' => true,
            'message' => '入力内容を一時保存しました。'
        ]);
    }

    public function update(Request $request): HttpResponse
    {
        try {
            $skillsheetController = new SkillsheetController();
            $skillsheetController->store($request);
            session()->forget(['temporary_skillsheet_edit']);
            return redirect()->back()
                ->with('alert', 'スキルシートを更新しました。');
        } catch (\Exception $e) {
            return back()->withErrors([
                'message' => 'スキルシートの更新に失敗しました',
                'system' => $e->getMessage()
            ])->with('error', 'スキルシートの更新に失敗しました');
        }
    }
}
