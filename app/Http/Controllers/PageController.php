<?php

namespace App\Http\Controllers;

use Inertia\Inertia; // Inertia class ko import karen

class PageController extends Controller
{
    // About page ko render karne wala method
    public function about()
    {
        // Inertia ko render karte hue 'About' component ko pass karenge
        return Inertia::render('About', [
            'content' => 'ジョブステーションとは、あなたのキャリアをサポートするサービスです。',
        ]);
    }
}
