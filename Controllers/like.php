<?php
//ライクコントローラー

//設定を詠み込み
include_once '../config.php';
//便利な関数を詠み込む
include_once('../util.php');

//いいね！データ操作モデルを詠み込む;
include_once '../Models/likes.php';

//ログインチェック
$user = getUserSession();
if (!$user) {
    //404エラー
    header('HTTP/1.0 404 Not Found');
    exit;
}

//いいね！する
$like_id = null;
if(isset($_POST['tweet_id'])){
    $data = [
        'user_id' => $user['id'],
        'tweet_id' => $_POST['tweet_id'],
    ];
    $like_id = createLike($data);
}

//いいね！削除
if(isset($_POST['like_id'])){
    $data = [
        'like_id' => $_POST['like_id'],
        'user_id' => $user['id'],
    ];
    deleteLike($data);
}

//Jsonで返す
$response = [
    'message' => 'success',
    //  いいね！したときには値が入る
    'like_id' => $like_id,
];

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);