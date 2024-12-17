<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スキルシート</title>
    <link rel="stylesheet" href=" asset('css/app.css') ">
    <style>
        @font-face {
            font-family: ipaexg;
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path('fonts/ipaexg.ttf') }}");
        }
        body {
            font-family: ipaexg, sans-serif;
            font-size: small;
        }

        tr, td {
            text-align: center;
            border: 1px solid;
        }
        table {
            border-collapse: collapse;
        }
        tr.top {
            border: none;
        }
        .top td {
            border: none !important;
        }
    </style>
</head>
<body>
    <table>
        <tr class="top">
            <td style="width: 50px;"></td>
            <td style="width: 60px;"></td>
            <td style="width: 50px;"></td>
            <td style="width: 50px;"></td>
            <td style="width: 60px;"></td>
            <td style="width: 70px;"></td>
            <td style="width: 30px;"></td>
            <td>更新日</td>
            <td colspan="3">{{(new DateTime($user->updated_at))->format('Y年m月d日')}}</td>
        </tr>
        <tr style="background-color: rgb(212 212 216);">
            <td colspan="2">イニシャル</td>
            <td>年齢</td>
            <td>性別</td>
            <td>国籍</td>
            <td colspan="2">経験年数</td>
            <td colspan="4">現在所</td>
        </tr>
        <tr>
            <td colspan="2">{{$user->initial}}<br/></td>
            <td>{{$user->age}}</td>
            <td>{{$user->sex == 'woman' ? '女' : '男'}}</td>
            <td>{{$user->nationality}}</td>
            <td colspan="2">{{$user->years_of_experience}}</td>
            <td colspan="4">{{$user->address}}</td>
        </tr>
        <tr style="background-color: rgb(212 212 216);">
            <td colspan="7">最終学歴</td>
            <td colspan="4">交通機関</td>
        </tr>
        <tr>
            <td colspan="7">{{$user->education}}</td>
            <td>{{$user->train_line}}</td>
            <td>線</td>
            <td>{{$user->station}}</td>
            <td>駅</td>
        </tr>
        <tr>
            <td colspan="2" style="background-color: rgb(212 212 216);">資格・PR・その他</td>
            <td colspan="9">{{implode(' ', $user->pr)}}</td>
        </tr>
        @for ($i = 0; $i < 3; $i++)
        <tr>
            <td colspan="11">{{$user->pr[$i] ?? ''}}<br/></td>
        </tr>
        @endfor
        <tr style="background-color: rgb(212 212 216);">
            <td colspan="4">希望業務</td>
            <td colspan="7">自己分析 【できる】１０　９　８　７　６　５　４　３　２　１　【できない】</td>
        </tr>
        <tr>
            <td style="background-color: rgb(212 212 216);">業務範囲</td>
            <td colspan="3"></td>
            <td colspan="2">挨拶</td>
            <td>{{$user->self_analysis->greeting ?? ''}}</td>
            <td>ホスピタリティー</td>
            <td>{{$user->self_analysis->hospitality ?? ''}}</td>
            <td>Word</td>
            <td>{{$user->self_analysis->word ?? ''}}</td>
        </tr>
        <tr>
            <td style="background-color: rgb(212 212 216);">P言語</td>
            <td colspan="3"></td>
            <td colspan="2">マナー</td>
            <td>{{$user->self_analysis->manners ?? ''}}</td>
            <td>コミュニケーション</td>
            <td>{{$user->self_analysis->communication ?? ''}}</td>
            <td>Excel</td>
            <td>{{$user->self_analysis->excel ?? ''}}</td>
        </tr>
        <tr>
            <td style="background-color: rgb(212 212 216);">場所</td>
            <td colspan="3"></td>
            <td colspan="2">礼儀</td>
            <td>{{$user->self_analysis->etiquette ?? ''}}</td>
            <td>プレゼンテーション</td>
            <td>{{$user->self_analysis->presentation ?? ''}}</td>
            <td>Power Point</td>
            <td>{{$user->self_analysis->powerpoint ?? ''}}</td>
        </tr>
        <tr>
            <td style="background-color: rgb(212 212 216);">備考</td>
            <td colspan="3"></td>
            <td colspan="2">敬語</td>
            <td>{{$user->self_analysis->honorific ?? ''}}</td>
            <td>問題解決力</td>
            <td>{{$user->self_analysis->problem_solving ?? ''}}</td>
            <td>Webカメラ表示</td>
            <td>{{$user->self_analysis->webcam ?? ''}}</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="2">言葉遣い</td>
            <td>{{$user->self_analysis->wording ?? ''}}</td>
            <td>リーダーシップ</td>
            <td>{{$user->self_analysis->leadership ?? ''}}</td>
            <td>生成AI活用</td>
            <td>{{$user->self_analysis->ai_utilization ?? ''}}</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="2">文章力</td>
            <td>{{$user->self_analysis->writing ?? ''}}</td>
            <td>マネジメント力</td>
            <td>{{$user->self_analysis->management ?? ''}}</td>
            <td>タイピング</td>
            <td>{{$user->self_analysis->typing ?? ''}}</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="2">協調性</td>
            <td>{{$user->self_analysis->cooperation ?? ''}}</td>
            <td>自己啓発</td>
            <td>{{$user->self_analysis->self_development ?? ''}}</td>
            <td>チャレンジ精神</td>
            <td>{{$user->self_analysis->challenge ?? ''}}</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="2">共感性</td>
            <td>{{$user->self_analysis->empathy ?? ''}}</td>
            <td>忍耐力</td>
            <td>{{$user->self_analysis->patience ?? ''}}</td>
            <td>ポジティブ</td>
            <td>{{$user->self_analysis->positive ?? ''}}</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="2">勤怠</td>
            <td>{{$user->self_analysis->attendance ?? ''}}</td>
            <td>責任感</td>
            <td>{{$user->self_analysis->responsibility ?? ''}}</td>
            <td>健康面</td>
            <td>{{$user->self_analysis->health ?? ''}}</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="2">勤務中態度</td>
            <td>{{$user->self_analysis->attitude ?? ''}}</td>
            <td>安定志向</td>
            <td>{{$user->self_analysis->stability ?? ''}}</td>
            <td>理解力</td>
            <td>{{$user->self_analysis->comprehension ?? ''}}</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="2">セキュリティー意識</td>
            <td>{{$user->self_analysis->security ?? ''}}</td>
            <td>英語力(読書)</td>
            <td>{{$user->self_analysis->english_reading ?? ''}}</td>
            <td>Ｑ＆Ａの明確さ</td>
            <td>{{$user->self_analysis->qa_clarity ?? ''}}</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="2">自発的な行動</td>
            <td>{{$user->self_analysis->initiative ?? ''}}</td>
            <td>英語力(会話)</td>
            <td>{{$user->self_analysis->english_speaking ?? ''}}</td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table>
        <tr class="top">
            <td></td>
            <td style="width: 100px;"></td>
            <td style="width: 30px;"></td>
            <td style="width: 100px;"></td>
            <td style="width: 30px;"></td>
            <td style="width: 100px;"></td>
            <td style="width: 30px;"></td>
            <td style="width: 100px;"></td>
            <td style="width: 30px;"></td>
            <td style="width: 100px;"></td>
            <td style="width: 30px;"></td>
        </tr>
        <tr class="top">
            <td colspan="11">自己分析 【できる】　１０　９　８　７　６　５　４　３　２　１　【できない】　（※上からアルファベット順の並びで表記）</td>
        </tr>
        <tr>
            <td rowspan="23" style="writing-mode: vertical-lr; text-orientation: upright;">保 有 技 術</td>
            <td colspan="2" style="background-color: rgb(212 212 216);">業種(経験分野)</td>
            <td colspan="4" style="background-color: rgb(212 212 216);">フレームワーク</td>
            <td colspan="4" style="background-color: rgb(212 212 216);">バックエンド</td>
        </tr>
        @for ($i = 0; $i < 18; $i++)
            <tr>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
            </tr>
        @endfor
        <tr>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td colspan="2" style="background-color: rgb(212 212 216);">フロントエンド</td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
        </tr>
        @for ($i = 19; $i < 22; $i++)
            <tr>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
            </tr>
        @endfor
        <tr> 
            <td rowspan="47" style="writing-mode: vertical-lr; text-orientation: upright;">保 有 技 術</td>
            <td colspan="2" style="background-color: rgb(212 212 216);">業務範囲</td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
        </tr>
        @for ($i = 23; $i < 30; $i++)
            <tr>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
            </tr>
        @endfor
        <tr>
            <td><br/></td>
            <td><br/></td>
            <td colspan="4" style="background-color: rgb(212 212 216);">ミドルウェア</td>
            <td colspan="2" style="background-color: rgb(212 212 216);">OS</td>
            <td colspan="2" style="background-color: rgb(212 212 216);">開発環境</td>
        </tr>
        @for ($i = 31; $i < 41; $i++)
            <tr>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
            </tr>
        @endfor
        <tr>
            <td colspan="2" style="background-color: rgb(212 212 216);">サーバー</td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
        </tr>
        <tr>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td colspan="2" style="background-color: rgb(212 212 216);">データベース</td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
        </tr>
        @for ($i = 43; $i < 55; $i++)
            <tr>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
            </tr>
        @endfor
        <tr style="background-color: rgb(212 212 216);">
            <td colspan="2">クラウド</td>
            <td colspan="2">インフラ</td>
            <td colspan="4">ツール</td>
            <td colspan="2">その他</td>
        </tr>
        @for ($i = 56; $i < 65; $i++)
            <tr>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
            </tr>
        @endfor
        <tr>
            <td><br/></td>
            <td><br/></td>
            <td colspan="2" style="background-color: rgb(212 212 216);">デザイン</td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
        </tr>
        @for ($i = 66; $i < 69; $i++)
            <tr>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
            </tr>
        @endfor
        <tr> 
            <td rowspan="5" style="writing-mode: vertical-lr; text-orientation: upright;">保 有 技 術</td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
            <td><br/></td>
        </tr>
        @for ($i = 70; $i < 74; $i++)
            <tr>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
                <td><br/></td>
            </tr>
        @endfor
    </table>
    <table>
        <tr class="top">
            <td></td>
            <td style="width: 60px;"></td>
            <td></td>
            <td style="width: 120px;"></td>
            <td style="width: 30px;"></td>
            <td style="width: 120px;"></td>
            <td style="width: 30px;"></td>
            <td style="width: 120px;"></td>
            <td style="width: 30px;"></td>
            <td style="width: 120px;"></td>
            <td style="width: 30px;"></td>
        </tr>
        <tr class="top">
            <td colspan="11">※上から新しい順に表記 5プロジェクト</td>
        </tr>
        @foreach($user->workExperiences as $workExperience)
            <tr style="background-color: rgb(212 212 216);">
                <td>No</td>
                <td>期間</td>
                <td colspan="5">プロジェクト名</td>
                <td colspan="2">業務範囲</td>
                <td colspan="2">業種</td>
            </tr>
            <tr>
                <td rowspan="16">{{$workExperience->display_order + 1}}</td>
                <td rowspan="16">{{$workExperience->period}}<br/></td>
                <td rowspan="3" colspan="5">{{$workExperience->project_title}}<br/></td>
                <td colspan="2">{{$workExperience->work[0] ?? ''}}<br/></td>
                <td colspan="2">{{$workExperience->business[0] ?? ''}}<br/></td>
            </tr>
            @for ($i = 1; $i < 3; $i++)
                <tr>
                    <td colspan="2">{{$workExperience->work[$i] ?? ''}}<br/></td>
                    <td colspan="2">{{$workExperience->business[$i] ?? ''}}<br/></td>
                </tr>
            @endfor
            <tr style="background-color: rgb(212 212 216);">
                <td colspan="3">詳細</td>
                <td colspan="2">フレームワーク</td>
                <td colspan="2">フロントエンド</td>
                <td colspan="2">バックエンド</td>
            </tr>
            <tr>
                <td rowspan="11" colspan="3">{{$workExperience->description}}<br/></td>
                <td colspan="2">{{$workExperience->framework[0] ?? ''}}<br/></td>
                <td colspan="2">{{$workExperience->frontend[0] ?? ''}}<br/></td>
                <td colspan="2">{{$workExperience->backend[0] ?? ''}}<br/></td>
            </tr>
            @for ($i = 1; $i < 3; $i++)
                <tr>
                    <td colspan="2">{{$workExperience->framework[$i] ?? ''}}<br/></td>
                    <td colspan="2">{{$workExperience->frontend[$i] ?? ''}}<br/></td>
                    <td colspan="2">{{$workExperience->backend[$i] ?? ''}}<br/></td>
                </tr>
            @endfor
            <tr style="background-color: rgb(212 212 216);">
                <td colspan="2">サーバー</td>
                <td colspan="2">データベース</td>
                <td colspan="2">ツール</td>
            </tr>
            <tr>
                <td colspan="2">{{$workExperience->server[0] ?? ''}}<br/></td>
                <td colspan="2">{{$workExperience->database[0] ?? ''}}<br/></td>
                <td colspan="2">{{$workExperience->tool[0] ?? ''}}<br/></td>
            </tr>
            @for ($i = 1; $i < 3; $i++)
                <tr>
                    <td colspan="2">{{$workExperience->server[$i] ?? ''}}<br/></td>
                    <td colspan="2">{{$workExperience->database[$i] ?? ''}}<br/></td>
                    <td colspan="2">{{$workExperience->tool[$i] ?? ''}}<br/></td>
                </tr>
            @endfor
            <tr style="background-color: rgb(212 212 216);">
                <td colspan="2">ミドルウェア</td>
                <td colspan="2">OS</td>
                <td colspan="2">その他</td>
            </tr>
            <tr>
                <td colspan="2">{{$workExperience->middleware[0] ?? ''}}<br/></td>
                <td colspan="2">{{$workExperience->os[0] ?? ''}}<br/></td>
                <td colspan="2">{{$workExperience->others[0] ?? ''}}<br/></td>
            </tr>
            @for ($i = 1; $i < 3; $i++)
                <tr>
                    <td colspan="2">{{$workExperience->middleware[$i] ?? ''}}<br/></td>
                    <td colspan="2">{{$workExperience->os[$i] ?? ''}}<br/></td>
                    <td colspan="2">{{$workExperience->others[$i] ?? ''}}<br/></td>
                </tr>
            @endfor
        @endforeach
    </table>
</body>
</html>