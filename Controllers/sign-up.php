<?php
//サインアップコントローラー

//設定を詠み込み
include_once '../config.php';
//ユーザーモデルを詠み込み
include_once '../Models/users.php';
//便利な関数を詠み込む
include_once('../util.php');

//エラーメッセージ格納用
$error_messages = [];



//登録項目がすべて入力されているか確認
if(isset($_POST['nickname']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){
    $data=[
        'nickname' => $_POST['nickname'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ];

    //バリデーション
    //重複メールアドレスの確認

    if(findUserByEmail($data['email'])){
        //重複メールアドレスがあれば、エラーメッセージを表示
        $error_messages[] = 'すでに登録されているメールアドレスです。';
    }

    //その他の実装すべきバリデーション
    //-文字数制限
    //-メールアドレスの形式が正しいか
    //-重複ユーザー名の確認

    //エラーがなければ登録

    if(!($error_messages)){
        //ユーザー作成し、成功すれば
        if(createUser($data)){
            //ログイン画面に遷移
            header('Location:' . HOME_URL . 'Controllers/sign-in.php');
            exit;
        }

    }

    
}
    
//画面表示
$view_error_messages=$error_messages;
include_once '../Views/sign-up.php';

?>
