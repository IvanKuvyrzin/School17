<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>МБОУ СШ №17 им. И.П.Склярова - Документы</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="new_styles2.css">
    <script src="scriptdoc.js" defer></script>
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
        <a href="index.php" class="login-btn">Выйти</a>
    </div>
</header>

<section class="doc-info">
    <h2>Редактирование документов</h2>
    <div class="container custom-table-container">
        <div class="center-button">
            <button class="btn-add-doc">Добавить документ</button>
        </div>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Раздел</th>
                    <th>Название ссылки</th>
                    <th>Ссылка</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
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
                $sql = "SELECT id, Namer, Name, Urll FROM info";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Namer"] . "</td>";
                        echo "<td>" . $row["Name"] . "</td>";
                        echo "<td><a href='" . $row["Urll"] . "' target='_blank'>" . $row["Urll"] . "</a></td>";
                        echo "<td><button class='custom-edit-doc-btn' data-id='" . $row["id"] . "'>Редактировать</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Нет данных</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</section>

<!-- Модальные окна -->
<div id="customEditModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="custom-close">&times;</span>
        <h2>Редактировать документ</h2>
        <form id="editForm">
            <input type="hidden" id="editDocId">
            <label for="editNamer">Раздел:</label>
            <input type="text" id="editNamer">
            <label for="editName">Название ссылки:</label>
            <input type="text" id="editName">
            <label for="editUrll">Ссылка:</label>
            <input type="text" id="editUrll">
            <div class="modal-buttons">
                <button type="submit" class="save-doc-btn">Сохранить изменения</button>
                <button type="button" class="delete-doc-btn" id="deleteDoc">Удалить документ</button>
            </div>
        </form>
    </div>
</div>

<div id="customAddModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="custom-close">&times;</span>
        <h2>Добавить документ</h2>
        <form id="addForm">
            <label for="addNamer">Раздел:</label>
            <input type="text" id="addNamer">
            <label for="addName">Название ссылки:</label>
            <input type="text" id="addName">
            <label for="addUrll">Ссылка:</label>
            <input type="text" id="addUrll">
            <button type="submit" class="custom-add-doc-btn">Добавить документ</button>
        </form>
    </div>
</div>

<div id="customDeleteModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="custom-close">&times;</span>
        <h2>Вы уверены, что хотите удалить этот документ?</h2>
        <div class="delete-button-container">
            <button id="confirmDelete" class="btn-confirm">Да</button>
            <button id="cancelDelete" class="btn-cancel">Нет</button>
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
