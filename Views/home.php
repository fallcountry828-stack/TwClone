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