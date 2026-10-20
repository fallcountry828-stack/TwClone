<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include_once('../Views/common/head.php'); ?>

    <title>新規登録 / Twitterクローン</title>
    <meta name="description" content="新規登録画面です">
</head>

<body class='signup text-center'>
    <main class='form-signup'>
        <form action="sign-up.php" method="post">
            <img src="<?php echo HOME_URL; ?>Views/img/logo-white.svg" class='logo-white'>
            <h1>アカウントを作る</h1>
            <!--バリデーションエラーがある場合は表示-->
            <?php if(!empty($view_error_messages)):?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach($view_error_messages as $view_error_message){
                        echo '*'. $view_error_message . '<br>';
                    }
                    ?>
                </div>  
            <?php endif;?>
            
            <input type="text" class='form-control' name="nickname" placeholder='ニックネーム' maxlength="50" required autofocus>
            <input type="text" class='form-control' name="name" placeholder='ユーザー名' maxlength="50" required>
            <input type="email" class='form-control' name="email" placeholder='メールアドレス' maxlength="254" required>
            <input type="password" class='form-control' name="password" placeholder='パスワード' minlength="4" maxlength="128" required>
            <button class="w-100 btn btn-lg mt-3 mb-2" type="submit">登録する</button>
            <p class="mt-3 mb-2"><a href="sign-in.php">ログインする</a></p>
        </form>
    </main>
    <?php include_once('../Views/common/foot.php'); ?>
</body>

</html>