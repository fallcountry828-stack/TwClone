<?php
//サインアウトコントローラー

//設定を詠み込み
include_once '../config.php';
//便利な関数を詠み込む
include_once('../util.php');

//ユーザー情報をセッションから削除
deleteUserSession();

//ログイン画面にリダイレクト
header('Location: ' . HOME_URL . 'Controllers/sign-in.php');
exit;
