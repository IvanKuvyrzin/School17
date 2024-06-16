<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>МБОУ СШ №17 им. И.П.Склярова - Коллектив</title>
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
        <h1>Наш коллектив</h1>
        <p>Здесь вы найдете информацию о нашем рабочем коллективе.</p>
    </div>
</section>


<section class="staff">
    <div class="container">
        <h2>Рабочий коллектив</h2>
        <div class="staff-container">
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

            $sql = "SELECT Img, Name, Text FROM Teams";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="staff-item">';
                    echo '<img src="' . $row["Img"] . '" alt="Сотрудник">';
                    echo '<h3>' . $row["Name"] . '</h3>';
                    echo '<p>' . $row["Text"] . '</p>';
                    echo '</div>';
                }
            } else {
                echo "Нет данных о сотрудниках.";
            }

            $conn->close();
            ?>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <p>Официальный сайт муниципального бюджетного общеобразовательного учреждения "Средняя школа № 17 им. И. П. Склярова"</p>
    </div>
</footer>
</body>
</html>
