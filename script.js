console.log('script.js is loaded');
document.addEventListener('DOMContentLoaded', function () {
    console.log('DOMContentLoaded event fired');
    const logoContainer = document.querySelector('.logo');
    
    logoContainer.addEventListener('click', function() {
        window.location.href = 'https://shkola17arzamas.ucoz.ru/';
    });
    
    // Модальные окна для новостей
    const newsItems = document.querySelectorAll('.news-item');
    const modals = document.querySelectorAll('.modal');
    const closeBtns = document.querySelectorAll('.modal .close');

    newsItems.forEach((item) => {
        item.addEventListener('click', function () {
            const modalId = this.getAttribute('data-modal');
            openModal(modalId);
        });
    });

    closeBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            this.closest('.modal').style.display = 'none';
        });
    });

    window.addEventListener('click', function (event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    });

    function openModal(modalId) {
        modals.forEach(modal => {
            modal.style.display = 'none';
        });
        document.getElementById(modalId).style.display = 'block';
    }

    // Модальное окно для редактирования сотрудников
    const editModal = document.getElementById('editModal');
    const closeModal = document.querySelector('#editModal .close');
    const editForm = document.getElementById('editForm');
    
    // Открытие модального окна
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            console.log('Edit button clicked');
            const id = this.getAttribute('data-id');
            const img = this.previousElementSibling.previousElementSibling.previousElementSibling.src;
            const name = this.previousElementSibling.previousElementSibling.textContent;
            const text = this.previousElementSibling.textContent;

            console.log('ID:', id, 'Img:', img, 'Name:', name, 'Text:', text);
            
            document.getElementById('editId').value = id;
            document.getElementById('editImg').value = img;
            document.getElementById('editName').value = name;
            document.getElementById('editText').value = text;

            editModal.style.display = 'block';
        });
    });

    // Закрытие модального окна
    closeModal.addEventListener('click', function () {
        editModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === editModal) {
            editModal.style.display = 'none';
        }
    });

    // Обработка формы
    editForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const id = document.getElementById('editId').value;
        const img = document.getElementById('editImg').value;
        const name = document.getElementById('editName').value;
        const text = document.getElementById('editText').value;

        fetch('update_staff.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: id,
                img: img,
                name: name,
                text: text
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Перезагрузка страницы после успешного обновления
            } else {
                alert('Ошибка обновления данных');
            }
        })
        .catch(error => console.error('Ошибка:', error));
    });
});
