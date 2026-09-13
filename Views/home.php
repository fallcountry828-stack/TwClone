<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/logo-twitterblue.svg" type="image/x-icon">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">

    <title>ホーム画面 / Twitterクローン</title>
    <meta name="description" content="ホーム画面です">
</head>
<body class='home'>
    <div class="container">
        <div class="side">
            <div class="side-inner">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="home.php" class="nav-link"><img src="./img/logo-twitterblue.svg" alt="twitterクローンロゴ" class="icon"></a></li>
                    <li class="nav-item"><a href="home.php" class="nav-link"><img src="./img/icon-home.svg" alt="ホームアイコン"></a></li>
                    <li class="nav-item"><a href="search.php" class="nav-link"><img src="./img/icon-search.svg" alt="検索アイコン"></a></li>
                    <li class="nav-item"><a href="notification.php" class="nav-link"><img src="./img/icon-notification.svg" alt="通知アイコン"></a></li>
                    <li class="nav-item"><a href="profile.php" class="nav-link"><img src="./img/icon-profile.svg" alt="プロファイルアイコン"></a></li>
                    <li class="nav-item"><a href="post.php" class="nav-link"><img src="./img/icon-post-tweet-twitterblue.svg" alt="ツイッターブルーアイコン" class="post-tweet"></a></li>
                    <li class="nav-item my-icon"><img src="./img_uploaded/user/sample-person.jpg" alt="リストアイコン"></a></li>

                </ul>
            </div>
        </div>
        <div class="main">
            <div class="main-header">
                <h1>ホーム</h1>
            </div>

            <!-- ツイート投稿欄 -->
            <div class="tweet-post">
                <div class="my-icon">
                    <img src="./img_uploaded/user/sample-person.jpg" alt="">
                    
                </div>
                <div class="input-area">
                    <form action='post.php' method='post' enctype='multipart/form-data'>
                        <textarea name="body" id="" placeholder="いまどうしてる？" maxlength="140"></textarea>
                        <div class="bottom-area">
                            <div class="mb-0">
                                <input type="file" name="image" id=""class='form-control form-control-sm'>
                            </div>
                            <button class="btn" type='submit'>つぶやく</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ツイート仕切りエリア -->
            <div class="ditch">

            </div>

            <!-- ツイート一覧 -->
            <div class="tweet-list">
                <div class="tweet">
                    <div class="user">
                        <a href="profile.php?user_id=1">
                            <img src="./img_uploaded/user/sample-person.jpg" alt="">
                        </a>
                    </div>
                    <div class="content">
                        <div class="name">
                            <a href="profile.php?user_id=1">
                                <span class="nickname">太郎</span>
                                <span class="user-name">@taro・2日前</span>
                            </a>
                        </div>
                        <p>こんにちは！</p>
                        <div class="icon-list">
                            <div class="like">
                                <img src="./img/icon-heart.svg" alt="">
                            </div>
                            <div class="like-count">0</div>
                        </div>
                    </div>
                </div>
                <div class="tweet">
                    <div class="user">
                        <a href="profile.php?user_id=1">
                            <img src="./img/icon-default-user.svg" alt="">
                        </a>
                    </div>
                    <div class="content">
                        <div class="name">
                            <a href="profile.php?user_id=1">
                                <span class="nickname">次郎</span>
                                <span class="user-name">@jiro・3日前</span>
                            </a>
                        </div>
                        <p>コワーキングスペースをオープンしました！</p>
                        <img src="../Views/img_uploaded/tweet/sample-post.jpg" alt="" class='post-image'>
                        <div class="icon-list">
                            <div class="like">
                                <img src="./img/icon-heart-twitterblue.svg" alt="">
                            </div>
                            <div class="like-count">1</div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</body>
</html>