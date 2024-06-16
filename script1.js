document.addEventListener('DOMContentLoaded', function () {
    const logoContainer = document.querySelector('.logo');
    
    logoContainer.addEventListener('click', function() {
        window.location.href = 'https://shkola17arzamas.ucoz.ru/';
    });
    
    // Модальные окна
    const newsItems = document.querySelectorAll('.news-item');
    const modals = document.querySelectorAll('.modal');
    const closeBtns = document.querySelectorAll('.modal .close');

    newsItems.forEach((item, idx) => {
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
});

document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('editModal');
    const closeModalEdit = document.querySelector('.close-edit');
    const closeModalAdd = document.querySelector('.close-add');
    const editForm = document.getElementById('editForm');
    const deleteModal = document.getElementById('deleteModal');
    const confirmDelete = document.getElementById('confirmDelete');
    const cancelDelete = document.getElementById('cancelDelete');
    
    let employeeId;

    // Открытие модального окна редактирования
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            employeeId = this.getAttribute('data-id');
            const img = this.previousElementSibling.previousElementSibling.previousElementSibling.src;
            const name = this.previousElementSibling.previousElementSibling.textContent;
            const text = this.previousElementSibling.textContent;
            
            document.getElementById('editId').value = employeeId;
            document.getElementById('editImg').value = img;
            document.getElementById('editName').value = name;
            document.getElementById('editText').value = text;

            editModal.style.display = 'block';
        });
    });

    // Закрытие модального окна редактирования
    closeModalEdit.addEventListener('click', function () {
        editModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === editModal) {
            editModal.style.display = 'none';
        }
    });

    // Обработка формы редактирования
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

    // Открытие модального окна удаления
    document.getElementById('deleteEmployee').addEventListener('click', function () {
        deleteModal.style.display = 'block';
    });

    // Подтверждение удаления
    confirmDelete.addEventListener('click', function () {
        fetch('delete_staff.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: employeeId })
        })
        .then(response => response.json())
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
    cancelDelete.addEventListener('click', function () {
        deleteModal.style.display = 'none';
    });

    // Добавление нового сотрудника
    const addModal = document.getElementById('addModal');
    const addForm = document.getElementById('addForm');
    const addEmployeeBtn = document.querySelector('.add-employee-btn');
    
    addEmployeeBtn.addEventListener('click', function () {
        addModal.style.display = 'block';
    });

    closeModalAdd.addEventListener('click', function () {
        addModal.style.display = 'none';
    });

    addForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const img = document.getElementById('addImg').value;
        const name = document.getElementById('addName').value;
        const text = document.getElementById('addText').value;

        fetch('add_employee.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                img: img,
                name: name,
                text: text
            })
        })
        .then(response => response.json())
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
