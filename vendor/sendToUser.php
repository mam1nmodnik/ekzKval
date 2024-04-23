<?php

session_start();
require_once 'connect.php';

$namePhoto = isset($_POST['namePhoto']) ? $_POST['namePhoto'] : '';
$linkPhoto = isset($_POST['linkPhoto']) ? $_POST['linkPhoto'] : '';
$sentByUserId = isset($_POST['sentByUserId']) ? $_POST['sentByUserId'] : '';
$sentUserName = isset($_POST['sentUserName']) ? $_POST['sentUserName'] : '';
$userId = isset($_POST['userId']) ? $_POST['userId'] : '';

if($userId === '' || empty($userId)) {
    $response = [
        'status' => false,
        'message' => 'Вы не выбрали пользователя'
    ];
} else {
    // Подготовка запроса
    $stmt = mysqli_prepare($connect, "INSERT INTO `sentPhoto`(`id`, `userId`, `sentUserName`, `linkPhoto`, `namePhoto`, `sentUserId`) VALUES (NULL, ?, ?, ?, ?, ?)");

    // Привязываем значения к параметрам
    mysqli_stmt_bind_param($stmt, 'issss', $userId, $sentUserName, $linkPhoto, $namePhoto, $sentByUserId);

    // Выполнение запроса
    if (mysqli_stmt_execute($stmt)) {
        $response = [
            'status' => true,
            'message' => 'Фото успешно отправлено '
        ];
    } else {
        $response = [
            'status' => false,
            'message' => 'Ошибка при отправке фото'
        ];
    }
}

// Возвращаем ответ в формате JSON
header('Content-Type: application/json');
echo json_encode($response);
