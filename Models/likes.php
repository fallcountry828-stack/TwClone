<?php
//いいねデータ処理

/**
 * いいね作成
 *
 * @param array $data
 * @return int|false
 */
function createLike(array $data){
    include('../ConnectDB.php');

    //新規登録のsqlを作成
    $query = 'INSERT INTO likes (user_id, tweet_id) values(?,?);';
    $statement = $mysqli->prepare($query);

    //プレースホルダーにセット
    $statement->bind_param('ii', $data['user_id'], $data['tweet_id']);
    
    //クエリ実行
    if($statement->execute()){
        //結果をIDで返却
        $response=$mysqli->insert_id;
    }else{
        //エラー
        $response=false;
        echo 'Mysql エラー: ' . $mysqli->error . "\n";
    }
    //DB接続を解放
    $mysqli->close();
    $statement->close();
    
    //結果を返却
    return $response;
}

/**
 * いいねの削除（論理削除）
 *
 * @param array $data
 * @return bool
 */
function deleteLike(array $data){
    include '../ConnectDB.php';
    //更新のSQLを作成（論理削除）
    $query = "UPDATE likes SET status = 'deleted' WHERE user_id = ? AND id = ?;";
    $statement = $mysqli->prepare($query);

    //プレースホルダにセット
    $statement->bind_param('ii', $data['user_id'], $data['like_id']);

    //クエリ実行
    $response = $statement->execute();

    //Mysqlエラー
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