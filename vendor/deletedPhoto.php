<?php
session_start();
require_once 'connect.php'; // Подключение к базе данных уже выполнено

// Проверяем, установлен ли id в POST-запросе
if(isset($_POST['id'])) {
    // Очищаем и валидируем входные данные
    $id = intval($_POST['id']); // Преобразуем id в целое число

    // Подготавливаем и привязываем параметры для предотвращения инъекций SQL
    $stmt = $connect->prepare("DELETE FROM `photos` WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    
    // Выполняем запрос на удаление
    if($stmt->execute()) {
        // Возвращаем успешный статус
        echo json_encode(array("status" => true, "message" => "Запись успешно удалена."));
    } else {
        // Возвращаем статус ошибки
        echo json_encode(array("status" => false, "error" => "Не удалось удалить запись."));
    }

    // Закрываем выражение
    $stmt->close();
} else {
    // Возвращаем статус ошибки, если id не установлен
    echo json_encode(array("status" => false, "error" => "ID не предоставлен."));
}
?>