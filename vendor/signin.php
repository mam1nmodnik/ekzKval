<?php


session_start();
require_once 'connect.php';


$tel = isset($_POST['tel']) ? $_POST['tel'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';


$error_fields = [];


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

if ($password === '' || empty($password)) {
    $error_fields[] = ['inp' => 'password','message' =>  'Пароль не заполнен'];
}

if (!empty($error_fields)) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Проверьте правильность полей",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    exit;
}


$password = md5($password);


$query = "SELECT * FROM `regUser` WHERE `tel` = '$tel' AND `password` = '$password'";
$result = mysqli_query($connect, $query);


if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    
  
    if ($user['role'] == 'admin') {
        $_SESSION['user'] = [
            "id" => $user['id'],
            "name" => $user['name'],
            "surname" => $user['surname'],
            "tel" => $user['tel'],
            "role" => $user['role']
        ];
        $response = [
            "role" => 'admin',
            "status" => true
        ];
    } else if ($user['role'] == 'user') {
        $_SESSION['user'] = [
            "id" => $user['id'],
            "name" => $user['name'],
            "surname" => $user['surname'],
            "tel" => $user['tel'],
            "role" => $user['role']
        ];
        $response = [
            "role" => 'user',
            "status" => true
        ];
    }
} else {
    $response = [
        "status" => false,
        "message" => 'Неверный логин или пароль'
    ];
}

echo json_encode($response);