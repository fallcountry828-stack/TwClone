<?php
//設定画面を詠み込む
include_once('../config.php');
//便利な関数を詠み込む
include_once('../util.php');
//ツイート一覧// 
$view_tweets = [
    [
        'user_id'          => 1,
        'user_name'        => 'taro',
        'user_nickname'    => null,
        'user_icon'        => 'sample-person.jpg',
        'tweet_body'       => 'こんにちは！',
        'tweet_image_name' => null,
        'tweet_created_at' => '2024-04-28 12:00:00',
        'like_id'          => null,
        'like_count'       => 0,
    ],
    [
        'user_id'          => 2,
        'user_name'        => 'jiro',
        'user_nickname'    => '次郎',
        'user_icon'        => null,
        'tweet_body'       => 'コワーキングスペースをオープンしました！',
        'tweet_image_name' => 'sample-post.jpg',
        'tweet_created_at' => '2026-09-17 21:00:00',
        'like_id'          => 1,
        'like_count'       => 1,
    ],
];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include_once('../Views/common/head.php'); ?>
    <title>ホーム画面 / Twitterクローン</title>
    <meta name="description" content="ホーム画面です">
</head>

<body class='home'>
    <div class="container">
        <?php include_once('../Views/common/side.php'); ?>
        <div class="main">
            <div class="main-header">
                <h1>ホーム</h1>
            </div>

            <!-- ツイート投稿欄 -->
            <?php include_once('../Views/common/tweet-post.php'); ?>

            <!-- ツイート仕切りエリア -->
            <div class="ditch">

            </div>

            <!-- ツイート一覧 -->
            <?php if (empty($view_tweets)): ?>
                <p class="p-3">ツイートがありません。</p>
            <?php else: ?>
                <div class="tweet-list">
                    <?php foreach ($view_tweets as $view_tweet){ 
                        include('../Views/common/tweet.php');
                    }?>
                </div>
            <?php endif; ?>



        </div>
    </div>
<?php include_once('../Views/common/foot.php'); ?>
</body>
</html>