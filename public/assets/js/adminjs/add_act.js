let lastSortedColumn = '';
let sortDirection = {};

function toggleButtons() {
    const checkboxes = document.querySelectorAll('.act-checkbox:checked');
    const editBtn = document.getElementById('editBtn');

    if (checkboxes.length === 1) {
        editBtn.classList.remove('btn-disabled');
        editBtn.disabled = false;
    } else {
        editBtn.classList.add('btn-disabled');
        editBtn.disabled = true;
    }
}

function openAddPopup() {
    const popup = document.getElementById('addPopup');
    const overlay = document.getElementById('popupOverlay');
    popup.style.display = 'block';
    overlay.style.display = 'block';
    setTimeout(() => {
        popup.classList.add('active');
        overlay.classList.add('active');
    }, 10);
    updateCharCount('description', 'addCharCount');
}

function openEditPopup() {
    const selectedCheckbox = document.querySelector('.act-checkbox:checked');
    if (!selectedCheckbox) return;

    const actId = selectedCheckbox.dataset.id;
    fetch(`/admin/edit_act/${actId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch act data');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('editTitre').value = data.titre || '';
            document.getElementById('editDescription').value = data.description || '';
            document.getElementById('editType').value = data.type || '';
            document.getElementById('editIsActive').value = data.is_active ? '1' : '0';
            document.getElementById('editDateAjout').value = data.date_ajout || '';
            document.getElementById('editForm').action = `/admin/update_act/${actId}`;
            const popup = document.getElementById('editPopup');
            const overlay = document.getElementById('popupOverlay');
            popup.style.display = 'block';
            overlay.style.display = 'block';
            setTimeout(() => {
                popup.classList.add('active');
                overlay.classList.add('active');
            }, 10);
            updateCharCount('editDescription', 'editCharCount');
        })
        .catch(error => {
            console.error('Error fetching act data:', error);
            alert('Une erreur s\'est produite lors du chargement des données de l\'actualité.');
        });
}

function closePopups() {
    const popups = document.querySelectorAll('.popup');
    const overlay = document.getElementById('popupOverlay');
    popups.forEach(popup => {
        popup.classList.remove('active');
        setTimeout(() => {
            popup.style.display = 'none';
        }, 300);
    });
    overlay.classList.remove('active');
    setTimeout(() => {
        overlay.style.display = 'none';
    }, 300);
}

function openImagePopup(imageSrc) {
    console.log('Image Source:', imageSrc);
    const popup = document.getElementById('imagePopup');
    const popupImage = document.getElementById('popupImage');
    const overlay = document.getElementById('popupOverlay');

    if (!imageSrc || imageSrc === '') {
        alert('Aucune image disponible.');
        return;
    }

    popupImage.src = imageSrc;
    popup.style.display = 'block';
    overlay.style.display = 'block';
    setTimeout(() => {
        popup.classList.add('active');
        overlay.classList.add('active');
    }, 10);

    popupImage.onerror = () => {
        alert('Erreur lors du chargement de l\'image.');
        closePopups();
    };
}

function updateCharCount(textareaId, counterId) {
    const textarea = document.getElementById(textareaId);
    const counter = document.getElementById(counterId);
    counter.textContent = `${textarea.value.length}/10000`;
}

function toggleStatus(actId, currentStatus) {
    const newStatus = currentStatus ? 0 : 1;
    fetch(`/admin/toggle_act_status/${actId}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({ is_active: newStatus })
    })
        .then(response => {
            if (!response.ok) {
                if (response.status === 419) {
                    throw new Error('CSRF token mismatch. Please refresh the page and try again.');
                }
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const button = document.querySelector(`button[onclick="toggleStatus(${actId}, ${currentStatus})"]`);
                if (button) {
                    button.textContent = data.is_active ? 'Active' : 'Inactive';
                    button.classList.remove(currentStatus ? 'active' : 'inactive');
                    button.classList.add(data.is_active ? 'active' : 'inactive');
                    button.setAttribute('onclick', `toggleStatus(${actId}, ${data.is_active})`);
                } else {
                    console.error('Button not found for actId:', actId);
                    alert('Statut mis à jour, mais l\'interface n\'a pas pu être actualisée.');
                }
            } else {
                throw new Error(data.error || 'Failed to toggle status');
            }
        })
        .catch(error => {
            console.error('Error toggling status:', error.message);
            alert(`Une erreur s\'est produite lors de la mise à jour du statut : ${error.message}`);
        });
}

