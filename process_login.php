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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    
    $sql = "SELECT * FROM login WHERE Log = '$username' AND Pass = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Правильные данные, перенаправляем на главную страницу
        header("Location: indexadm.php");
        exit();
    } else {
        // Неправильные данные, отображаем сообщение об ошибке
        header("Location: login.php");
        exit();
    }
}

$conn->close();
?>
