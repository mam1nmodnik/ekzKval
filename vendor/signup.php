<?php

session_start();
require_once 'connect.php';

$name = $_POST['name'];
$surname = $_POST['surname'];
$password = $_POST['password'];
$tel = $_POST['tel'];
$role = 'user';
$check_tel = mysqli_query($connect, "SELECT * FROM `regUser` WHERE `tel` = '$tel'");
if (mysqli_num_rows($check_tel) > 0) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Такой телефон уже зарегестрирован",
        "fields" => ['tel']
    ];
    echo json_encode($response);
    die();
}

$error_fields = [];

if ($name === '' || empty($name)) {
    $error_fields[] = ['inp' => 'name','message' =>  'Имя не заполнен', ];
}

if ($password === '' || empty($password)) {
    $error_fields[] = ['inp' => 'password','message' =>  'Пароль не заполнен'];
}

if ($surname === ''  || empty($surname)) {
    $error_fields[] = ['inp' => 'surname', 'message' => 'Фамилия не заполнена'];
}

if($tel === '' || empty($tel)) {
    $error_fields[] = ['inp' => 'tel', 'message' => 'Вы не ввели номер'];
} 

function validatePhoneNumber($tel) {
    $tel = preg_replace('/\D/', '', $tel);
    if (strlen($tel) < 7 || strlen($tel) > 15) {
        return false;
    }
    if (!preg_match('/^(8|\+7)/', $tel)) {
        return false;
    }

    if (!preg_match('/^((8|\+7)\d{10}|(\+7)?\(?\d{3}\)?\d{7,8})$/', $tel)) {
        return false;
    }
    return true;
}


if(!validatePhoneNumber($tel)) {
    $error_fields[] = ['inp' => 'tel', 'message' => 'Вы ввели некорректный номер'];
} 

if (!empty($error_fields)) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Проверьте правильность полей",
        "fields" => $error_fields
    ];

    echo json_encode($response);
    die();
}

    $password = md5($password);

    mysqli_query($connect, "INSERT INTO `regUser` (`id`, `name`, `surname`, `password`, `tel`, `role`) VALUES (NULL, '$name', '$surname', '$password', '$tel', '$role')");

    $response = [
        "status" => true,
        "message" => "Регистрация прошла успешно!",
    ];
    echo json_encode($response);

die();