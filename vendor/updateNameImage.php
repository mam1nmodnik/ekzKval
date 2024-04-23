<?php
session_start();
require_once 'connect.php'; // Подключение к базе данных уже выполнено

// Проверяем, установлены ли id и name в POST-запросе
if(isset($_POST['id']) && isset($_POST['name'])) {
    // Очищаем и валидируем входные данные
    $id = intval($_POST['id']); // Преобразуем id в целое число
    $name = trim($_POST['name']); // Удаляем пробелы вокруг имени

    // Подготавливаем и привязываем параметры для предотвращения инъекций SQL
    $stmt = $connect->prepare("UPDATE `photos` SET `name` = ? WHERE `id` = ?");
    $stmt->bind_param("si", $name, $id);
    
    // Выполняем запрос на обновление
    if($stmt->execute()) {
        // Возвращаем успешный статус
        echo json_encode(array("status" => true, "message" => "Название обновлено."));
    } else {
        // Возвращаем статус ошибки
        echo json_encode(array("status" => false, "error" => "Не удалось обновить имя."));
    }

    // Закрываем выражение
    $stmt->close();
} else {
    // Возвращаем статус ошибки, если id или name не установлены
    echo json_encode(array("status" => false, "error" => "ID или имя не предоставлены."));
}
?>
