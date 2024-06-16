<?php 
include "connect.php";

$query = "SELECT img, name, text FROM news";
$result = $connect->query($query);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>МБОУ СШ №17 им. И.П.Склярова - Главная страница</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>
<body>
<header>
    <div class="container">
        <div class="logo">
            <img src="https://sun9-32.userapi.com/impg/hwbUNAYk3nMhXQqOXpDFZqHH80ysT_a_zkq8rg/ZyV808ntuOY.jpg?size=511x510&quality=95&sign=b3f37cfe15be444e2835125ae62542cc&type=album" alt="Школьное здание">
            <a>МБОУ СШ №17 им. И.П.Склярова</a>
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
        <h1>Добро пожаловать на наш сайт!</h1>
        <p>Здесь вы найдете всю необходимую информацию о нашей школе.</p>
        <a href="#info" class="btn">Узнать больше</a>
    </div>
</section>

<section class="about">
    <div class="container about-content">
        <h2>О нашей школе</h2>
        <p>На нашем сайте Вы познакомитесь с основными нормативными документами и направлениями работы школы, интересными событиями из нашей жизни, с педагогами и многим другим.</p>
    </div>
</section>
  
<section class="news">
    <div class="container">
        <h2>Новости</h2>
      
        <div class="news-slider">
            <?php
            include "connect.php";

            $query = "SELECT id, img, name, text, FText FROM news";
            $result = $connect->query($query);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="news-item" data-modal="modal' . $row["id"] . '">';
                    echo '<img src="' . $row["img"] . '" alt="Новость ' . $row["id"] . '">';
                    echo '<h3>' . $row["name"] . '</h3>';
                    echo '<p>' . $row["text"] . '</p>';
                    echo '</div>';

                    // Модальные окна
                    echo '<div id="modal' . $row["id"] . '" class="modal">';
                    echo '<div class="modal-content">';
                    echo '<span class="close">&times;</span>';
                    echo '<img src="' . $row["img"] . '" alt="Новость ' . $row["id"] . '">';
                    echo '<h2>' . $row["name"] . '</h2>';
                    echo '<p>' . $row["FText"] . '</p>';
                    echo '</div></div>';
                }
            } else {
                echo "Нет новостей.";
            }
            $connect->close();
            ?>
        </div>
    </div>
</section>

<section class="info" id="info">
    <div class="container">
        <table>
            <tr>
                <th>Сведения</th>
                <th>Детали</th>
            </tr>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "school17";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT Intel, Details FROM Detail";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Intel"] . "</td><td>" . $row["Details"] . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Нет данных</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
</section>

    <footer>
        <div class="container">
            <p>Официальный сайт муниципального бюджетного общеобразовательного учреждения "Средняя школа № 17 им. И. П. Склярова"</p>
        </div>
    </footer>
</body>
</html>
