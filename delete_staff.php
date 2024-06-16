<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school17";

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получаем данные из POST-запроса
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

// Удаляем данные из таблицы Teams
$sql = "DELETE FROM Teams WHERE ID=$id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$conn->close();
?>