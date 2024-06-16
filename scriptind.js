document.addEventListener('DOMContentLoaded', function () {
    console.log('DOMContentLoaded event fired');
    const logoContainer = document.querySelector('.logo');

    if (logoContainer) {
        logoContainer.addEventListener('click', function() {
            window.location.href = 'https://shkola17arzamas.ucoz.ru/';
        });
    }

    // Модальные окна для новостей
    const editNewsModal = document.getElementById('editNewsModal');
    const closeModalEditNews = document.querySelector('.close-edit');
    const closeModalAddNews = document.querySelector('.close-add');
    const deleteNewsModal = document.getElementById('deleteNewsModal');
    const confirmDeleteNews = document.getElementById('confirmDeleteNews');
    const cancelDeleteNews = document.getElementById('cancelDeleteNews');
    const editNewsForm = document.getElementById('editNewsForm');
    const addNewsForm = document.getElementById('addNewsForm');
    let newsId;

    // Открытие модального окна редактирования
    document.querySelectorAll('.edit-news-btn').forEach(button => {
        button.addEventListener('click', function () {
            newsId = this.getAttribute('data-id');
            const newsItem = this.parentElement;
            const img = newsItem.querySelector('img').src;
            const name = newsItem.querySelector('h3').textContent;
            const text = newsItem.querySelector('.text').textContent;
            const fText = newsItem.querySelector('.full-text').textContent;

            document.getElementById('editNewsId').value = newsId;
            document.getElementById('editNewsImg').value = img;
            document.getElementById('editNewsName').value = name;
            document.getElementById('editNewsText').value = text;
            document.getElementById('editNewsFText').value = fText;

            editNewsModal.style.display = 'block';
        });
    });

    // Закрытие модального окна редактирования
    closeModalEditNews.addEventListener('click', function () {
        editNewsModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === editNewsModal) {
            editNewsModal.style.display = 'none';
        }
    });

    // Обработка формы редактирования
    editNewsForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const id = document.getElementById('editNewsId').value;
        const img = document.getElementById('editNewsImg').value;
        const name = document.getElementById('editNewsName').value;
        const text = document.getElementById('editNewsText').value;
        const fText = document.getElementById('editNewsFText').value;

        fetch('update_news.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: id,
                img: img,
                name: name,
                text: text,
                fText: fText
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload(); // Перезагрузка страницы после успешного обновления
            } else {
                alert('Ошибка обновления данных');
            }
        })
        .catch(error => console.error('Ошибка:', error));
    });

    // Открытие модального окна удаления
    document.getElementById('deleteNews').addEventListener('click', function () {
        deleteNewsModal.style.display = 'block';
    });

    // Подтверждение удаления
    confirmDeleteNews.addEventListener('click', function () {
        fetch('delete_news.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: newsId })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload(); // Перезагрузка страницы после успешного удаления
            } else {
                alert('Ошибка удаления данных');
            }
        })
        .catch(error => console.error('Ошибка:', error));
    });

    // Отмена удаления
    cancelDeleteNews.addEventListener('click', function () {
        deleteNewsModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === deleteNewsModal) {
            deleteNewsModal.style.display = 'none';
        }
    });

    // Добавление новой новости
    const addNewsModal = document.getElementById('addNewsModal');
    const addNewsBtn = document.querySelector('.add-news-btn');

    addNewsBtn.addEventListener('click', function () {
        addNewsModal.style.display = 'block';
    });

    closeModalAddNews.addEventListener('click', function () {
        addNewsModal.style.display = 'none';
    });

    addNewsForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const img = document.getElementById('addNewsImg').value;
        const name = document.getElementById('addNewsName').value;
        const text = document.getElementById('addNewsText').value;
        const fText = document.getElementById('addNewsFText').value;

        fetch('add_news.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                img: img,
                name: name,
                text: text,
                fText: fText
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload(); // Перезагрузка страницы после успешного добавления
            } else {
                alert('Ошибка добавления данных');
            }
        })
        .catch(error => console.error('Ошибка:', error));
    });

    // Модальные окна для редактирования сведений
    const editInfoModal = document.getElementById('editInfoModal');
    const closeModalEditInfo = document.querySelector('.close-edit-info');
    const deleteInfoModal = document.getElementById('deleteInfoModal');
    const confirmDeleteInfo = document.getElementById('confirmDeleteInfo');
    const cancelDeleteInfo = document.getElementById('cancelDeleteInfo');
    const editInfoForm = document.getElementById('editInfoForm');
    let infoId;

    // Открытие модального окна редактирования
    document.querySelectorAll('.btn-edit-info').forEach(button => {
        button.addEventListener('click', function () {
            infoId = this.getAttribute('data-id');
            const row = this.closest('tr');
            const intel = row.children[0].textContent;
            const details = row.children[1].textContent;

            document.getElementById('editInfoId').value = infoId;
            document.getElementById('editInfoIntel').value = intel;
            document.getElementById('editInfoDetails').value = details;

            editInfoModal.style.display = 'block';
        });
    });

    // Закрытие модального окна редактирования
    closeModalEditInfo.addEventListener('click', function () {
        editInfoModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === editInfoModal) {
            editInfoModal.style.display = 'none';
        }
    });

    // Обработка формы редактирования
    editInfoForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const id = document.getElementById('editInfoId').value;
        const intel = document.getElementById('editInfoIntel').value;
        const details = document.getElementById('editInfoDetails').value;

        fetch('update_info.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: id,
                intel: intel,
                details: details
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload(); // Перезагрузка страницы после успешного обновления
            } else {
                alert('Ошибка обновления данных');
            }
        })
        .catch(error => console.error('Ошибка:', error));
    });

    // Открытие модального окна удаления
    document.getElementById('deleteInfo').addEventListener('click', function () {
        deleteInfoModal.style.display = 'block';
    });

    // Подтверждение удаления
    confirmDeleteInfo.addEventListener('click', function () {
        fetch('delete_info.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: infoId })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload(); // Перезагрузка страницы после успешного удаления
            } else {
                alert('Ошибка удаления данных');
            }
        })
        .catch(error => console.error('Ошибка:', error));
    });

    // Отмена удаления
    cancelDeleteInfo.addEventListener('click', function () {
        deleteInfoModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === deleteInfoModal) {
            deleteInfoModal.style.display = 'none';
        }
    });

    // Добавление новых сведений
    const addInfoModal = document.getElementById('addInfoModal');
    const addInfoBtn = document.querySelector('.btn-add-info');

    addInfoBtn.addEventListener('click', function () {
        addInfoModal.style.display = 'block';
    });

    document.querySelector('.close-add-info').addEventListener('click', function () {
        addInfoModal.style.display = 'none';
    });

    document.getElementById('addInfoForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const intel = document.getElementById('addInfoIntel').value;
        const details = document.getElementById('addInfoDetails').value;

        fetch('add_info.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                intel: intel,
                details: details
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload(); // Перезагрузка страницы после успешного добавления
            } else {
                alert('Ошибка добавления данных');
            }
        })
        .catch(error => console.error('Ошибка:', error));
    });
});
