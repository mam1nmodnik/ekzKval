<?php
session_start();

if ($_SESSION['user']) {
    header('Location: /ekzKval/profile.php');
}

?>

<!doctype html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="yandex-verification" content="c7a1323ca756bc5f" />


    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body class='body'>

    <!-- Форма авторизации -->

    <form class="gap-15"> 
        <div class='relative flex flex-col'>
            <label class="colorName">Телефон</label>
            <input type="text" name="tel" placeholder="Введите свой номер" required class="newinput"> 
            <p name='tel'></p>
        </div>
        <div class='relative flex flex-col'>
            <label class="colorName">Пароль</label>
            <input type="password" name="password" placeholder="Введите пароль" required class="newinput">
            <p name='password'></p>
        </div>
        <button type="submit" class="login-btn colorName buttonSend">Войти</button>
        <p class="colorName">
            У вас нет аккаунта? - <a href="/ekzKval/sign-up.php">зарегистрируйтесь</a>!
        </p>
        <p class="msg none"></p> 
    </form>

    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>