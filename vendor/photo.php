<?php
session_start();
require_once 'connect.php';

// Запрос данных заявлений
$query = "SELECT * FROM `photos`";
$result = mysqli_query($connect, $query);

// Получение ID текущего пользователя
$user_id = $_SESSION['user']['id'];

// Формирование массива данных заявлений
$photosData = [];
while ($row = mysqli_fetch_assoc($result)) {
    if($row['user_id'] = $user_id){
        $photosData[] = $row;
    }
}

// запрос юзеров
$users = "SELECT id, name FROM `regUser`"; // Запрос только для id и name
$usersResult = mysqli_query($connect, $users);

$userData = [];
while ($row = mysqli_fetch_assoc($usersResult)) {
    if($row['user_id'] = $user_id){
    $userData[] = $row;
    }
}

// Добавление ID пользователя к данным
$response = [
    'user_id' => $user_id,
    'photosData' => $photosData,
    'userData' => $userData
];

// Отправка данных в формате JSON
header('Content-Type: application/json');
echo json_encode($response);

