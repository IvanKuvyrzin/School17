<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>МБОУ СШ №17 им. И.П.Склярова - Главная страница</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="new_styles.css">
    <script src="scriptind.js" defer></script>
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
                <li><a href="indexadm.php">Главная</a></li>
                <li><a href="teamadm.php">Коллектив</a></li>
                <li><a href="documentsadm.php">Сведения об образовательной организации</a></li>
                <li><a href="feedbackadm.php">Обратная связь</a></li>
            </ul>
        </nav>
        <a href="login.php" class="login-btn">Выйти</a>
    </div>
</header>

<section class="news">
    <div class="container">
        <h2>Редактирование информации</h2>
        <div class="center-button">
            <button class="btn add-news-btn">Добавить новость</button>
        </div>
        <div class="news-slider">
            <?php
            include "connect.php";

            $query = "SELECT id, img, name, text, FText FROM news";
            $result = $connect->query($query);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="news-item1" data-id="' . $row["id"] . '">';
                    echo '<img src="' . $row["img"] . '" alt="Новость ' . $row["id"] . '">';
                    echo '<h3>' . $row["name"] . '</h3>';
                    echo '<p class="text">' . $row["text"] . '</p>';
                    echo '<p class="full-text" style="display:none;">' . $row["FText"] . '</p>';
                    echo '<button class="btn edit-news-btn" data-id="' . $row["id"] . '">Редактировать</button>';
                    echo '</div>';
                }
            } else {
                echo "Нет новостей.";
            }
            $connect->close();
            ?>
        </div>
    </div>
</section>

<!-- Модальное окно для редактирования -->
<div id="editNewsModal" class="modal-edit">
    <div class="modal-content-edit">
        <span class="close-edit">&times;</span>
        <h2>Редактировать новость</h2>
        <form id="editNewsForm">
            <input type="hidden" id="editNewsId">
            <label for="editNewsImg">Изображение (URL):</label>
            <input type="text" id="editNewsImg" required>
            <label for="editNewsName">Заголовок:</label>
            <input type="text" id="editNewsName" required>
            <label for="editNewsText">Текст:</label>
            <textarea id="editNewsText" required></textarea>
            <label for="editNewsFText">Полный текст:</label>
            <textarea id="editNewsFText" required></textarea>
            <div class="modal-buttons">
                <button type="submit" class="btn">Сохранить изменения</button>
                <button type="button" id="deleteNews" class="btn delete-btn">Удалить новость</button>
            </div>
        </form>
    </div>
</div>

<!-- Модальное окно для подтверждения удаления -->
<div id="deleteNewsModal" class="modal-delete">
    <div class="modal-content-delete">
        <span class="close-delete">&times;</span>
        <h2>Вы уверены, что хотите удалить эту новость?</h2>
        <button id="confirmDeleteNews" class="btn">Да</button>
        <button id="cancelDeleteNews" class="btn">Нет</button>
    </div>
</div>

<!-- Модальное окно для добавления новой новости -->
<div id="addNewsModal" class="modal-add">
    <div class="modal-content-add">
        <span class="close-add">&times;</span>
        <h2>Добавить новую новость</h2>
        <form id="addNewsForm">
            <label for="addNewsImg">Изображение (URL):</label>
            <input type="text" id="addNewsImg" required>
            <label for="addNewsName">Заголовок:</label>
            <input type="text" id="addNewsName" required>
            <label for="addNewsText">Текст:</label>
            <textarea id="addNewsText" required></textarea>
            <label for="addNewsFText">Полный текст:</label>
            <textarea id="addNewsFText" required></textarea>
            <button type="submit" class="btn">Добавить новость</button>
        </form>
    </div>
</div>

<section class="info" id="info">
    <div class="container">
        <div class="center-button">
            <button class="btn btn-add-info">Добавить сведения</button>
        </div>
        <table>
            <tr>
                <th>Сведения</th>
                <th>Детали</th>
                <th>Действия</th>
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
                    echo "<tr><td>" . $row["Intel"] . "</td><td>" . $row["Details"] . "</td><td><button class='btn btn-edit-info' data-id='" . $row["Intel"] . "'>Редактировать</button></td></tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Нет данных</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
</section>

<!-- Модальное окно для редактирования сведений -->
<div id="editInfoModal" class="modal-edit-info">
    <div class="modal-content-edit-info">
        <span class="close-edit-info">&times;</span>
        <h2>Редактировать сведения</h2>
        <form id="editInfoForm">
            <input type="hidden" id="editInfoId">
            <label for="editInfoIntel">Сведения:</label>
            <input type="text" id="editInfoIntel" required>
            <label for="editInfoDetails">Детали:</label>
            <textarea id="editInfoDetails" required></textarea>
            <div class="modal-buttons">
                <button type="submit" class="btn save-info-btn">Сохранить изменения</button>
                <button type="button" id="deleteInfo" class="btn delete-info-btn">Удалить строку</button>
            </div>
        </form>
    </div>
</div>

<!-- Модальное окно для подтверждения удаления -->
<div id="deleteInfoModal" class="modal-delete-info">
    <div class="modal-content-delete-info">
        <span class="close-delete-info">&times;</span>
        <h2>Вы уверены, что хотите удалить данную строку?</h2>
        <div class="delete-button-container">
            <button id="confirmDeleteInfo" class="btn btn-confirm">Да</button>
            <button id="cancelDeleteInfo" class="btn btn-cancel">Нет</button>
        </div>
    </div>
</div>

<!-- Модальное окно для добавления сведений -->
<!-- Модальное окно для добавления сведений -->
<div id="addInfoModal" class="custom-modal-add">
    <div class="custom-modal-content-add">
        <span class="custom-close-add">&times;</span>
        <h2>Добавить сведения</h2>
        <form id="addInfoForm">
            <label for="addInfoIntel">Сведения:</label>
            <input type="text" id="addInfoIntel" class="custom-input" required>
            <label for="addInfoDetails">Детали:</label>
            <textarea id="addInfoDetails" class="custom-textarea" required></textarea>
            <button type="submit" class="custom-btn">Добавить сведения</button>
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
