<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;  

class ProjectController extends Controller
{
    private const PRICE_OPTIONS = [
        1 => '20万〜30万',
        2 => '30万〜40万',
        3 => '40万〜50万',
        4 => '50万〜60万',
        5 => '60万〜70万',
        6 => '70万〜80万',
        7 => '80万〜90万',
        8 => '90万〜100万',
        9 => '100万〜150万'
    ];

    private const AREA_OPTIONS = [
        1 => '北海道',
        2 => '青森県',
        3 => '岩手県',
        4 => '宮城県',
        5 => '秋田県',
        6 => '山形県',
        7 => '福島県',
        8 => '茨城県',
        9 => '栃木県',
        10 => '群馬県',
        11 => '埼玉県',
        12 => '千葉県',
        13 => '東京都',
        14 => '山梨県',
        15 => '長野県',
        16 => '新潟県',
        17 => '富山県',
        18 => '石川県',
        19 => '福井県',
        20 => '岐阜県',
        21 => '静岡県',
        22 => '愛知県',
        23 => '三重県',
        24 => '滋賀県',
        25 => '京都府',
        26 => '大阪府',
        27 => '兵庫県',
        28 => '奈良県',
        29 => '和歌山県',
        30 => '鳥取県',
        31 => '島根県',
        32 => '岡山県',
        33 => '広島県',
        34 => '山口県',
        35 => '徳島県',
        36 => '香川県',
        37 => '愛媛県',
        38 => '高知県',
        39 => '福岡県',
        40 => '佐賀県',
        41 => '長崎県',
        42 => '熊本県',
        43 => '大分県',
        44 => '宮崎県',
        45 => '鹿児島県',
        46 => '沖縄県',
        47 => '外国',
        48 => 'フルリモート'
    ];

    private const FRONTEND_OPTIONS = [
        1 => 'HTML',
        2 => 'CSS',
        3 => 'JavaScript',
        4 => 'TypeScript',
        5 => 'Angular',
        6 => 'React.js',
        7 => 'jQuery',
        8 => 'Bootstrap',
        9 => 'Foundation',
        10 => 'Ember.js'
    ];

    private const BACKEND_OPTIONS = [
        1 => 'PHP',
        2 => 'Python',
        3 => 'Ruby',
        4 => 'Java',
        5 => 'C++',
        6 => 'C#',
        7 => 'Go',
        8 => 'Rust',
        9 => 'Kotlin',
        10 => 'Swift',
        11 => 'Perl',
        12 => 'NodeJS',
        13 => 'Scala',
        14 => 'COBOL',
        15 => 'FORTRAN',
        16 => 'BASIC',
        17 => 'Dart',
        18 => 'Elixir',
        19 => 'Haskell',
        20 => 'Groovy',
        21 => 'D言語',
        22 => 'アセンブリ言語',
        23 => 'Visual Basic',
        24 => 'VBScript',
        25 => 'Unity',
        26 => 'SQL',
        27 => 'Delphi',
        28 => 'MATLAB',
        29 => 'Google Apps Script',
        30 => 'ECMAScript',
        31 => 'Golo'
    ];

    private function getLanguageOptions(): array
    {
        return [
            'フロントエンド' => self::FRONTEND_OPTIONS,
            'バックエンド' => self::BACKEND_OPTIONS,
        ];
    }
    
    private const START_OPTIONS = [
        1 => '1月',
        2 => '2月',
        3 => '3月',
        4 => '4月',
        5 => '5月',
        6 => '6月',
        7 => '7月',
        8 => '8月',
        9 => '9月',
        10 => '10月',
        11 => '11月',
        12 => '12月',
    ];

    public function index(Request $request): Response
    {
        $query = Project::query();

        if ($request->filled('area')) {
            $areaCode = $request->get('area');
            $areaValue = decbin($areaCode - 1);
            $query->where('area', bindec($areaValue));
        }

        if ($request->filled('display_price')) {
            $priceCode = (int)$request->get('display_price');
            $priceValue = decbin($priceCode - 1);
            $query->where('price', bindec($priceValue));
        }

        if ($request->filled('language')) {
            $languageValue = $request->get('language');
            $type = substr($languageValue, 0, 1);
            $index = (int)substr($languageValue, 1);

            if ($type === 'f') {
                $query->where('frontend', $index);
            } else if ($type === 'b') {
                $query->where('backend', $index);
            }
        }

        if ($request->filled('start')) {
            $startCode = $request->get('start');
            $startValue = decbin($startCode - 1);
            $query->where('start', bindec($startValue));
        }

        if ($request->get('sort') === 'display_price_high') {
            $query->orderByRaw('CAST(REPLACE(REPLACE(display_price, ",", ""), "¥", "") AS UNSIGNED) DESC');
        } else {
            $query->latest('created_at');
        } 

        $projects = $query->paginate(20, ['*'], 'page', $request->get('page'));

        return Inertia::render('Projects/Index', [
            'projects' => $projects,
            'filters' => $request->only([
                'area',
                'display_price',
                'language',
                'start',
                'sort'
            ]),
            'filterOptions' => [
                'areas' => self::AREA_OPTIONS,
                'prices' => self::PRICE_OPTIONS,
                'languages' => [
                    'フロントエンド' => self::FRONTEND_OPTIONS,
                    'バックエンド' => self::BACKEND_OPTIONS
                ],
                'start_dates' => self::START_OPTIONS,
            ]
        ]);
    }

    public function show(Project $project, Request $request): Response
    {
        return Inertia::render('Projects/Show', [
            'project' => $project
        ]);
    }
}