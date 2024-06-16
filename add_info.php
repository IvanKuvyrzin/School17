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

if (isset($data['intel']) && isset($data['details'])) {
    $intel = $conn->real_escape_string($data['intel']);
    $details = $conn->real_escape_string($data['details']);

    $sql = "INSERT INTO Detail (Intel, Details) VALUES ('$intel', '$details')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid input'));
}

$conn->close();
?>
