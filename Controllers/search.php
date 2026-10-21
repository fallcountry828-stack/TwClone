<?php
//サーチコントローラー

//設定を詠み込み
include_once '../config.php';
//便利な関数を詠み込む
include_once('../util.php');

// ツイートデータ操作モデルを詠み込む
include_once '../Models/tweets.php';

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

//Todo:ログインチェック
$user=getUserSession();
if(!$user){
    //ログインしていない
    header('Location:' . HOME_URL . "Controllers/sign-in.php");
    exit;
}

//検索キーワードを取得
$keyword=null;
if(isset($_GET['keyword'])){
    $keyword= $_GET['keyword'];
}


//画面表示
$view_user = $user;
$view_keyword = $keyword;
//検索ツイートを取得
$view_tweets = findTweets($user,$keyword);
include_once '../views/search.php';