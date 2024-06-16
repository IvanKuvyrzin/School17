<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>МБОУ СШ №17 им. И.П.Склярова - Коллектив</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script1.js" defer></script>
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

<section class="staff">
    <div class="container">
        <h2>Редактирование рабочего коллектива</h2>
        <button class="btn add-employee-btn">Добавить сотрудника</button>
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

            $sql = "SELECT ID, Img, Name, Text FROM Teams";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="staff-item">';
                    echo '<img src="' . $row["Img"] . '" alt="Сотрудник">';
                    echo '<h3>' . $row["Name"] . '</h3>';
                    echo '<p>' . $row["Text"] . '</p>';
                    echo '<button class="edit-btn" data-id="' . $row["ID"] . '">Редактировать</button>';
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

<!-- Модальное окно для редактирования -->
<div id="editModal" class="modal-edit">
    <div class="modal-content-edit">
        <span class="close-edit">&times;</span>
        <h2>Редактировать сотрудника</h2>
        <form id="editForm">
            <input type="hidden" id="editId">
            <label for="editImg">Изображение (URL):</label>
            <input type="text" id="editImg" required>
            <label for="editName">Имя:</label>
            <input type="text" id="editName" required>
            <label for="editText">Описание:</label>
            <textarea id="editText" required></textarea>
            <div class="modal-buttons">
                <button type="submit" class="btn">Сохранить изменения</button>
                <button type="button" id="deleteEmployee" class="btn delete-btn">Удалить работника</button>
            </div>
        </form>
    </div>
</div>

<!-- Модальное окно для подтверждения удаления -->
<div id="deleteModal" class="modal-delete">
    <div class="modal-content-delete">
        <span class="close-delete">&times;</span>
        <h2>Вы уверены, что хотите удалить данные?</h2>
        <button id="confirmDelete" class="btn">Да</button>
        <button id="cancelDelete" class="btn">Нет</button>
    </div>
</div>

<!-- Модальное окно для добавления нового сотрудника -->
<div id="addModal" class="modal-add">
    <div class="modal-content-add">
        <span class="close-add">&times;</span>
        <h2>Добавить нового сотрудника</h2>
        <form id="addForm">
            <label for="addImg">Изображение (URL):</label>
            <input type="text" id="addImg" required>
            <label for="addName">Имя:</label>
            <input type="text" id="addName" required>
            <label for="addText">Описание:</label>
            <textarea id="addText" required></textarea>
            <button type="submit" class="btn">Добавить сотрудника</button>
        </form>
    </div>
</div>

<footer>
    <div class="container">
        <p>Официальный сайт муниципального бюджетного общеобразовательного учреждения "Средняя школа № 17 им. И. П. Склярова"</p>
    </div>
</footer>
</body>
</html>
