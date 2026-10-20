<?php
    //DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    //接続エラーの場合
    if($mysqli->connect_error){
        echo 'MYSQLの接続に失敗しました。:' . $mysqli->connect_error . "\n";
        exit;
    }