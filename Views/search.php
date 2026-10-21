<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include_once('../Views/common/head.php'); ?>
    <title>検索画面 / Twitterクローン</title>
    <meta name="description" content="検索画面です">
</head>

<body class='home search text-center'>
    <div class="container">
        <?php include_once('../Views/common/side.php'); ?>
        <div class="main">
            <div class="main-header">
                <h1>検索</h1>
            </div>
            <!-- 検索エリア -->
            <form action="search.php" method="get">
                <div class="search-area">
                    <input type="text" name="keyword" class="form-control" id="" placeholder="キーワード検索" value="<?php echo html_escape($view_keyword);?>">
                    <button type="submit" class="btn">検索</button>
                </div>
            </form>

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