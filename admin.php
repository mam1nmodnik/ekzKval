<?php
session_start();

if (!$_SESSION['user'] || empty($_SESSION['user'])) {
    header('Location: /');
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>


    <form>
        <h2 style="margin: 10px 0;"><?= $_SESSION['user']['full_name'] ?></h2>
        <a href="#"><?= $_SESSION['user']['email'] ?></a>
        <a href="vendor/logout.php" class="logout">Выход</a>
    </form>


    <main class="flex main_user">
    <div id='userStatements' class="containter">
    </div>
    </main>
</body>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/admin.js"></script>
</html>