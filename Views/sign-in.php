<?php
//設定画面を詠み込む
include_once('../config.php');
//便利な関数を詠み込む
include_once('../util.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo HOME_URL; ?>Views/img/logo-twitterblue.svg" type="image/x-icon">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo HOME_URL; ?>Views/css/style.css">

    <title>ログイン画面 / Twitterクローン</title>
    <meta name="description" content="ログイン画面です">
</head>

<body class='signup text-center'>
    <main class='form-signup'>
        <form action="sign-in.php" method="post">
            <img src="<?php echo HOME_URL; ?>Views/img/logo-white.svg" class='logo-white'>
            <h1>アカウントにログインする</h1>

            <?php if (isset($view_login_result) && $view_login_result === false) : ?>
                <div class="alert alert-warning text-sm" role="alert">
                    メールアドレスとパスワードが正しくありません。
                </div>
            <?php endif; ?>

            <input type="email" class='form-control' name="email" placeholder='メールアドレス' maxlength="254" required autofocus>
            <input type="password" class='form-control' name="password" placeholder='パスワード' minlength="4" maxlength="128" required>
            <button class="w-100 btn btn-lg mt-3 mb-2" type="submit">ログインする</button>
            <p class="mt-3 mb-2"><a href="sign-up.php">アカウントを新規登録する</a></p>
        </form>
    </main>
</body>
<?php include_once('../Views/common/foot.php'); ?>
</html>