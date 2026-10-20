<?php
//ポストコントローラー

//設定を詠み込み
include_once '../config.php';
//ツイートモデルを詠み込み
include_once '../Models/tweets.php';
//便利な関数を詠み込む
include_once('../util.php');

//ログインチェック
$user=getUserSession();
if(!$user){
    //ログインしていない
    header('Location:' . HOME_URL . "Controllers/sign-in.php");
    exit;
}

//ツイートがある場合
if(isset($_POST['body'])){
    $image_name=null;
    if(isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])){
        //画像がアップロードされている
        $image_name=uploadImage($user,$_FILES['image'],'tweet');
    }

    $data=[
        'user_id'=>$user['id'],
        'body'=>$_POST['body'],
        'image_name'=>$image_name,
    ];

    

    //Todo: つぶやき投稿
    if(createTweet($data)){
        //ホーム画面に遷移
        header('Location:' . HOME_URL . "Controllers/home.php");
        exit;
    }
}

//画面表示
$view_user = $user;
include_once '../views/post.php';
