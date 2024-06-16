<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>МБОУ СШ №17 им. И.П.Склярова - Обратная связь</title>
    <link rel="stylesheet" href="styles.css">
    <script src="scriptmess.js" defer></script>
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
                <li><a href="indexadm.php">Главная</a></li>
                <li><a href="teamadm.php">Коллектив</a></li>
                <li><a href="documentsadm.php">Сведения об образовательной организации</a></li>
                <li><a href="feedbackadm.php">Обратная связь</a></li>
            </ul>
        </nav>
        <a href="login.php" class="login-btn">Выйти</a>
    </div>
</header>

<section class="feedback1">
    <div class="container">
        <h2>Сообщения обратной связи</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Сообщение</th>
                        <th class="action-column">Ответить</th>
                        <th class="action-column">Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "school17";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT ID, Name, Email, Text FROM fback";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row["Name"] . '</td>';
                            echo '<td>' . $row["Email"] . '</td>';
                            echo '<td>' . $row["Text"] . '</td>';
                            echo '<td><button class="btn send-btn" data-email="' . $row["Email"] . '">Ответить</button></td>';
                            echo '<td><button class="btn delete-message-btn" data-id="' . $row["ID"] . '">Удалить</button></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='5'>Нет данных о сообщениях.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<div id="deleteModal" class="modal-delete1">
    <div class="modal-content-delete1">
        <span class="close-delete1">&times;</span>
        <h2>Вы уверены, что хотите удалить это сообщение?</h2>
        <div>
            <button id="confirmDelete" class="btn btn-confirm">Да</button>
            <button id="cancelDelete" class="btn btn-cancel">Нет</button>
        </div>
    </div>
</div>


<footer>
    <div class="container">
        <p>Официальный сайт муниципального бюджетного общеобразовательного учреждения "Средняя школа № 17 им. И. П. Склярова"</p>
    </div>
</footer>

</body>
</html>
