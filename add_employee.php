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
$img = $data['img'];
$name = $data['name'];
$text = $data['text'];

// Вставляем новые данные в таблицу Teams
$sql = "INSERT INTO Teams (Img, Name, Text) VALUES ('$img', '$name', '$text')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$conn->close();
?>