function sortTable(column) {
    const tbody = document.getElementById('actTableBody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    if (lastSortedColumn === column) {
        sortDirection[column] = sortDirection[column] === 'asc' ? 'desc' : 'asc';
    } else {
        sortDirection = { [column]: 'asc' };
    }
    lastSortedColumn = column;

    document.querySelectorAll('th span[id^="sort-"]').forEach(span => {
        span.className = '';
        span.textContent = '';
    });
    document.querySelectorAll('th .header-text').forEach(span => {
        span.classList.remove('active-titre', 'active-type', 'active-date', 'active-status');
    });

    const sortIndicator = document.getElementById(`sort-${column}`);
    sortIndicator.className = sortDirection[column] === 'asc' ? 'sort-asc' : 'sort-desc';
    const activeHeaderText = document.querySelector(`th[onclick*="sortTable('${column}')"] .header-text`);
    if (activeHeaderText) {
        activeHeaderText.classList.add(`active-${column}`);
    }

    rows.sort((a, b) => {
        let aValue, bValue;

        if (column === 'titre') {
            aValue = a.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
            bValue = b.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
        } else if (column === 'type') {
            aValue = a.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
            bValue = b.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
        } else if (column === 'status') {
            aValue = a.querySelector('td:nth-child(6)').textContent.trim().toLowerCase();
            bValue = b.querySelector('td:nth-child(6)').textContent.trim().toLowerCase();
        } else if (column === 'date') {
            aValue = a.querySelector('td:nth-child(7)').textContent.trim();
            bValue = b.querySelector('td:nth-child(7)').textContent.trim();
            if (aValue === '-' || !aValue) aValue = null;
            if (bValue === '-' || !bValue) bValue = null;
            if (aValue && bValue) {
                const [aDay, aMonth, aYear] = aValue.split('/').map(Number);
                const [bDay, bMonth, bYear] = bValue.split('/').map(Number);
                aValue = new Date(aYear, aMonth - 1, aDay);
                bValue = new Date(bYear, bMonth - 1, bDay);
            }
        }

        if (column === 'date') {
            if (!aValue && !bValue) return 0;
            if (!aValue) return sortDirection[column] === 'asc' ? 1 : -1;
            if (!bValue) return sortDirection[column] === 'asc' ? -1 : 1;
            return sortDirection[column] === 'asc' ? aValue - bValue : bValue - aValue;
        }
        if (aValue < bValue) return sortDirection[column] === 'asc' ? -1 : 1;
        if (aValue > bValue) return sortDirection[column] === 'asc' ? 1 : -1;
        return 0;
    });

    tbody.innerHTML = '';
    rows.forEach(row => tbody.appendChild(row));
}

function filterTable() {
    const tbody = document.getElementById('actTableBody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const filterTitre = document.getElementById('filterTitre').value.trim().toLowerCase();
    const filterDescription = document.getElementById('filterDescription').value.trim().toLowerCase();
    const filterType = document.getElementById('filterType').value.trim().toLowerCase();
    const filterImage = document.getElementById('filterImage').value.trim().toLowerCase();
    const filterStatus = document.getElementById('filterStatus').value.trim().toLowerCase();
    const filterDate = document.getElementById('filterDate').value.trim().toLowerCase();

    rows.forEach(row => {
        const titre = row.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
        const description = row.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
        const type = row.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
        const image = row.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();
        const status = row.querySelector('td:nth-child(6)').textContent.trim().toLowerCase();
        const date = row.querySelector('td:nth-child(7)').textContent.trim().toLowerCase();

        let showRow = true;

        if (filterTitre && !titre.includes(filterTitre)) {
            showRow = false;
        }
        if (filterDescription && !description.includes(filterDescription)) {
            showRow = false;
        }
        if (filterType && type !== filterType) {
            showRow = false;
        }
        if (filterImage && !image.includes(filterImage)) {
            showRow = false;
        }
        if (filterStatus && status !== filterStatus) {
            showRow = false;
        }
        if (filterDate && !date.includes(filterDate)) {
            showRow = false;
        }

        row.style.display = showRow ? '' : 'none';
    });
}

document.querySelectorAll('.alert .close').forEach(button => {
    button.addEventListener('click', () => {
        const alertDiv = button.parentElement;
        alertDiv.style.display = 'none';
    });
});