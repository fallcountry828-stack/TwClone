<?php
//ツイート関連の処理//

/**
 * ツイートを作成する
 * @param array $data
 * @return bool
 */
function createTweet(array $data)
{
    include('../ConnectDB.php');
    

    //SQLクエリを作成（ツイート新規登録）
    $query = 'insert into tweets (user_id,body,image_name) values (?,?,?);';

    //ブリペアードステートメントに、作成したクエリを登録
    $statement = $mysqli->prepare($query);

    //クエリをプレースホルダ（？）にカラムの値を紐づけ
    $statement->bind_param('iss', $data['user_id'], $data['body'], $data['image_name']);

    //クエリを実行
    $response = $statement->execute();

    //エラーの場合は、エラー表示
    if($response === false){
        echo 'Mysql エラー: ' . $mysqli->error . "\n";
        exit;
    }

    //DB接続を解放
    $statement->close();
    $mysqli->close();

    //結果を返却
    return $response;
}