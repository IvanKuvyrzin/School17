<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school17";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Запрос данных из таблицы info
$sql = "SELECT Namer, Name, Urll FROM info";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>МБОУ СШ №17 им. И.П.Склярова - Документы</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>
<body>
<header>
    <div class="container">
        <div class="logo">
            <img src="https://sun9-32.userapi.com/impg/hwbUNAYk3nMhXQqOXpDFZqHH80ysT_a_zkq8rg/ZyV808ntuOY.jpg?size=511x510&quality=95&sign=b3f37cfe15be444e2835125ae62542cc&type=album" alt="Школьное здание">
            <a href="/">МБОУ СШ №17 им. И.П.Склярова</a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="team.php">Коллектив</a></li>
                <li><a href="documents.php">Сведения об образовательной организации</a></li>
                <li><a href="contacts.html">Контакты</a></li>
                <li><a href="feedback.html">Обратная связь</a></li>
            </ul>
        </nav>
        <a href="login.php" class="login-btn">Войти</a>
    </div>
</header>

<section class="hero">
    <div class="container">
        <h1>Документы</h1>
        <p>Нажмите на кнопки ниже для перехода к подробной информации о документах.</p>
    </div>
</section>

<section class="documents">
    <div class="container">
        <h2>Подробности о документах</h2>
        
        <?php
        // Проверка, есть ли результаты
        if ($result->num_rows > 0) {
            // Переменная для отслеживания разделов
            $currentSection = null;

            // Вывод данных для каждого ряда
            while($row = $result->fetch_assoc()) {
                if ($row["Namer"] && $currentSection != $row["Namer"]) {
                    if ($currentSection != null) {
                        echo '</div></div>'; // Закрытие предыдущего раздела
                    }
                    $currentSection = $row["Namer"];
                    echo '<div class="document-section">';
                    echo '<h3>' . $currentSection . '</h3>';
                    echo '<div class="button-container">';
                }
                echo '<a href="' . $row["Urll"] . '" class="document-btn">' . $row["Name"] . '</a>';
            }
            echo '</div></div>'; // Закрытие последнего раздела
        } else {
            echo "0 results";
        }
        // Закрытие соединения
        $conn->close();
        ?>

    </div>
</section>

<footer>
    <div class="container">
        <p>Официальный сайт муниципального бюджетного общеобразовательного учреждения "Средняя школа № 17 им. И. П. Склярова"</p>
    </div>
</footer>
</body>
</html>
