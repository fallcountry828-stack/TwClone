<?php
//エラー表示
error_reporting(E_ALL);
ini_set('display_errors', 1);
//日本時間
date_default_timezone_set('Asia/Tokyo');
//ディレクトリ設定
define('HOME_URL', 'http://localhost/TwClone/');
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


//配列

/**
 * ツイート日時を「〇分前」や「〇時間前」に変換する関数
 * @param string $datetime
 * @return string 
 */
function convertTodayTimeAgo(string $datetime)
{
    //引用の日時をunixタイムスタンプに変換
    //unixタイムは1970年1月1日からの経過秒数
    $unix = strtotime($datetime);
    //現在日時をunixタイムスタンプに変換
    $now = time();
    //現在日時と引用の日時の差分を秒単位で計算
    $diff_second = $now - $unix;
    if($diff_second<60){
        $time=$diff_second;
        $unit="秒前";
    }elseif($diff_second<60*60){
        $time=round($diff_second/60);
        $unit="分前";
    }elseif($diff_second<60*60*24){
        $time=round($diff_second/60/60);
        $unit="時間前";
    }elseif($diff_second<60*60*24*30){
        $time=round($diff_second/60/60/24);
        $unit="日前";
    }else{
        if(date('Y')===date('Y',$unix)){
        $time=date('n月j日',$unix);
        }else{
        $time=date('Y年n月j日',$unix);
        }
        $unit='';
    }
    return $time.$unit;
}
/**
 * 画像ファイル名からURLを生成する関数
 *
 * @param string|null $name 画像ファイル名
 * @param string $type ユーザー画像（user）からツイート画像（tweet）
 * @return string
 */
function buildimagepath(string $name=null,string $type){
    if($type==='user' && !isset($name)){
        return HOME_URL.'Views/img/icon-default-user.svg';
    }
    return HOME_URL.'Views/img_uploaded/'.$type . '/' .html_escape($name);
}

/**
 * htmlエンティティにエスケープ
 *
 * @param string|null $text
 * @return string
 */
function html_escape($text){
if($text===null){
    $text= '';
}
return htmlspecialchars($text, ENT_QUOTES,'UTF-8');
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo HOME_URL; ?>Views/img/logo-twitterblue.svg" type="image/x-icon">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo HOME_URL; ?>Views/css/style.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- いいねjs -->
    <script src="<?php echo HOME_URL; ?>Views/js/like.js" defer></script>
    <title>ホーム画面 / Twitterクローン</title>
    <meta name="description" content="ホーム画面です">
</head>

<body class='home'>
    <div class="container">
        <div class="side">
            <div class="side-inner">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/logo-twitterblue.svg" alt="twitterクローンロゴ" class="icon"></a></li>
                    <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-home.svg" alt="ホームアイコン"></a></li>
                    <li class="nav-item"><a href="search.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-search.svg" alt="検索アイコン"></a></li>
                    <li class="nav-item"><a href="notification.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-notification.svg" alt="通知アイコン"></a></li>
                    <li class="nav-item"><a href="profile.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-profile.svg" alt="プロファイルアイコン"></a></li>
                    <li class="nav-item"><a href="post.php" class="nav-link"><img src="<?php echo HOME_URL; ?>Views/img/icon-post-tweet-twitterblue.svg" alt="ツイッターブルーアイコン" class="post-tweet"></a></li>
                    <li class="nav-item my-icon"><img src="<?php echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" class='js-popover' alt="リストアイコン" 
                        data-bs-container='body' data-bs-toggle='popover' data-bs-placement='right' data-bs-html='true' data-bs-content="<a href='profile.php'>プロフィール</a><br><a href='sign-out.php'>ログアウト</a>"
                    ></li>
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
                    <img src="<?php echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" alt="">
                    
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
            <?php if (empty($view_tweets)): ?>
                <p class="p-3">ツイートがありません。</p>
            <?php else: ?>
                <div class="tweet-list">
                    <?php foreach ($view_tweets as $view_tweet): ?>
                        <div class="tweet">
                            <div class="user">
                                <a href="profile.php?user_id=<?php echo html_escape($view_tweet['user_id']); ?>">
                                    <img src="<?php echo buildimagepath($view_tweet['user_icon'],'user')?>" alt="">
                                </a>
                            </div>
                            <div class="content">
                                <div class="name">
                                    <a href="profile.php?user_id=<?php echo html_escape($view_tweet['user_id']); ?>">
                                        <span class="nickname"><?php echo html_escape($view_tweet['user_nickname']); ?></span>
                                        <span class="user-name">@<?php echo html_escape($view_tweet['user_name']); ?>・<?php echo convertTodayTimeAgo($view_tweet['tweet_created_at']); ?></span>
                                    </a>
                                </div>
                                <p><?php echo $view_tweet['tweet_body']; ?></p>
                                <?php if ($view_tweet['tweet_image_name']): ?>
                                    <img src="<?php echo buildimagepath($view_tweet['tweet_image_name'],'tweet') ?>" alt="" class='post-image'>
                                <?php endif; ?>
                                <div class="icon-list">
                                    <div class="like js-like" data-like-id="<?php echo html_escape($view_tweet['like_id']);?>">
                                        <?php if (isset($view_tweet['like_id'])){
                                            //いいね！がある場合
                                            echo '<img src="' . HOME_URL . 'Views/img/icon-heart-twitterblue.svg" alt="">';
                                        }
                                        else{
                                            //いいねがない場合
                                            echo '<img src="'.HOME_URL.'Views/img/icon-heart.svg" alt="">';
                                        } ?>
                                    </div>  
                                    
                                    <div class="like-count js-like-count"><?php echo html_escape($view_tweet['like_count']); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>



        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('.js-popover').popover();
        })
    </script>
</body>
</html>