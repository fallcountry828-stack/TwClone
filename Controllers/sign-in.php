<?php
//サインインコントローラー

//設定を詠み込み
include_once '../config.php';
//ユーザーモデルを詠み込み
include_once '../Models/users.php';
//便利な関数を詠み込む
include_once('../util.php');

//ログイン結果
$login_result = null;

//メールアドレスとパスワードの入力チェック
if(isset($_POST['email']) && isset($_POST['password'])){
    //ログインチェックを実行
    $user = findUserAndCheckPassword($_POST['email'],$_POST['password']);

    //ログインに成功した場合
    if($user){
        //ユーザー情報をセッションに保存
        saveUserSession($user);
        
        //ホーム画面への遷移
        header('Location:' . HOME_URL . "Controllers/home.php");
        exit;
    }
    //ログインに失敗した場合
    else{
        //ログイン結果を失敗にする
        $login_result = false;
    }
}

//画面表示
$view_login_result = $login_result;
include_once '../Views/sign-in.php';

?>