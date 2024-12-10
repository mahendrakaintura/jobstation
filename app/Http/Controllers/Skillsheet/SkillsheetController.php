<?php

namespace App\Http\Controllers\Skillsheet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Response;

class SkillsheetController extends Controller
{
    public function show(): Response
    {
        try {
            $config = [
                'basic_info' => config('constants.basic_info'),
                'self_analysis' => config('constants.self_analysis')
            ];

            dd([
                'path' => config_path('constants/self_analysis.php'),
                'config' => $config
            ]);

            return Inertia::render('Skillsheet/Show', [
                'constants' => $config,
                'user' => auth()->user()->load('workExperiences'),
                'temporaryData' => session('temporary_skillsheet')
            ]);
        } catch (\Exception $e) {
            Log::error('Error in showSkillsheet', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            try {
                $validated = $request->validate([
                    'basicInfo' => 'required|array',
                    'basicInfo.name' => 'required|string|max:255',
                    'basicInfo.initial' => 'required|string|max:255',
                    'basicInfo.age' => 'required|integer|min:18|max:90',
                    'basicInfo.sex' => 'required|in:man,woman',
                    'basicInfo.nationality' => 'required|string',
                    'basicInfo.years_of_experience' => 'required|integer|min:0|max:55',
                    'basicInfo.address' => 'required|string',
                    'basicInfo.education' => 'required|string',
                    'basicInfo.pr' => 'nullable',
                    'basicInfo.train_line' => 'required|string',
                    'basicInfo.station' => 'required|string',
                    'basicInfo.desired_area' => 'required|integer|min:1|max:48',
                    'basicInfo.desired_start' => 'required|integer|min:1|max:12',
                    'basicInfo.desired_price' => 'required|integer|min:1|max:9',
                    'basicInfo.desired_remote' => 'required|integer|min:1|max:3',
                    'basicInfo.desired_work' => 'array',
                    'basicInfo.desired_work.*' => 'nullable|string',
                    'basicInfo.desired_language' => 'nullable',
                    'basicInfo.desired_place' => 'nullable',
                    'basicInfo.desired_others' => 'nullable',
                    'basicInfo.self_analysis' => 'nullable|array',
                    'basicInfo.self_analysis.*' => 'nullable|integer|min:1|max:10',
                    'experiences' => 'required|array|max:5',
                    'experiences.*.project_title' => 'required|string|max:255',
                    'experiences.*.period' => 'required|string|max:255',
                    'experiences.*.description' => 'required|string',
                    'experiences.*.framework' => 'nullable|string',
                    'experiences.*.frontend' => 'nullable|string',
                    'experiences.*.backend' => 'nullable|string',
                    'experiences.*.server' => 'nullable|string',
                    'experiences.*.database' => 'nullable|string',
                    'experiences.*.tool' => 'nullable|string',
                    'experiences.*.middleware' => 'nullable|string',
                    'experiences.*.os' => 'nullable|string',
                    'experiences.*.others' => 'nullable|string'
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                Log::error('Validation failed:', [
                    'errors' => $e->errors(),
                    'data' => [
                        'pr' => $request->input('basicInfo.pr'),
                        'desired_language' => $request->input('basicInfo.desired_language'),
                        'desired_place' => $request->input('basicInfo.desired_place'),
                        'desired_others' => $request->input('basicInfo.desired_others')
                    ]
                ]);
                throw $e;
            }
            $user = Auth::user();
            $user->update([
                'name' => $validated['basicInfo']['name'],
                'initial' => $validated['basicInfo']['initial'],
                'age' => $validated['basicInfo']['age'],
                'sex' => $validated['basicInfo']['sex'],
                'nationality' => $validated['basicInfo']['nationality'],
                'years_of_experience' => $validated['basicInfo']['years_of_experience'],
                'address' => $validated['basicInfo']['address'],
                'education' => $validated['basicInfo']['education'],
                'pr' => $validated['basicInfo']['pr'],
                'train_line' => $validated['basicInfo']['train_line'],
                'station' => $validated['basicInfo']['station'],
                'desired_start' => $validated['basicInfo']['desired_start'],
                'desired_area' => $validated['basicInfo']['desired_area'],
                'desired_price' => $validated['basicInfo']['desired_price'],
                'desired_remote' => $validated['basicInfo']['desired_remote'],
                'desired_work' => $validated['basicInfo']['desired_work'],
                'desired_language' => $validated['basicInfo']['desired_language'],
                'desired_place' => $validated['basicInfo']['desired_place'],
                'desired_others' => $validated['basicInfo']['desired_others'],
                'self_analysis' => $validated['basicInfo']['self_analysis']
            ]);

            $user->workExperiences()->delete();

            foreach ($validated['experiences'] as $index => $experience) {
                $user->workExperiences()->create([
                    'branch_id' => 1,
                    'display_order' => $index + 1,
                    'project_title' => $experience['project_title'],
                    'period' => $experience['period'],
                    'description' => $experience['description'],
                    'framework' => $experience['framework'] ?? null,
                    'frontend' => $experience['frontend'] ?? null,
                    'backend' => $experience['backend'] ?? null,
                    'server' => $experience['server'] ?? null,
                    'database' => $experience['database'] ?? null,
                    'tool' => $experience['tool'] ?? null,
                    'middleware' => $experience['middleware'] ?? null,
                    'os' => $experience['os'] ?? null,
                    'others' => $experience['others'] ?? null
                ]);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Skillsheet store error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            throw $e;
        }
    }
}
