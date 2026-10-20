<?php
//配列

/**
 * ツイート日時を「〇分前」や「〇時間前」に変換する関数
 * @param string $datetime
 * @return string 
 */
function convertTodayTimeAgo(string $datetime)
{
    //引用の日時をunixタイムスタンプに変換
    //unixタイムは1970年1月1日からの経過秒数
    $unix = strtotime($datetime);
    //現在日時をunixタイムスタンプに変換
    $now = time();
    //現在日時と引用の日時の差分を秒単位で計算
    $diff_second = $now - $unix;
    if($diff_second<60){
        $time=$diff_second;
        $unit="秒前";
    }elseif($diff_second<60*60){
        $time=round($diff_second/60);
        $unit="分前";
    }elseif($diff_second<60*60*24){
        $time=round($diff_second/60/60);
        $unit="時間前";
    }elseif($diff_second<60*60*24*30){
        $time=round($diff_second/60/60/24);
        $unit="日前";
    }else{
        if(date('Y')===date('Y',$unix)){
        $time=date('n月j日',$unix);
        }else{
        $time=date('Y年n月j日',$unix);
        }
        $unit='';
    }
    return $time.$unit;
}
/**
 * 画像ファイル名からURLを生成する関数
 *
 * @param string|null $name 画像ファイル名
 * @param string $type ユーザー画像（user）からツイート画像（tweet）
 * @return string
 */
function buildimagepath(string $name=null,string $type){
    if($type==='user' && !isset($name)){
        return HOME_URL.'Views/img/icon-default-user.svg';
    }
    return HOME_URL.'Views/img_uploaded/'.$type . '/' .html_escape($name);
}

/**
 * htmlエンティティにエスケープ
 *
 * @param string|null $text
 * @return string
 */
function html_escape($text){
if($text===null){
    $text= '';
}
return htmlspecialchars($text, ENT_QUOTES,'UTF-8');
}

/**
 * ユーザー情報をセッションに保存
 * 
 * @param array $user
 * @return void
 */
function saveUserSession(array $user)
{
    //セッションを開始していない場合
    if(session_status()===PHP_SESSION_NONE){
        //セッション開始
        session_start();
    }

    $_SESSION['user']=$user;
}

/**
 * ユーザー情報をセッションから削除
 * 
 * @return void
 */
function deleteUserSession()
{
    //セッションを開始していない場合
    if(session_status()===PHP_SESSION_NONE){
        //セッション開始
        session_start();
    }

    unset($_SESSION['user']);
}

/**
 * セッションからユーザー情報を取得
 * 
 * @return array|false
 */
function getUserSession()
{
    //セッションを開始していない場合
    if(session_status()===PHP_SESSION_NONE){
        //セッション開始
        session_start();
    }

    if(!isset($_SESSION['user'])){
        //セッションにユーザー情報がない
        return false;
    }
    $user = $_SESSION['user'];
    
    //画像のファイル名からファイルのURLを取得
    if(!isset($user['image_name'])){
        $user['image_name']=null;
    }
    //画像が設定されていない場合は、デフォルトのアイコン画像を表示
    $user['image_path'] = buildimagepath($user['image_name'],'user');
    return $user;
}

/**
 * 画像をアップロードする
 * 
 * @param array $user
 * @param array $file
 * @param string $type
 * @return string 画像ファイル名
 */
function uploadImage(array $user,array $file,string $type){
    //画像のファイル名から拡張しを取得（例：png）
    $image_extension = strchr($file['name'],'.');
    //画像のファイル名を作成
    $image_name=$user['id']."_".date('YmdHis').$image_extension;
    //保存先のディレクトリ
    $directory = '../Views/img_uploaded/'. $type . '/';
    //画像のパス
    $image_path=$directory.$image_name;
    //画像を設置
    move_uploaded_file($file['tmp_name'],$image_path);
    //画像ファイルかチェック
    if(exif_imagetype($image_path)){
        return $image_name;
    }
    //画像ファイル以外の場合
    echo '選択されたファイルは画像ではないため処理を停止しました';
    exit;
}
