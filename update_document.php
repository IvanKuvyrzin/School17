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
$id = $conn->real_escape_string($data['id']);
$namer = $conn->real_escape_string($data['namer']);
$name = $conn->real_escape_string($data['name']);
$urll = $conn->real_escape_string($data['urll']);

$sql = "UPDATE info SET Namer='$namer', Name='$name', Urll='$urll' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error));
}

$conn->close();
?>
