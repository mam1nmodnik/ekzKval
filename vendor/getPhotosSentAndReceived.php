<?php
session_start();
require_once 'connect.php';

// Запрос данных заявлений
$query = "SELECT * FROM `sentPhoto`";
$result = mysqli_query($connect, $query);

// Получение ID текущего пользователя
$user_id = $_SESSION['user']['id'];

// Формирование массива данных заявлений
$photosData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $photosData[] = $row;
}


$response = [
    'user_id' => $user_id,
    'photosData' => $photosData,
];

// Отправка данных в формате JSON
header('Content-Type: application/json');
echo json_encode($response);

