document.addEventListener('DOMContentLoaded', function() {
    const addBtn = document.querySelector('.btn-add-doc');
    const editBtns = document.querySelectorAll('.custom-edit-doc-btn');
    const customAddModal = document.getElementById('customAddModal');
    const customEditModal = document.getElementById('customEditModal');
    const customDeleteModal = document.getElementById('customDeleteModal');
    const addForm = document.getElementById('addForm');
    const editForm = document.getElementById('editForm');
    const closeBtns = document.querySelectorAll('.custom-close');
    const confirmDeleteBtn = document.getElementById('confirmDelete');
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    let deleteDocId = '';

    addBtn.addEventListener('click', function() {
        customAddModal.style.display = 'block';
    });

    editBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const row = btn.closest('tr');
            document.getElementById('editDocId').value = btn.dataset.id;
            document.getElementById('editNamer').value = row.children[0].innerText;
            document.getElementById('editName').value = row.children[1].innerText;
            document.getElementById('editUrll').value = row.children[2].children[0].href;
            customEditModal.style.display = 'block';
        });
    });

    closeBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            customAddModal.style.display = 'none';
            customEditModal.style.display = 'none';
            customDeleteModal.style.display = 'none';
        });
    });

    window.addEventListener('click', function(event) {
        if (event.target == customAddModal) {
            customAddModal.style.display = 'none';
        }
        if (event.target == customEditModal) {
            customEditModal.style.display = 'none';
        }
        if (event.target == customDeleteModal) {
            customDeleteModal.style.display = 'none';
        }
    });

    addForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const data = {
            namer: document.getElementById('addNamer').value,
            name: document.getElementById('addName').value,
            urll: document.getElementById('addUrll').value
        };

        fetch('add_document.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Ошибка добавления документа');
            }
        })
        .catch(error => console.error('Ошибка:', error));
    }, { once: true });

    editForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const data = {
            id: document.getElementById('editDocId').value,
            namer: document.getElementById('editNamer').value,
            name: document.getElementById('editName').value,
            urll: document.getElementById('editUrll').value
        };

        fetch('update_document.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Ошибка обновления документа');
            }
        })
        .catch(error => console.error('Ошибка:', error));
    }, { once: true });

    document.getElementById('deleteDoc').addEventListener('click', function() {
        deleteDocId = document.getElementById('editDocId').value;
        customEditModal.style.display = 'none';
        customDeleteModal.style.display = 'block';
    });

    confirmDeleteBtn.addEventListener('click', function() {
        fetch('delete_document.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: deleteDocId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Ошибка удаления документа');
            }
        })
        .catch(error => console.error('Ошибка:', error));
    });

    cancelDeleteBtn.addEventListener('click', function() {
        customDeleteModal.style.display = 'none';
    });
});
