<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school17";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$img = $data['img'];
$name = $data['name'];
$text = $data['text'];
$fText = $data['fText'];

$sql = "INSERT INTO news (img, name, text, FText) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $img, $name, $text, $fText);

$response = array();

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['message'] = $stmt->error;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
