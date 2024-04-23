<?php

session_start();
require_once 'connect.php';

// Получаем данные из POST
$id_user = $_POST['id'] ?? '';
$useTel = $_POST['tel'] ?? '';
$name = 'Untitled'; 
$status = 1;

$error_fields = [];

// Проверяем, был ли файл успешно загружен
if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    $error_fields[] = ['inp' => 'file', 'message' => 'Ошибка загрузки файла'];
}

// Если есть ошибки, отправляем ответ с информацией об ошибках
if (!empty($error_fields)) {
    $response = [
        "status" => false,
        "type" => 1,
        'inp' => 'file', 
        'message' => 'Вы не выбрали файл для загрузки'
    ];
    echo json_encode($response);
    die();
}

// Фильтруем и санализируем входные данные

$fileStore = $useTel . "-m2";

// Проверяем разрешенные типы файлов
$allowedExtensions = ['jpg', 'jpeg', 'png'];
$fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
if (!in_array($fileExtension, $allowedExtensions)) {
    $response = [
        "status" => false,
        "type" => 1,
        "inp" => "file", 
        "message" => "Неверный тип файла"
    ];
    echo json_encode($response);
    die();
}

// Путь, куда будет сохранен файл
$directory = "../assets/uploads/{$fileStore}/";
if (!is_dir($directory)) {
    if (!mkdir($directory, 0777, true)) {
        $response = [
            "status" => false,
            "message" => "Ошибка создания директории для загрузки файла"
        ];
        echo json_encode($response);
        die();
    }
}


imagepng(imagecreatefromstring(file_get_contents($filename)), "output.png");
$newFileName = time() . '_' . basename($filename);
$path =  $directory . $newFileName;
$tmp_name = $_FILES['file']['tmp_name'];
 
// Перемещаем файл из временной директории в нужное место
if (!move_uploaded_file($tmp_name, $path)) {
    $response = [
        "status" => false,
        "message" => "Вы не загрузили файл"
    ];
    echo json_encode($response);
    die();
}
$newDirectory = "../ekzKval/assets/uploads/{$fileStore}/" . $newFileName ;
// Подготовленный запрос для вставки данных в базу данных
$stmt = $connect->prepare("INSERT INTO `photos`(`id`, `userId`, `name`, `link`) VALUES (NULL, ?, ?, ?)");

// Проверяем, успешно ли подготовлен запрос
if (!$stmt) {
    $response = [
        "status" => false,
        "message" => "Ошибка подготовки запроса"
    ];
    echo json_encode($response);
    die();
}

// Привязываем параметры к подготовленному запросу и выполняем его
$stmt->bind_param("iss", $id_user, $name, $newDirectory);
if ($stmt->execute()) {
    $response = [
        "status" => true,
        "message" => "Успешно выполнено"
    ];
    echo json_encode($response);
} else {
    $response = [
        "status" => false,
        "message" => "Ошибка выполнения запроса"
    ];
    echo json_encode($response);
}

// Закрываем подготовленный запрос
$stmt->close();