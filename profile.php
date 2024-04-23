<?php
session_start();

if (!$_SESSION['user'] || empty($_SESSION['user'])) {
    header('Location: /ekzKval/profile.php');
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
    <div class="profile_content">
        <div>
            <h2 style="margin: 10px 0;" id='usernname' data-id="<?= $_SESSION['user']['name'] ?>">Имя: <?= $_SESSION['user']['name'] ?></h2>
            <h2 href="#">Фамилия: <?= $_SESSION['user']['surname'] ?></h2>     
        </div>
        <a href="vendor/logout.php" class="logout">Выход</a>        
    </div>

    <main class="main_user">
        <form action="" id="form" class='gap-15' data-id="<?= $_SESSION['user']['id']?>" data-tel="<?= $_SESSION['user']['tel']?>">
            <div class="relative flex flex-col " >
                <label class="colorName">Добавьте картинку</label>
                <input type="file" name="file" placeholder="" required>
                <p name='file'></p>
            </div>  
            <button type="submit" class="new-btn colorName buttonSend" class="">Добавить фотографию</button>
        </form>
    <div class="switch-menu">
        <p onclick="getPhotosSentAndReceived(event)" data-name="my" class="border-bottom colorName">Мои фотокарточки</p>
        <p onclick="getPhotosSentAndReceived(event)" data-name="sent" class="colorName">Отправленные</p>
        <p onclick="getPhotosSentAndReceived(event)" data-name="received" class="colorName">Полученные</p>
    </div>
        <div  class='gap-15 ' style='margin-top: 20px;' class="newsa">
            <div id='userStatements' class="containter" data-id="<?= $_SESSION['user']['id']?>"></div>
        </div>
        
    </main>
</body>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/profile.js"></script>
</html>