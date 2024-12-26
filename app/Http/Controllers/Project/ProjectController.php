<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\CheckItem;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Project::query();

        if ($request->filled('area')) {
            $bitNumber = $request->get('area');
            $query->where('area', $bitNumber); 
        }

        if ($request->filled('display_price')) {
            $bitNumber = $request->get('display_price');
            $query->where('price', $bitNumber);
        }

        if ($request->filled('language')) {
            $filterData = explode('_', $request->get('language'));
            if (count($filterData) === 2) {
                $groupId = (int)$filterData[0];
                $bitNumber = (int)$filterData[1];
                
                $column = ($groupId === 7) ? 'frontend' : 'backend';
                $query->where($column, $bitNumber);
            }
        }

        if ($request->filled('skill_search')) {
            $skillSearch = $request->get('skill_search');
            $query->where('skills', 'LIKE', '%' . $skillSearch . '%');
        }

        if ($request->filled('start')) {
            $bitNumber = $request->get('start');
            $query->where('start', $bitNumber);
        }

        if ($request->get('sort') === 'display_price_high') {
            $query->orderByRaw('CAST(REPLACE(REPLACE(display_price, ",", ""), "¥", "") AS UNSIGNED) DESC');
        } else {
            $query->latest('created_at');
        }

        if ($request->filled('last_id')) {
            $lastId = $request->get('last_id');
            $query->where('id', '<', $lastId);
        }
        $projects = $query->with('favoriteUsers')
        ->take(10)
        ->get()
        ->map(function ($project) {
            return $project->append('is_favorited');
        });

        return Inertia::render('Projects/Index', [
            'projects' => $projects,
            'hasMore' => $projects->count() === 10,
            'filters' => $request->only([
                'area',
                'display_price',
                'language',
                'skill_search',
                'start',
                'sort'
            ]),
            'filterOptions' => [
                'areas' => CheckItem::where('check_item_group_id', 3)
                        ->pluck('display_name', 'bit_number'),
                'prices' => CheckItem::where('check_item_group_id', 1)
                        ->pluck('display_name', 'bit_number'),
                'languages' => [
                        'frontend' => CheckItem::where('check_item_group_id', 7)
                                ->orderBy('display_rank')
                                ->get(['bit_number', 'display_name'])
                                ->mapWithKeys(function($item) {
                                    return ["7_{$item->bit_number}" => $item->display_name];
                                }),
                        'backend' => CheckItem::where('check_item_group_id', 8)
                                ->orderBy('display_rank')
                                ->get(['bit_number', 'display_name'])
                                ->mapWithKeys(function($item) {
                                    return ["8_{$item->bit_number}" => $item->display_name];
                                }),
                    ],
                'starts' => CheckItem::where('check_item_group_id', 2)
                            ->pluck('display_name', 'bit_number'),
            ]
        ]);
    }

    public function show(Project $project): Response
    {
        $project->append('is_favorited');
        return Inertia::render('Projects/Show', [
            'project' => $project
        ]);
    }
}