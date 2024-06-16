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
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $text = $conn->real_escape_string($_POST['message']);
    
    $sql = "INSERT INTO fback (Name, Email, Text) VALUES ('$name', '$email', '$text')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Сообщение успешно отправлено, мы напишем вам на почту как можно скорее!'); window.location.href = 'feedback.html';</script>";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
