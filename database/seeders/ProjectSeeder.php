<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Laravelを使用した不動産システムの開発',
                'period' => '3ヶ月〜',
                'working_hours' => '10:00-19:00（休憩1h）',
                'workplace' => '東京都渋谷区',
                'display_price' => '750,000円',
                'skills' => 'PHP8.x, Laravel9.x, React.js, MySQL, AWS',
                'summary' => '大手不動産会社の物件管理システムの開発案件です。Laravelをメインに使用し、フロントエンドはReact.jsで実装します。',
                'head_count' => '1名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('101'),           
                'start' => bindec('0'),             
                'erea' => bindec('1100'),           
                'remote' => bindec('101'),          
                'business' => bindec('1010'),       
                'work' => bindec('11'),             
                'frontend' => bindec('101'),
                'backend' => bindec('0'),
                'framework' => bindec('1001'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'AIを活用した画像認識システムの開発',
                'period' => '6ヶ月〜',
                'working_hours' => '9:00-18:00（休憩1h）',
                'workplace' => '大阪府大阪市',
                'display_price' => '850,000円',
                'skills' => 'Python3.x, Django, TensorFlow, AWS, Docker',
                'summary' => '大手メーカーの画像認識システム開発案件です。機械学習の知識をお持ちの方歓迎です。',
                'head_count' => '2名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('110'),        
                'start' => bindec('11'),         
                'erea' => bindec('11001'),       
                'remote' => bindec('110'),       
                'business' => bindec('1011'),    
                'work' => bindec('10'),          
                'frontend' => bindec('10'),      
                'backend' => bindec('1'),        
                'framework' => bindec('1010'),   
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'グローバルECサイトのフロントエンド開発',
                'period' => '12ヶ月〜',
                'working_hours' => 'フレックス制',
                'workplace' => 'フルリモート',
                'display_price' => '950,000円',
                'skills' => 'React, TypeScript, Next.js, GraphQL',
                'summary' => 'グローバル展開するECサイトのフロントエンド開発です。英語でのコミュニケーションが必要です。',
                'head_count' => '3名',
                'monthly_working_hours' => '140時間/月',
                'price' => bindec('111'),        
                'start' => bindec('10'),         
                'erea' => bindec('101111'),      
                'remote' => bindec('111'),       
                'business' => bindec('1100'),    
                'work' => bindec('11'),          
                'frontend' => bindec('101'),     
                'backend' => bindec('1011'),     
                'framework' => bindec('1011'),   
                'is_only_japanese' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pythonを使用したAI画像解析システムの開発',
                'period' => '6ヶ月〜',
                'working_hours' => '9:00-18:00（休憩1h）',
                'workplace' => '大阪府大手前',
                'display_price' => '850,000円',
                'skills' => 'Python3.x, TensorFlow, React.js, PostgreSQL, GCP',
                'summary' => '大手メーカーの製品検査における画像解析システムの開発案件です。バックエンドはPythonで機械学習処理を実装し、フロントエンドはReact.jsで直感的なUI/UXを実現します。',
                'head_count' => '2名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('110'),           
                'start' => bindec('101'),           
                'erea' => bindec('11001'),          
                'remote' => bindec('110'),          
                'business' => bindec('1100'),       
                'work' => bindec('10'),             
                'frontend' => bindec('101'),        
                'backend' => bindec('1'),           
                'framework' => bindec('1011'),      
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Rubyを使用したECサイトのフルリニューアル開発',
                'period' => '12ヶ月〜',
                'working_hours' => '9:00-18:00（休憩1h）',
                'workplace' => '東京都品川区',
                'display_price' => '650,000円',
                'skills' => 'Ruby3.x, Ruby on Rails7.x, Vue.js, MySQL, AWS',
                'summary' => '大手アパレルブランドのECサイトフルリニューアル案件です。既存システムをRuby on Railsで刷新し、モダンな購買体験を実現します。',
                'head_count' => '3名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('100'),           
                'start' => bindec('11'),            
                'erea' => bindec('1100'),           
                'remote' => bindec('101'),          
                'business' => bindec('1001'),       
                'work' => bindec('11'),             
                'frontend' => bindec('10'),         
                'backend' => bindec('10'),          
                'framework' => bindec('1100'),      
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kotlinによるフィンテックアプリの開発',
                'period' => '6ヶ月〜',
                'working_hours' => '10:00-19:00（休憩1h）',
                'workplace' => '福岡県博多区',
                'display_price' => '800,000円',
                'skills' => 'Kotlin, Spring Boot, TypeScript, PostgreSQL, GCP',
                'summary' => 'FinTechスタートアップの投資管理アプリケーション開発案件です。Kotlinでのバックエンド開発がメインです。',
                'head_count' => '2名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('110'),           
                'start' => bindec('1000'),          
                'erea' => bindec('100110'),         
                'remote' => bindec('110'),
                'business' => bindec('1010'),
                'work' => bindec('10'),
                'frontend' => bindec('11'),         
                'backend' => bindec('1000'),        
                'framework' => bindec('1001'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Go言語によるマイクロサービス開発',
                'period' => '9ヶ月〜',
                'working_hours' => '9:30-18:30（休憩1h）',
                'workplace' => '愛知県名古屋市',
                'display_price' => '900,000円',
                'skills' => 'Go, Docker, Kubernetes, React.js, MongoDB',
                'summary' => '大手物流会社の配送管理システムをマイクロサービス化する案件です。Goでのバックエンド開発とKubernetesでのインフラ構築を担当していただきます。',
                'head_count' => '4名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('111'),           
                'start' => bindec('10'),            
                'erea' => bindec('10101'),          
                'remote' => bindec('111'),
                'business' => bindec('1110'),
                'work' => bindec('11'),
                'frontend' => bindec('101'),        
                'backend' => bindec('110'),         
                'framework' => bindec('1011'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'PHPによるCMSプラットフォーム開発',
                'period' => '4ヶ月〜',
                'working_hours' => '9:00-18:00（休憩1h）',
                'workplace' => '大阪府梅田',
                'display_price' => '550,000円',
                'skills' => 'PHP8.x, Laravel, Vue.js, MySQL, AWS',
                'summary' => '複数のメディアサイトに対応可能な汎用CMSの開発案件です。Laravelをベースに拡張性の高いシステムを構築します。',
                'head_count' => '2名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('11'),            
                'start' => bindec('110'),           
                'erea' => bindec('11001'),          
                'remote' => bindec('101'),
                'business' => bindec('1001'),
                'work' => bindec('10'),
                'frontend' => bindec('10'),         
                'backend' => bindec('0'),           
                'framework' => bindec('1010'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pythonによる自然言語処理システム開発',
                'period' => '8ヶ月〜',
                'working_hours' => '10:00-19:00（休憩1h）',
                'workplace' => '東京都渋谷区',
                'display_price' => '1,000,000円',
                'skills' => 'Python, PyTorch, FastAPI, Angular, PostgreSQL',
                'summary' => 'チャットボット開発プロジェクトです。自然言語処理エンジンの開発からフロントエンドまで一貫して担当していただきます。',
                'head_count' => '2名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('1000'),          
                'start' => bindec('1'),             
                'erea' => bindec('1100'),           
                'remote' => bindec('110'),
                'business' => bindec('1111'),
                'work' => bindec('11'),
                'frontend' => bindec('100'),        
                'backend' => bindec('1'),           
                'framework' => bindec('1101'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'C#によるゲーム開発プロジェクト',
                'period' => '12ヶ月〜',
                'working_hours' => '11:00-20:00（休憩1h）',
                'workplace' => '京都府下京区',
                'display_price' => '750,000円',
                'skills' => 'C#, Unity, TypeScript, MongoDB, Azure',
                'summary' => 'スマートフォン向けソーシャルゲームの開発案件です。UnityとC#を使用したゲーム開発経験者を募集しています。',
                'head_count' => '3名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('101'),           
                'start' => bindec('1001'),          
                'erea' => bindec('11000'),          
                'remote' => bindec('100'),
                'business' => bindec('1100'),
                'work' => bindec('10'),
                'frontend' => bindec('11'),         
                'backend' => bindec('101'),         
                'framework' => bindec('1110'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'JavaによるクラウドPOS開発',
                'period' => '6ヶ月〜',
                'working_hours' => '9:00-18:00（休憩1h）',
                'workplace' => '福岡県天神',
                'display_price' => '600,000円',
                'skills' => 'Java17, Spring Boot, Vue.js, Oracle, AWS',
                'summary' => '小売チェーン向けクラウド型POSシステムの開発案件です。Javaでのバックエンド開発が中心となります。',
                'head_count' => '4名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('100'),           
                'start' => bindec('111'),           
                'erea' => bindec('100110'),         
                'remote' => bindec('101'),
                'business' => bindec('1010'),
                'work' => bindec('11'),
                'frontend' => bindec('10'),         
                'backend' => bindec('11'),          
                'framework' => bindec('1001'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Node.jsによるリアルタイム配信プラットフォーム開発',
                'period' => '9ヶ月〜',
                'working_hours' => '10:00-19:00（休憩1h）',
                'workplace' => '東京都港区',
                'display_price' => '850,000円',
                'skills' => 'Node.js, Socket.IO, React.js, MongoDB, GCP',
                'summary' => 'ライブ配信プラットフォームの開発案件です。WebSocketを使用したリアルタイム通信の実装が主な業務となります。',
                'head_count' => '3名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('110'),           
                'start' => bindec('11'),            
                'erea' => bindec('1100'),           
                'remote' => bindec('110'),
                'business' => bindec('1111'),
                'work' => bindec('10'),
                'frontend' => bindec('101'),        
                'backend' => bindec('1011'),        
                'framework' => bindec('1100'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Swiftによるヘルスケアアプリ開発',
                'period' => '5ヶ月〜',
                'working_hours' => '9:30-18:30（休憩1h）',
                'workplace' => '神奈川県横浜市',
                'display_price' => '700,000円',
                'skills' => 'Swift, SwiftUI, Firebase, Node.js',
                'summary' => '健康管理アプリのiOS版開発案件です。ヘルスケアデータの連携や分析機能の実装を担当していただきます。',
                'head_count' => '2名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('101'),           
                'start' => bindec('101'),           
                'erea' => bindec('1011'),           
                'remote' => bindec('111'),
                'business' => bindec('1001'),
                'work' => bindec('11'),
                'frontend' => bindec('11'),         
                'backend' => bindec('1001'),        
                'framework' => bindec('1010'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Rustによる高性能トレーディングシステム開発',
                'period' => '12ヶ月〜',
                'working_hours' => '10:00-19:00（休憩1h）',
                'workplace' => '東京都千代田区',
                'display_price' => '1,200,000円',
                'skills' => 'Rust, WebAssembly, React.js, PostgreSQL, AWS',
                'summary' => '証券会社向け次世代トレーディングプラットフォームの開発案件です。Rustでの高性能なバックエンド実装が求められます。',
                'head_count' => '2名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('1000'),          
                'start' => bindec('1010'),          
                'erea' => bindec('1100'),           
                'remote' => bindec('101'),
                'business' => bindec('1110'),
                'work' => bindec('11'),
                'frontend' => bindec('101'),        
                'backend' => bindec('111'),         
                'framework' => bindec('1111'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Djangoによる教育プラットフォーム開発',
                'period' => '7ヶ月〜',
                'working_hours' => '9:00-18:00（休憩1h）',
                'workplace' => '大阪府心斎橋',
                'display_price' => '600,000円',
                'skills' => 'Python, Django, Vue.js, MySQL, GCP',
                'summary' => 'オンライン教育プラットフォームの開発案件です。動画配信システムやインタラクティブな教材機能の実装を行います。',
                'head_count' => '3名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('100'),           
                'start' => bindec('0'),             
                'erea' => bindec('11001'),          
                'remote' => bindec('110'),
                'business' => bindec('1001'),
                'work' => bindec('10'),
                'frontend' => bindec('10'),         
                'backend' => bindec('1'),           
                'framework' => bindec('1011'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kotlinによるモバイル決済アプリ開発',
                'period' => '8ヶ月〜',
                'working_hours' => '10:00-19:00（休憩1h）',
                'workplace' => '東京都新宿区',
                'display_price' => '800,000円',
                'skills' => 'Kotlin, Android SDK, Spring Boot, PostgreSQL, Firebase',
                'summary' => 'QRコード決済アプリの開発案件です。Android端末向けのネイティブアプリ開発がメインとなります。',
                'head_count' => '2名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('110'),           
                'start' => bindec('11'),            
                'erea' => bindec('1100'),           
                'remote' => bindec('101'),
                'business' => bindec('1110'),
                'work' => bindec('11'),
                'frontend' => bindec('11'),         
                'backend' => bindec('1000'),        
                'framework' => bindec('1100'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Go言語による IoTプラットフォーム開発',
                'period' => '10ヶ月〜',
                'working_hours' => '9:30-18:30（休憩1h）',
                'workplace' => '京都府京都市',
                'display_price' => '950,000円',
                'skills' => 'Go, gRPC, React.js, TimescaleDB, AWS',
                'summary' => '製造業向けIoTプラットフォームの開発案件です。センサーデータの収集・分析基盤の構築を行います。',
                'head_count' => '3名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('111'),           
                'start' => bindec('110'),           
                'erea' => bindec('11000'),          
                'remote' => bindec('111'),
                'business' => bindec('1101'),
                'work' => bindec('10'),
                'frontend' => bindec('101'),        
                'backend' => bindec('110'),         
                'framework' => bindec('1010'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'PHPによるECサイト管理システム開発',
                'period' => '6ヶ月〜',
                'working_hours' => '9:00-18:00（休憩1h）',
                'workplace' => '愛知県名古屋市',
                'display_price' => '650,000円',
                'skills' => 'PHP8.x, Laravel, Nuxt.js, MySQL, AWS',
                'summary' => '複数ECモール一元管理システムの開発案件です。在庫・受注管理機能の実装を担当していただきます。',
                'head_count' => '2名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('100'),           
                'start' => bindec('1001'),          
                'erea' => bindec('10101'),          
                'remote' => bindec('101'),
                'business' => bindec('1001'),
                'work' => bindec('11'),
                'frontend' => bindec('10'),         
                'backend' => bindec('0'),           
                'framework' => bindec('1011'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pythonによるデータ分析基盤開発',
                'period' => '9ヶ月〜',
                'working_hours' => '10:00-19:00（休憩1h）',
                'workplace' => '福岡県博多区',
                'display_price' => '700,000円',
                'skills' => 'Python, Pandas, Apache Spark, React.js, BigQuery',
                'summary' => '小売業向けデータ分析基盤の開発案件です。大規模データの収集・加工パイプラインの構築を行います。',
                'head_count' => '3名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('101'),           
                'start' => bindec('10'),            
                'erea' => bindec('100110'),         
                'remote' => bindec('110'),
                'business' => bindec('1111'),
                'work' => bindec('10'),
                'frontend' => bindec('101'),        
                'backend' => bindec('1'),           
                'framework' => bindec('1101'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Javaによる基幹システム刷新',
                'period' => '12ヶ月〜',
                'working_hours' => '9:00-18:00（休憩1h）',
                'workplace' => '東京都中央区',
                'display_price' => '850,000円',
                'skills' => 'Java17, Spring Boot, Angular, Oracle, Azure',
                'summary' => '金融機関の基幹システムリプレイス案件です。レガシーシステムのモダン化プロジェクトに参画いただきます。',
                'head_count' => '5名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('110'),           
                'start' => bindec('100'),           
                'erea' => bindec('1100'),           
                'remote' => bindec('101'),
                'business' => bindec('1010'),
                'work' => bindec('11'),
                'frontend' => bindec('100'),        
                'backend' => bindec('11'),          
                'framework' => bindec('1001'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'TypeScriptによるSaaSプラットフォーム開発',
                'period' => '7ヶ月〜',
                'working_hours' => '10:00-19:00（休憩1h）',
                'workplace' => '福岡県天神',
                'display_price' => '750,000円',
                'skills' => 'TypeScript, Next.js, NestJS, PostgreSQL, AWS',
                'summary' => 'HR Tech系スタートアップのSaaS開発案件です。TypeScriptでのフルスタック開発を担当していただきます。',
                'head_count' => '3名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('101'),           
                'start' => bindec('1000'),          
                'erea' => bindec('100110'),         
                'remote' => bindec('111'),
                'business' => bindec('1100'),
                'work' => bindec('10'),
                'frontend' => bindec('11'),         
                'backend' => bindec('11'),          
                'framework' => bindec('1110'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'C#によるゲームバックエンド開発',
                'period' => '8ヶ月〜',
                'working_hours' => '11:00-20:00（休憩1h）',
                'workplace' => '東京都渋谷区',
                'display_price' => '900,000円',
                'skills' => 'C#, ASP.NET Core, Redis, MongoDB, Azure',
                'summary' => 'スマートフォンゲームのバックエンド開発案件です。リアルタイム通信処理の実装やインフラ構築を担当していただきます。',
                'head_count' => '2名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('111'),           
                'start' => bindec('1'),             
                'erea' => bindec('1100'),           
                'remote' => bindec('110'),
                'business' => bindec('1111'),
                'work' => bindec('11'),
                'frontend' => bindec('10'),         
                'backend' => bindec('101'),         
                'framework' => bindec('1100'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Rustによるブロックチェーンプラットフォーム開発',
                'period' => '10ヶ月〜',
                'working_hours' => '10:00-19:00（休憩1h）',
                'workplace' => '大阪府梅田',
                'display_price' => '1,100,000円',
                'skills' => 'Rust, WebAssembly, React.js, PostgreSQL, AWS',
                'summary' => 'ブロックチェーン技術を活用した新規プラットフォームの開発案件です。スマートコントラクトの実装や高度な暗号化処理を担当していただきます。',
                'head_count' => '2名',
                'monthly_working_hours' => '160時間/月',
                'price' => bindec('1000'),          
                'start' => bindec('111'),           
                'erea' => bindec('11001'),          
                'remote' => bindec('111'),
                'business' => bindec('1110'),
                'work' => bindec('11'),
                'frontend' => bindec('101'),        
                'backend' => bindec('111'),         
                'framework' => bindec('1111'),
                'is_only_japanese' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
