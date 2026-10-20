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

/**
 * ツイート一覧を取得する
 * @param array $user
 * @return array|false
 */
function findTweets(array $user)
{
    include '../ConnectDB.php';

    //ログインユーザーidをエスケープ
    $login_user_id = $mysqli->real_escape_string($user['id']);

    //検索のSQLの作成
    $query = <<<SQL
        SELECT
            T.id as tweet_id,
            T.status as tweet_status,
            T.body as tweet_body,
            T.image_name as tweet_image_name,
            T.created_at as tweet_created_at,
            U.id as user_id,
            U.name as user_name,
            U.nickname as user_nickname,
            U.image_name as user_image_name,
            U.image_name as user_icon,
            -- ログインユーザーがいいね！したか（している場合、値が入る）
            L.id as like_id,
            -- いいねの数を集計
            (SELECT COUNT(*) FROM likes WHERE status = 'active' AND tweet_id = T.id) as like_count
            -- Todo:リツイート数を集計
        FROM tweets as T
        -- ユーザーテーブルを紐づける
        JOIN users as U ON U.id = T.user_id AND U.status = 'active'
        -- いいねテーブルを紐づける
        LEFT JOIN likes as L ON L.tweet_id = T.id AND L.status = 'active' AND L.user_id = '$login_user_id'
        WHERE T.status = 'active'
        ORDER BY T.created_at DESC
    SQL;
    if($result = $mysqli->query($query)){
        //連想配列を取得
        $response=$result->fetch_all(MYSQLI_ASSOC);
        
    }else{
        $response= null;
        echo'エラーメッセージ:'. $mysqli->error . "\n";
    }
    $mysqli->close();
    
    return $response;
}