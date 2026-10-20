<?php
//エラー表示
error_reporting(E_ALL);
ini_set('display_errors', 1);
//日本時間
date_default_timezone_set('Asia/Tokyo');
//ディレクトリ設定
define('HOME_URL', '/TwClone/');
//データベースの接続情報
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_NAME','twitterクローン');