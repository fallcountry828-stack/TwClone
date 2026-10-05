<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Views/img/logo-twitterblue.svg" type="image/x-icon">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../Views/css/style.css">

    <title>新規登録 / Twitterクローン</title>
    <meta name="description" content="新規登録画面です">
</head>

<body class='signup text-center'>
    <main class='form-signup'>
        <form action="sign-up.php" method="post">
            <img src="../Views/img/logo-white.svg" class='logo-white'>
            <h1>アカウントを作る</h1>
            <input type="text" class='form-control' name="nickname" placeholder='ニックネーム' maxlength="50" required autofocus>
            <input type="text" class='form-control' name="name" placeholder='ユーザー名' maxlength="50" required>
            <input type="email" class='form-control' name="email" placeholder='メールアドレス' maxlength="254" required>
            <input type="password" class='form-control' name="password" placeholder='パスワード' minlength="4" maxlength="128" required>
            <button class="w-100 btn btn-lg mt-3 mb-2" type="submit">登録する</button>
            <p class="mt-3 mb-2"><a href="sign-in.php">ログインする</a></p>
        </form>
    </main>
</body>

</html>