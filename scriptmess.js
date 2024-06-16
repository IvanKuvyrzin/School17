console.log('scriptmess.js is loaded');
document.addEventListener('DOMContentLoaded', function () {
    console.log('DOMContentLoaded event fired');
    const logoContainer = document.querySelector('.logo');
    
    if (logoContainer) {
        logoContainer.addEventListener('click', function() {
            window.location.href = 'https://shkola17arzamas.ucoz.ru/';
        });
    }

    // Логика для открытия mail.ru при нажатии на кнопку "Отправить"
    const sendButtons = document.querySelectorAll('.send-btn');

    sendButtons.forEach(button => {
        button.addEventListener('click', function () {
            const email = this.getAttribute('data-email');
            const mailUrl = `https://mail.ru/?to=${email}`;
            window.open(mailUrl, '_blank');
        });
    });

    // Логика для удаления сообщений
    const deleteModal = document.getElementById('deleteModal');
    const confirmDelete = document.getElementById('confirmDelete');
    const cancelDelete = document.getElementById('cancelDelete');
    let messageId;

    document.querySelectorAll('.delete-message-btn').forEach(button => {
        button.addEventListener('click', function () {
            messageId = this.getAttribute('data-id');
            deleteModal.style.display = 'block';
        });
    });

    cancelDelete.addEventListener('click', function () {
        deleteModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === deleteModal) {
            deleteModal.style.display = 'none';
        }
    });

    confirmDelete.addEventListener('click', function () {
        fetch('delete_message.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: messageId })
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
                alert('Ошибка удаления данных: ' + data.message);
            }
        })
        .catch(error => console.error('Ошибка:', error));
    });

    // Закрытие модального окна
    const closeModal = document.querySelector('.close-delete1');
    closeModal.addEventListener('click', function () {
        deleteModal.style.display = 'none';
    });
});
