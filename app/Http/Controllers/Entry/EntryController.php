<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Controllers\Skillsheet\SkillsheetController;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Inertia\Response as InertiaResponse;


class EntryController extends Controller
{
    public function start(Request $request, Project $project): RedirectResponse
    {
        $request->session()->put('entry_project_id', $project->id);
        if (Auth::check()) {
            return redirect()->route('entry.skillsheet');
        }
        return redirect()->route('login');
    }

    public function startRegister(Request $request, Project $project): RedirectResponse
    {
        $request->session()->put('entry_project_id', $project->id);
        return redirect()->route('register');
    }

    public function showSkillSheet(): InertiaResponse|RedirectResponse
    {
        try {
            $projectId = session('entry_project_id');
            if (!$projectId) {
                return redirect()->route('home')->with('error', '応募情報が見つかりません。');
            }
            $basicInfo = config('constants.basic_info');
            return Inertia::render('Entry/Skillsheet', [
                'project' => Project::findOrFail($projectId),
                'user' => auth()->user()->load('workExperiences'),
                'temporaryData' => session('temporary_skillsheet'),
                'constants' => array_merge(
                    $basicInfo,
                    ['self_analysis' => config('constants.self_analysis')]
                )
            ]);
        } catch (\Exception $e) {
            Log::error('Error in showSkillsheet', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    public function temporarySave(Request $request): JsonResponse
    {
        $data = $request->validate([
            'skillsheet' => 'required|array'
        ]);
        session(['temporary_skillsheet' => $data['skillsheet']]);
        return response()->json([
            'success' => true,
            'message' => '入力内容を一時保存しました。'
        ]);
    }

    public function submit(Request $request): HttpResponse
    {
        try {
            $projectId = session('entry_project_id');
            if (!$projectId) {
                throw new \Exception('Project ID not found in session');
            }

            $skillsheetController = new SkillsheetController();
            $skillsheetController->store($request);
            $entry = new \App\Models\Entry([
                'user_id' => Auth::id(),
                'project_id' => $projectId,
                'status_id' => 1
            ]);

            $entry->save();
            session()->forget(['entry_project_id', 'temporary_skillsheet']);
            return redirect()->route('entry.complete');
        } catch (\Exception $e) {
            Log::error('Entry submission error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors([
                'message' => 'エントリーの登録に失敗しました',
                'system' => $e->getMessage()
            ])->with('error', 'エントリーの登録に失敗しました');
        }
    }

    public function backToProject(): RedirectResponse
    {
        $projectId = session('entry_project_id');
        if (!$projectId) {
            return redirect()->route('home');
        }
        return redirect()->route('projects.show', $projectId);
    }

    public function complete(): InertiaResponse
    {
        return Inertia::render('Entry/Complete');
    }
}