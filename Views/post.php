<?php
//設定画面を詠み込む
include_once('../config.php');
//便利な関数を詠み込む
include_once('../util.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include_once('../Views/common/head.php'); ?>
    <title>つぶやき投稿 / Twitterクローン</title>
    <meta name="description" content="ホーム画面です">
</head>

<body class='home'>
    <div class="container">
        <?php include_once('../Views/common/side.php'); ?>
        <div class="main">
            <div class="main-header">
                <h1>つぶやく</h1>
            </div>

            <!-- ツイート投稿欄 -->
            <?php include_once('../Views/common/tweet-post.php'); ?>

            <!-- ツイート仕切りエリア -->
            <div class="ditch">

            </div>



        </div>
    </div>
<?php include_once('../Views/common/foot.php'); ?>
</body>
</html>