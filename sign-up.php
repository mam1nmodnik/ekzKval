<?php
    session_start();
    if ($_SESSION['user']) {
        header('Location: /profile.php');
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
<body class="body">
    <!-- Форма регистрации -->
    <form class="gap-15">
        <div class="relative flex flex-col ">
            <label class="colorName">Имя</label>
            <input type="text" name="name" placeholder="Введите свое имя" required class="newinput"> 
            <p name='name'></p>
        </div>
        <div class="relative flex flex-col ">
            <label class="colorName">Фамилия</label>
            <input type="text" name="surname" placeholder="Введите свою фамилию" required class="newinput">
            <p name='surname'></p>
        </div>
        <div class="relative flex flex-col ">
            <label class="colorName">Телефон</label>
            <input type="tel" name="tel" id="phone" required class="newinput" placeholder="8 (999) 999-99-99">
            <p name='tel'></p>
        </div>
        <div class="relative flex flex-col ">
            <label class="colorName">Пароль</label>
            <input type="password" name="password" placeholder="Введите пароль" required class="newinput">
            <p name='password'></p>
        </div>
        <button type="submit" class="register-btn colorName buttonSend">Зарегистрироваться</button>
        <p class="colorName">
            У вас уже есть аккаунт? - <a href="/ekzKval/">авторизируйтесь</a>!
        </p>
        <p class="msg none"></p> 
    </form>
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>