<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\UserFavoriteProject;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index(): Response
    {
        $user = auth()->user();
        $projects = $user->favoriteProjects()->get();
        return Inertia::render('Mypage/Favorite', [
            'projects' => $projects
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $data = $request->validate([
            'project_ids' => 'required|array',
            'project_ids.*' => 'integer|exists:projects,id'
        ]);
        $validIds = UserFavoriteProject::whereIn('project_id', $data['project_ids'])->where('user_id', Auth::id())->pluck('project_id');
        $deleted = UserFavoriteProject::whereIn('project_id', $validIds)->delete();
        if ($deleted) {
            return response()->json(['message' => 'お気に入り案件を削除しました。', 'count' => $deleted, 'deletedIds' => $validIds]);
        }
        return response()->json(['message' => 'お気に入り案件を削除できません'], 404);
    }
}