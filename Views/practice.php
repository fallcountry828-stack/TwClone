<?php
// エラー表示
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ディレクトリ設定
define('HOME_URL', 'http://localhost/TwClone/');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jQuery 実践練習道場 / Twitterクローン</title>
    <link rel="shortcut icon" href="<?php echo HOME_URL; ?>Views/img/logo-twitterblue.svg" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- TwClone 本体のCSS -->
    <link rel="stylesheet" href="<?php echo HOME_URL; ?>Views/css/style.css">

    <!-- 練習ページ専用のスタイル -->
    <style>
        :root {
            --primary-blue: #1DA1F2;
            --primary-dark: #0f1419;
            --bg-page: #f7f9fa;
            --panel-bg: #ffffff;
            --editor-bg: #1e1e2e;
            --editor-text: #cdd6f4;
            --console-bg: #11111b;
            --accent-green: #00ba7c;
        }

        body.practice-page {
            background-color: var(--bg-page);
            font-family: 'Noto Sans JP', sans-serif;
            color: #0f1419;
            min-height: 100vh;
        }

        /* ナビゲーションバー */
        .practice-header {
            background: #ffffff;
            border-bottom: 1px solid #eff3f4;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .practice-header .logo {
            width: 32px;
            height: 32px;
        }

        /* レイアウト */
        .workspace-container {
            max-width: 1400px;
            margin: 20px auto;
            padding: 0 15px;
        }

        /* カードの共通スタイル */
        .custom-card {
            background: var(--panel-bg);
            border-radius: 16px;
            border: 1px solid #e1e8ed;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .card-header-custom {
            padding: 14px 20px;
            background: #fafbfd;
            border-bottom: 1px solid #eff3f4;
            font-weight: 700;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* プレビューツイートカード */
        .preview-tweet {
            padding: 16px 20px;
            display: flex;
            gap: 12px;
            background: #ffffff;
            border-bottom: 1px solid #eff3f4;
            transition: background-color 0.2s;
        }
        .preview-tweet:hover {
            background-color: #f7f9fa;
        }
        .preview-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }
        .preview-content {
            flex: 1;
        }
        .preview-user-info {
            display: flex;
            gap: 8px;
            align-items: baseline;
            margin-bottom: 4px;
        }
        .preview-nickname {
            font-weight: 700;
            color: #0f1419;
            font-size: 15px;
        }
        .preview-username {
            color: #536471;
            font-size: 14px;
        }
        .preview-text {
            font-size: 15px;
            line-height: 1.5;
            margin-bottom: 10px;
            white-space: pre-wrap;
        }
        .preview-actions {
            display: flex;
            gap: 30px;
            margin-top: 8px;
        }
        .preview-action-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            user-select: none;
            color: #536471;
            font-size: 13px;
            transition: all 0.2s;
        }
        .preview-action-btn:hover {
            color: var(--primary-blue);
        }
        .preview-action-btn img {
            width: 22px;
            height: 22px;
            transition: transform 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .preview-action-btn:active img {
            transform: scale(0.85);
        }

        /* 内蔵コンソール */
        .console-box {
            background-color: var(--console-bg);
            color: #a6adc8;
            font-family: 'Fira Code', monospace;
            font-size: 13px;
            border-radius: 12px;
            padding: 12px 16px;
            height: 140px;
            overflow-y: auto;
            white-space: pre-wrap;
            border: 1px solid #313244;
        }
        .console-line {
            margin-bottom: 4px;
            line-height: 1.4;
        }
        .console-line.info { color: #89b4fa; }
        .console-line.success { color: #a6e3a1; }
        .console-line.error { color: #f38ba8; }
        .console-line.warn { color: #f9e2af; }

        /* エディタ */
        .editor-container {
            background-color: var(--editor-bg);
            border-radius: 12px;
            padding: 0;
            overflow: hidden;
            box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.3);
            border: 1px solid #313244;
        }
        .editor-header {
            background-color: #181825;
            padding: 8px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #313244;
        }
        .editor-dots {
            display: flex;
            gap: 6px;
        }
        .editor-dot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
        }
        .editor-dot.red { background-color: #f38ba8; }
        .editor-dot.yellow { background-color: #f9e2af; }
        .editor-dot.green { background-color: #a6e3a1; }

        #code-editor {
            width: 100%;
            height: 280px;
            background: transparent;
            color: var(--editor-text);
            font-family: 'Fira Code', monospace;
            font-size: 14px;
            line-height: 1.6;
            border: none;
            padding: 16px;
            resize: vertical;
            outline: none;
            tab-size: 4;
        }

        /* レッスン選択タブ */
        .lesson-nav .nav-link {
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            color: #536471;
            padding: 6px 14px;
            margin-right: 6px;
            margin-bottom: 6px;
            background: #eff3f4;
            border: none;
            transition: all 0.2s;
        }
        .lesson-nav .nav-link.active {
            background: var(--primary-blue);
            color: #ffffff;
        }

        /* バッジ */
        .badge-step {
            background-color: rgba(29, 161, 242, 0.1);
            color: var(--primary-blue);
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 12px;
        }

        /* 模範解答コードブロック */
        .code-snippet {
            background: #1e1e2e;
            color: #a6e3a1;
            padding: 12px 16px;
            border-radius: 8px;
            font-family: 'Fira Code', monospace;
            font-size: 13px;
            line-height: 1.6;
            white-space: pre-wrap;
            word-break: break-all;
            border: 1px solid #313244;
        }

        /* アコーディオン風 details/summary */
        details.lesson-detail {
            border: 1px solid #e1e8ed;
            border-radius: 8px;
            margin-bottom: 8px;
            overflow: hidden;
            background: #ffffff;
        }
        details.lesson-detail summary {
            padding: 10px 14px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            background-color: #f7f9fa;
            user-select: none;
            outline: none;
            transition: background-color 0.2s;
        }
        details.lesson-detail summary:hover {
            background-color: #eff3f4;
        }
        details.lesson-detail[open] summary {
            border-bottom: 1px solid #eff3f4;
            background-color: #edf5fd;
        }
        details.lesson-detail .detail-content {
            padding: 12px 14px;
        }
    </style>
</head>
<body class="practice-page">

    <!-- ナビゲーションバー -->
    <header class="practice-header py-2">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <img src="<?php echo HOME_URL; ?>Views/img/logo-twitterblue.svg" alt="Twitter" class="logo">
                <h5 class="m-0 fw-bold">Twitterクローン jQuery 実践トレーニング道場</h5>
            </div>
            <div>
                <a href="<?php echo HOME_URL; ?>Views/home.php" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    ← 本番のホーム画面へ戻る
                </a>
            </div>
        </div>
    </header>

    <div class="workspace-container">
        <div class="row g-4">
            
            <!-- ============================================== -->
            <!-- 左カラム：プレビュー画面 & 内蔵コンソール -->
            <!-- ============================================== -->
            <div class="col-lg-5">
                
                <!-- 1. ツイートプレビューエリア -->
                <div class="custom-card">
                    <div class="card-header-custom">
                        <div class="d-flex align-items-center gap-2">
                            <span>📱 プレビュー（実際の表示画面）</span>
                        </div>
                        <button id="btn-reset-preview" class="btn btn-sm btn-outline-secondary rounded-pill px-2 py-0" style="font-size: 12px;">
                            🔄 状態をリセット
                        </button>
                    </div>
                    <div class="p-3">
                        <small class="text-muted d-block mb-3">
                            ※右側のコードを実行すると、このツイートの「いいね」ボタンやカウントが連動して動きます。
                        </small>

                        <!-- ツイートカード -->
                        <div class="preview-tweet rounded-3 border">
                            <img src="<?php echo HOME_URL; ?>Views/img/icon-default-user.svg" alt="アバター" class="preview-avatar">
                            <div class="preview-content">
                                <div class="preview-user-info">
                                    <span class="preview-nickname">学習中のユーザー</span>
                                    <span class="preview-username">@learner・たった今</span>
                                </div>
                                <div class="preview-text">jQueryでいいね機能を作っています！ボタンをクリックしたときの動きを自分で書いて試してみましょう✨</div>
                                
                                <!-- アクションアイコンリスト -->
                                <div class="preview-actions">
                                    
                                    <!-- いいねボタン（本番の .js-like にあたる練習用要素） -->
                                    <div class="preview-action-btn js-practice-like" data-like-id="" title="クリックしていいね！">
                                        <img src="<?php echo HOME_URL; ?>Views/img/icon-heart.svg" alt="ハート" class="js-practice-heart-img">
                                        <span class="js-practice-like-count">0</span>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- おまけ：文字数カウント練習用入力欄 -->
                        <div class="mt-4 pt-3 border-top">
                            <label class="form-label fw-bold small text-secondary">✍️ つぶやき入力欄（文字数カウント練習用）</label>
                            <textarea id="practice-tweet-input" class="form-control form-control-sm" rows="2" placeholder="何か入力してみましょう..."></textarea>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <small class="text-muted">残り文字数: <span id="practice-char-count" class="fw-bold text-primary">140</span> 文字</small>
                                <button id="practice-tweet-submit" class="btn btn-primary btn-sm rounded-pill px-3" disabled>ツイートする</button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- 2. 仮想コンソール画面 -->
                <div class="custom-card">
                    <div class="card-header-custom">
                        <span>💻 実行ログ (console.log の出力)</span>
                        <button id="btn-clear-console" class="btn btn-sm btn-outline-secondary rounded-pill px-2 py-0" style="font-size: 12px;">
                            消去
                        </button>
                    </div>
                    <div class="p-3 bg-dark">
                        <div id="virtual-console" class="console-box">
                            <div class="console-line info">// 準備完了！右側のエディタでコードを書いて「実行」を押してください。</div>
                        </div>
                    </div>
                </div>

            </div>


            <!-- ============================================== -->
            <!-- 右カラム：レッスン解説 & ライブコードエディタ -->
            <!-- ============================================== -->
            <div class="col-lg-7">

                <!-- レッスン切り替えナビ -->
                <div class="custom-card mb-3">
                    <div class="p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold m-0 text-dark">🎯 実践レッスンを選んで練習する</h6>
                            <span id="current-lesson-badge" class="badge-step">Lesson 1</span>
                        </div>
                        <ul class="nav lesson-nav" id="lessonTabs">
                            <li class="nav-item">
                                <button class="nav-link active" data-lesson="1">1. クリック検知</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-lesson="2">2. 画像切り替え</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-lesson="3">3. カウント増減</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-lesson="4">4. いいね付与/解除</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-lesson="free">自由練習</button>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- レッスンの問題とヒント -->
                <div class="custom-card">
                    <div class="card-header-custom">
                        <span id="lesson-title">【Lesson 1】いいねボタンがクリックされたことを検知しよう</span>
                        <button id="btn-set-template" class="btn btn-sm btn-outline-primary rounded-pill px-3" style="font-size: 12px;">
                            📋 この問題の雛形をセット
                        </button>
                    </div>
                    <div class="p-3">
                        <p id="lesson-desc" class="mb-2" style="font-size: 14px; line-height: 1.6;">
                            ハートアイコン（<code>.js-practice-like</code>）がクリックされたときに、<code>console.log()</code> でメッセージを出力してみましょう！
                        </p>

                        <!-- ヒントと解答のトグル -->
                        <div class="mt-3">
                            <details class="lesson-detail" id="detailsHint">
                                <summary>💡 ヒントを見る（クリックで開閉）</summary>
                                <div class="detail-content text-muted small" id="lesson-hint">
                                    <code>$('.js-practice-like').click(function() { ... });</code> を使います。
                                </div>
                            </details>

                            <details class="lesson-detail" id="detailsAnswer">
                                <summary class="text-primary">🔑 模範解答を見る（クリックで開閉）</summary>
                                <div class="detail-content">
                                    <pre id="lesson-answer" class="code-snippet m-0">$('.js-practice-like').click(function(e) {
    console.log("ハートがクリックされました！");
});</pre>
                                    <div class="mt-2">
                                        <button id="btn-copy-answer" class="btn btn-sm btn-outline-primary rounded-pill px-3" style="font-size: 12px;">
                                            ⬆ この解答をエディタにコピーする
                                        </button>
                                    </div>
                                </div>
                            </details>
                        </div>

                    </div>
                </div>

                <!-- コードエディタ -->
                <div class="custom-card">
                    <div class="card-header-custom">
                        <div class="d-flex align-items-center gap-2">
                            <span>✏️ あなたのコード</span>
                            <span class="badge bg-secondary" style="font-size: 11px;">jQuery 3.7.1</span>
                        </div>
                        <div class="d-flex gap-2">
                            <button id="btn-run-code" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold">
                                ▶ コードを実行する
                            </button>
                        </div>
                    </div>

                    <div class="editor-container">
                        <div class="editor-header">
                            <div class="editor-dots">
                                <div class="editor-dot red"></div>
                                <div class="editor-dot yellow"></div>
                                <div class="editor-dot green"></div>
                            </div>
                            <span class="text-white-50 small">live-practice.js</span>
                            <span class="text-white-50 small">Tabキー対応</span>
                        </div>
                        <textarea id="code-editor" spellcheck="false">// 【Lesson 1】クリックイベントを検知しよう
$('.js-practice-like').click(function(e) {
    // ここに処理を記述します
    console.log("ハートがクリックされました！");
});</textarea>
                    </div>

                    <div class="p-3 bg-light border-top d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            💡 エディタ内で <code>Tab</code> キーを押すとインデント（半角スペース4つ）が入力できます。
                        </small>
                        <div class="d-flex gap-2">
                            <button id="btn-clear-editor" class="btn btn-outline-secondary btn-sm rounded-pill px-3">クリア</button>
                        </div>
                    </div>
                </div>

                <!-- 外部JSファイルの案内 -->
                <div class="card bg-white border rounded-3 p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 fw-bold">📁 VS Codeなどのエディタで直接書きたい場合</h6>
                            <small class="text-muted">
                                <code>Views/js/practice.js</code> を直接編集して練習することも可能です。
                            </small>
                        </div>
                        <button id="btn-load-external-js" class="btn btn-outline-dark btn-sm rounded-pill px-3">
                            practice.js を実行
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- jQuery 3.7.1 -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- 練習道場の制御スクリプト -->
    <script>
        $(document).ready(function() {
        // ==========================================
        // 仮想コンソールのインターセプト設定
        // ==========================================
        const virtualConsole = document.getElementById('virtual-console');
        function logToVirtual(msg, type = 'info') {
            const line = document.createElement('div');
            line.className = `console-line ${type}`;
            const time = new Date().toLocaleTimeString();
            line.textContent = `[${time}] ${msg}`;
            virtualConsole.appendChild(line);
            virtualConsole.scrollTop = virtualConsole.scrollHeight;
        }

        // console.log をオーバーライドして仮想コンソールにも出す
        const originalLog = console.log;
        const originalError = console.error;
        console.log = function(...args) {
            originalLog.apply(console, args);
            logToVirtual(args.map(a => typeof a === 'object' ? JSON.stringify(a) : a).join(' '), 'info');
        };
        console.error = function(...args) {
            originalError.apply(console, args);
            logToVirtual(args.map(a => typeof a === 'object' ? JSON.stringify(a) : a).join(' '), 'error');
        };

        $('#btn-clear-console').click(function() {
            virtualConsole.innerHTML = '<div class="console-line info">// コンソールをクリアしました</div>';
        });

        // ==========================================
        // レッスンデータ定義
        // ==========================================
        const lessons = {
            1: {
                badge: 'Lesson 1',
                title: '【Lesson 1】いいねボタンがクリックされたことを検知しよう',
                desc: 'ハートアイコン（<code>.js-practice-like</code>）がクリックされたときに、<code>console.log()</code> でメッセージを出力してみましょう！左側のハートをクリックしてコンソールに文字が出たら成功です。',
                hint: "「$('.js-practice-like').click(function(e) { ... });」の中で console.log('クリックされました！'); を実行します。",
                template: `// 【Lesson 1】クリックイベントを検知しよう\n$('.js-practice-like').click(function(e) {\n    // ここに処理を記述します\n    console.log("ハートがクリックされました！");\n});`,
                answer: `$('.js-practice-like').click(function(e) {\n    console.log("ハートがクリックされました！");\n});`
            },
            2: {
                badge: 'Lesson 2',
                title: '【Lesson 2】ハートの色（画像）を青色に切り替えよう',
                desc: 'クリックされたときに、ハートの画像を青色（<code>../Views/img/icon-heart-twitterblue.svg</code>）に変更してみましょう！<br><code>$(this).find('img')</code> と <code>attr()</code> メソッドを使います。',
                hint: "$(this).find('img').attr('src', '../Views/img/icon-heart-twitterblue.svg');",
                template: `// 【Lesson 2】画像切り替え\n$('.js-practice-like').click(function(e) {\n    // $(this) はクリックされたボタン自身です\n    // find('img') で中のimg要素を探し、attr() でsrcを変更します\n    $(this).find('img').attr('src', '../Views/img/icon-heart-twitterblue.svg');\n    console.log("ハートを青色に変更しました！");\n});`,
                answer: `$('.js-practice-like').click(function(e) {\n    $(this).find('img').attr('src', '../Views/img/icon-heart-twitterblue.svg');\n});`
            },
            3: {
                badge: 'Lesson 3',
                title: '【Lesson 3】いいねカウントの数値を「+1」増やそう',
                desc: 'ハートがクリックされたら、いいねのカウント数（<code>.js-practice-like-count</code>）を取得して数値に変換し、1増やして画面に反映させてみましょう！',
                hint: "let count = Number(countObj.text()); で数値化し、countObj.text(count + 1); で書き換えます。",
                template: `// 【Lesson 3】カウントの増加\n$('.js-practice-like').click(function(e) {\n    const countObj = $(this).find('.js-practice-like-count');\n    let count = Number(countObj.text());\n    \n    // 1増やして表示を更新\n    countObj.text(count + 1);\n    console.log("いいねカウント:", count + 1);\n});`,
                answer: `$('.js-practice-like').click(function(e) {\n    const countObj = $(this).find('.js-practice-like-count');\n    let count = Number(countObj.text());\n    countObj.text(count + 1);\n});`
            },
            4: {
                badge: 'Lesson 4',
                title: '【Lesson 4】いいね付与と解除を切り替えよう（like.jsの再現）',
                desc: '<code>data-like-id</code> 属性を活用して、1回目のクリックで「いいね付与（青色 ＆ カウント+1）」、2回目のクリックで「いいね解除（グレー ＆ カウント-1）」に切り替える完全なロジックを完成させましょう！',
                hint: "const likeId = $(this).data('like-id'); で判定し、if (likeId) { 解除 } else { 付与 } と分岐します。",
                template: `// 【Lesson 4】いいねのトグル（付与/解除）\n$('.js-practice-like').click(function(e) {\n    const thisObj = $(this);\n    const likeId = thisObj.data('like-id');\n    const countObj = thisObj.find('.js-practice-like-count');\n    let count = Number(countObj.text());\n\n    if (likeId) {\n        // いいね解除処理\n        count--;\n        countObj.text(count);\n        thisObj.data('like-id', null);\n        thisObj.find('img').attr('src', '../Views/img/icon-heart.svg');\n        console.log("いいねを解除しました");\n    } else {\n        // いいね付与処理\n        count++;\n        countObj.text(count);\n        thisObj.data('like-id', true);\n        thisObj.find('img').attr('src', '../Views/img/icon-heart-twitterblue.svg');\n        console.log("いいねしました！");\n    }\n});`,
                answer: `$('.js-practice-like').click(function(e) {\n    const thisObj = $(this);\n    const likeId = thisObj.data('like-id');\n    const countObj = thisObj.find('.js-practice-like-count');\n    let count = Number(countObj.text());\n\n    if (likeId) {\n        count--;\n        countObj.text(count);\n        thisObj.data('like-id', null);\n        thisObj.find('img').attr('src', '../Views/img/icon-heart.svg');\n    } else {\n        count++;\n        countObj.text(count);\n        thisObj.data('like-id', true);\n        thisObj.find('img').attr('src', '../Views/img/icon-heart-twitterblue.svg');\n    }\n});`
            },
            5: {
                badge: 'Lesson 5',
                title: '【Lesson 5】イベントオブジェクト e で浮き上がるハートを作ろう',
                desc: 'クリックされた座標（<code>e.pageX</code>, <code>e.pageY</code>）を取得し、ハート要素を生成して浮かび上がらせるアニメーションを追加してみましょう！',
                hint: "document.createElement('span') でハートを作り、heart.style.left = e.pageX + 'px'; で位置を指定します。",
                template: `// 【Lesson 5】浮遊ハートエフェクト\n$('.js-practice-like').click(function(e) {\n    // ハート要素の生成\n    const heart = document.createElement("span");\n    heart.classList.add("heart");\n    heart.textContent = "\\u2764\\uFE0E";\n    document.body.appendChild(heart);\n\n    // クリック位置 (e.pageX, e.pageY) をセット\n    heart.style.left = e.pageX + "px";\n    heart.style.top = e.pageY + "px";\n\n    console.log("クリック座標:", e.pageX, e.pageY);\n\n    // 1.5秒後に消去\n    setTimeout(() => {\n        heart.remove();\n    }, 1500);\n});`,
                answer: `$('.js-practice-like').click(function(e) {\n    const heart = document.createElement("span");\n    heart.classList.add("heart");\n    heart.textContent = "\\u2764\\uFE0E";\n    document.body.appendChild(heart);\n\n    heart.style.left = e.pageX + "px";\n    heart.style.top = e.pageY + "px";\n\n    setTimeout(() => {\n        heart.remove();\n    }, 1500);\n});`
            },
            free: {
                badge: '自由練習',
                title: '【自由練習モード】好きなコードを書いて実験しよう',
                desc: '文字数カウント機能の実装や、独自の演出など、思いついたjQueryコードを自由に書いて動作を試すことができます。',
                hint: "$('#practice-tweet-input').on('input', function() { ... }); などを試してみましょう！",
                template: `// 文字数カウントの例\n$('#practice-tweet-input').on('input', function() {\n    const textLength = $(this).val().length;\n    const remain = 140 - textLength;\n    \n    $('#practice-char-count').text(remain);\n    \n    if (remain < 0) {\n        $('#practice-char-count').addClass('text-danger').removeClass('text-primary');\n        $('#practice-tweet-submit').prop('disabled', true);\n    } else if (textLength > 0) {\n        $('#practice-char-count').removeClass('text-danger').addClass('text-primary');\n        $('#practice-tweet-submit').prop('disabled', false);\n    } else {\n        $('#practice-tweet-submit').prop('disabled', true);\n    }\n});`,
                answer: `// 自由練習モードですので、お好きなコードをお試しください`
            }
        };

        let currentLessonKey = '1';

        function loadLesson(key) {
            currentLessonKey = key;
            const data = lessons[key];
            $('#current-lesson-badge').text(data.badge);
            $('#lesson-title').html(data.title);
            $('#lesson-desc').html(data.desc);
            $('#lesson-hint').html(data.hint);
            $('#lesson-answer').text(data.answer);
            $('#code-editor').val(data.template);
        }

        // 初期表示
        loadLesson('1');

        // タブ切り替え
        $('#lessonTabs .nav-link').click(function() {
            $('#lessonTabs .nav-link').removeClass('active');
            $(this).addClass('active');
            const key = $(this).data('lesson');
            loadLesson(key);
        });

        // 雛形セットボタン
        $('#btn-set-template').click(function() {
            $('#code-editor').val(lessons[currentLessonKey].template);
            logToVirtual(`Lesson ${currentLessonKey} の雛形をエディタにセットしました。`);
        });

        // 模範解答コピーボタン
        $('#btn-copy-answer').click(function() {
            $('#code-editor').val(lessons[currentLessonKey].answer);
            logToVirtual(`Lesson ${currentLessonKey} の模範解答をエディタにセットしました。`);
        });

        // クリアボタン
        $('#btn-clear-editor').click(function() {
            $('#code-editor').val('');
        });

        // ==========================================
        // エディタ内でのTabキー有効化
        // ==========================================
        $('#code-editor').keydown(function(e) {
            if (e.key === 'Tab') {
                e.preventDefault();
                const start = this.selectionStart;
                const end = this.selectionEnd;
                $(this).val($(this).val().substring(0, start) + "    " + $(this).val().substring(end));
                this.selectionStart = this.selectionEnd = start + 4;
            }
        });

        // ==========================================
        // プレビューのリセット
        // ==========================================
        $('#btn-reset-preview').click(function() {
            // イベントハンドラを解除
            $('.js-practice-like').off('click');
            $('#practice-tweet-input').off('input keyup');
            
            // 状態を初期値に戻す
            $('.js-practice-like').data('like-id', null);
            $('.js-practice-heart-img').attr('src', '<?php echo HOME_URL; ?>Views/img/icon-heart.svg');
            $('.js-practice-like-count').text('0');
            $('#practice-tweet-input').val('');
            $('#practice-char-count').text('140').removeClass('text-danger').addClass('text-primary');
            $('#practice-tweet-submit').prop('disabled', true);

            logToVirtual('プレビューの状態とイベントを初期化（リセット）しました。', 'warn');
        });

        // ==========================================
        // コード実行ボタン
        // ==========================================
        $('#btn-run-code').click(function() {
            const code = $('#code-editor').val();
            if (!code.trim()) {
                logToVirtual('コードが空です。コードを入力してください。', 'warn');
                return;
            }

            // 以前のイベントを一度解除して多重登録を防ぐ
            $('.js-practice-like').off('click');
            $('#practice-tweet-input').off('input keyup');

            try {
                // 実行
                new Function(code)();
                logToVirtual('✨ コードを正常に実行・適用しました！プレビューを操作してみてください。', 'success');
            } catch (err) {
                logToVirtual('❌ エラーが発生しました: ' + err.message, 'error');
                console.error(err);
            }
        });

        // ==========================================
        // 外部ファイル (practice.js) の実行
        // ==========================================
        $('#btn-load-external-js').click(function() {
            logToVirtual('Views/js/practice.js を読み込んでいます...', 'info');
            // キャッシュを防ぐためタイムスタンプ付与
            $.getScript('<?php echo HOME_URL; ?>Views/js/practice.js?v=' + Date.now())
                .done(function() {
                    logToVirtual('✅ practice.js の読み込みと実行に成功しました！', 'success');
                })
                .fail(function(jqxhr, settings, exception) {
                    logToVirtual('❌ practice.js の読み込みに失敗しました: ' + exception, 'error');
                });
        });
        });
    </script>
</body>
</html>
