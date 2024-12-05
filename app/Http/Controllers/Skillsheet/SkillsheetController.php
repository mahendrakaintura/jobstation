<?php

namespace App\Http\Controllers\Skillsheet;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class SkillsheetController extends Controller
{
    public function show(): Response
    {
        try {
            $config = config('constants.basic_info');
            dd([
                'config_path' => config_path('constants/basic_info.php'),
                'file_exists' => file_exists(config_path('constants/basic_info.php')),
                'config_content' => $config
            ]);
        } catch (\Exception $e) {
            dd('Error:', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
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
            'basicInfo.train_line' => 'required|string',
            'basicInfo.station' => 'required|string',
            'basicInfo.desired_price' => 'required|integer|min:1|max:9',
            'basicInfo.desired_start' => 'required|integer|min:1|max:12',
            'basicInfo.desired_remote' => 'required|integer|min:1|max:3',
            'basicInfo.desired_work' => 'array',
            'basicInfo.desired_language' => 'array',
            'basicInfo.desired_area' => 'required|integer|min:1|max:48',
            'experiences' => 'required|array|max:5',
            'experiences.*.project_title' => 'required|string|max:255',
            'experiences.*.period' => 'required|string|max:255',
            'experiences.*.description' => 'required|string|max:255',
        ]);

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
            'train_line' => $validated['basicInfo']['train_line'],
            'station' => $validated['basicInfo']['station'],
            'desired_price' => $validated['basicInfo']['desired_price'],
            'desired_start' => $validated['basicInfo']['desired_start'],
            'desired_remote' => $validated['basicInfo']['desired_remote'],
            'desired_work' => $validated['basicInfo']['desired_work'],
            'desired_language' => $validated['basicInfo']['desired_language'],
            'desired_area' => $validated['basicInfo']['desired_area'],
        ]);

        $user->workExperiences()->delete();
        foreach ($validated['experiences'] as $index => $experience) {
            $user->workExperiences()->create([
                'branch_id' => 1,
                'display_order' => $index + 1,
                'project_title' => $experience['project_title'],
                'period' => $experience['period'],
                'description' => $experience['description'],
            ]);
        }

        $projectId = session('entry_project_id');
        if ($projectId) {
            $project = Project::findOrFail($projectId);

            Entry::create([
                'user_id' => $user->id,
                'project_id' => $projectId,
                'status_id' => 1,
                'project_title' => $project->title,
                'project_period' => $project->period,
                'project_working_hours' => $project->working_hours,
                'project_workplace' => $project->workplace,
                'project_price' => $project->display_price,
                'project_skills' => json_encode([
                    'frontend' => $project->frontend,
                    'backend' => $project->backend,
                    'framework' => $project->framework,
                    'database' => $project->database
                ]),
                'project_summary' => $project->summary,
                'project_head_count' => $project->head_count,
                'project_monthly_working_hours' => $project->monthly_working_hours
            ]);

            session()->forget(['entry_project_id', 'temporary_skillsheet']);
            return redirect()->route('entry.complete');
        }
    }
}
