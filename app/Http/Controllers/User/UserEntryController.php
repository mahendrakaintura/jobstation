<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Inertia\Response;
use Inertia\Inertia;

class UserEntryController extends Controller
{
    public function index(): Response
    {
        $user = auth()->user();
        $entries = $user->entries()->with('project')->latest()->get();
        return Inertia::render('Mypage/Entry', [
            'entries' => $entries,
            'flash' => [
            'message' => session('alert')
        ]
        ]);
    }

    public function cancel(Request $request): JsonResponse
    {
        $data = $request->validate(['entry_id' => 'required|integer']);
        $user = auth()->user();
        $cancelled = $user->entries()
            ->where('id', $data['entry_id'])
            ->where('status_id', 1)
            ->update(['status_id' => 2]);
        if ($cancelled) {
            return response()->json(['message' => 'エントリーを取り消しました。']);
        }
        return response()->json(['message' => 'エントリーが見つかりません。'], 404);
    }
}
