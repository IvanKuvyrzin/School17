<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school17";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array('success' => false, 'message' => 'Connection failed: ' . $conn->connect_error)));
}

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$intel = $data['intel'];
$details = $data['details'];

// Отладочная информация
error_log("Updating record with Intel: $id, New Intel: $intel, New Details: $details");

$sql = "UPDATE Detail SET Intel = ?, Details = ? WHERE Intel = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die(json_encode(array('success' => false, 'message' => 'Prepare failed: ' . $conn->error)));
}
$stmt->bind_param('sss', $intel, $details, $id);

if ($stmt->execute()) {
    echo json_encode(array('success' => true));
} else {
    error_log("Error updating record: " . $stmt->error); // Записываем ошибку в лог
    echo json_encode(array('success' => false, 'message' => 'Error updating record: ' . $stmt->error));
}

$stmt->close();
$conn->close();
?>
