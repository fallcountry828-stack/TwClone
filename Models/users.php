<?php
//ユーザーデータを処理//

/**
 * 新規ユーザーを作成する
 * @param array $data
 * @return bool
 */
function createUser(array $data)
{
    include('../ConnectDB.php');
    

    //SQLクエリを作成（ユーザー新規登録）
    $query = 'insert into users (email,name,nickname,password) values (?,?,?,?);';
    //パスワードをハッシュ値に変換
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    //ブリペアードステートメントに、作成したクエリを登録
    $statement = $mysqli->prepare($query);

    //クエリをプレースホルダ（？）にカラムの値を紐づけ
    $statement->bind_param('ssss', $data['email'], $data['name'], $data['nickname'], $data['password']);

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
 * emailを元にユーザーを検索する
 * @param string $email
 * @return array|false
 */
function findUserByEmail(string $email){

    include('../ConnectDB.php');
    //クエリ作成
    //入力欄をエスケープ
    $email = $mysqli->real_escape_string($email);

    $query = 'SELECT * FROM users WHERE email = "' . $email . '"';

    //SQL実行
    $result = $mysqli->query($query);
    if(!$result){
        //mysql処理中にエラー発生
        echo'エラーメッセージ'.$mysqli->error."\n";
        $mysqli->close();
        return false;
    }

    //ユーザー情報を取得
    $user = $result->fetch_array(MYSQLI_ASSOC);
    if(!$user){
        //ユーザーが存在しない
        $mysqli->close();
        return false;
    }

    //DB解放
    $mysqli->close();

    //結果を返却
    return $user;
}

/**
 * emailを元にユーザーを検索してパスワードを確認
 * @param string $email
 * @param string $password
 * @return array|false
 */
function findUserAndCheckPassword(string $email,string $password){

    include('../ConnectDB.php');
    //クエリ作成
    //入力欄をエスケープ
    $email = $mysqli->real_escape_string($email);

    $query = 'SELECT * FROM users WHERE email = "' . $email . '"';

    //SQL実行
    $result = $mysqli->query($query);
    if(!$result){
        //mysql処理中にエラー発生
        echo'エラーメッセージ'.$mysqli->error."\n";
        $mysqli->close();
        return false;
    }

    //ユーザー情報を取得
    $user = $result->fetch_array(MYSQLI_ASSOC);
    if(!$user){
        //ユーザーが存在しない
        $mysqli->close();
        return false;
    }

    //パスワードチェック
    if(!password_verify($password, $user['password'])){
        //パスワード不一致
        $mysqli->close();
        return false;
    }

    //DB解放
    $mysqli->close();

    //結果を返却
    return $user;
}    