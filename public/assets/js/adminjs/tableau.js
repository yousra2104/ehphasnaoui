function openAddPopup() {
    const popup = document.getElementById('addPopup');
    const overlay = document.getElementById('popupOverlay');
    popup.style.display = 'block';
    overlay.style.display = 'block';
    setTimeout(() => {
        popup.classList.add('active');
        overlay.classList.add('active');
    }, 10);
}

function openEditPopup() {
    const selectedCheckbox = document.querySelector('.act-checkbox:checked');
    if (!selectedCheckbox) {
        alert('Veuillez sélectionner une actualité à modifier.');
        return;
    }

    const actId = selectedCheckbox.dataset.id;
    fetch(`/admin/edit_act/${actId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('editTitre').value = data.titre || '';
            document.getElementById('editDescription').value = data.description || '';
            document.getElementById('editType').value = data.type || '';
            document.getElementById('editIsActive').value = data.is_active ? '1' : '0';
            document.getElementById('editDateAjout').value = data.date_ajout ? new Date(data.date_ajout).toISOString().split('T')[0] : '';
            document.getElementById('editForm').action = `/admin/update_act/${actId}`;
            document.getElementById('editCharCount').textContent = `${data.description ? data.description.length : 0}/10000`;
        })
        .catch(error => {
            console.error('Error fetching act data:', error);
            alert('Erreur lors de la récupération des données de l\'actualité.');
        });

    const popup = document.getElementById('editPopup');
    const overlay = document.getElementById('popupOverlay');
    popup.style.display = 'block';
    overlay.style.display = 'block';
    setTimeout(() => {
        popup.classList.add('active');
        overlay.classList.add('active');
    }, 10);
}

function previewImage() {
    const fileInput = document.getElementById('editImage');
    const preview = document.getElementById('editImagePreview');
    const file = fileInput.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
}

function openImagePopup(imageSrc) {
    const popupImage = document.getElementById('popupImage');
    popupImage.src = imageSrc;
    popupImage.onerror = () => {
        console.error('Failed to load image:', imageSrc);
        popupImage.src = '/path/to/fallback-image.jpg';
    };
    const popup = document.getElementById('imagePopup');
    const overlay = document.getElementById('popupOverlay');
    popup.style.display = 'block';
    overlay.style.display = 'block';
    setTimeout(() => {
        popup.classList.add('active');
        overlay.classList.add('active');
    }, 10);
}

function openActDetailPopup(actId) {
    fetch(`/admin/edit_act/${actId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('actDetailTitle').textContent = data.titre || '';
            document.getElementById('actDetailImage').src = data.image ? `${window.location.origin}/${data.image}` : '/path/to/fallback-image.jpg';
            document.getElementById('actDetailType').textContent = data.type || '';
            document.getElementById('actDetailDescription').textContent = data.description || '';
            document.getElementById('actDetailDate').textContent = data.created_at ? new Date(data.created_at).toLocaleDateString('fr-FR') : (data.date_ajout ? new Date(data.date_ajout).toLocaleDateString('fr-FR') : '-');
            const popup = document.getElementById('actDetailPopup');
            const overlay = document.getElementById('popupOverlay');
            popup.style.display = 'block';
            overlay.style.display = 'block';
            setTimeout(() => {
                popup.classList.add('active');
                overlay.classList.add('active');
            }, 10);
        })
        .catch(error => console.error('Error fetching act data:', error));
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
    const editImagePreview = document.getElementById('editImagePreview');
    if (editImagePreview) editImagePreview.style.display = 'none';
}

function toggleButtons() {
    const checkboxes = document.querySelectorAll('.act-checkbox:checked');
    const editBtn = document.getElementById('editBtn');
    const deleteBtn = document.getElementById('deleteBtn');
    const deleteForm = document.getElementById('deleteForm');

    if (checkboxes.length === 1) {
        editBtn.classList.remove('btn-disabled');
        editBtn.disabled = false;
        deleteBtn.classList.remove('btn-disabled');
        deleteBtn.disabled = false;
        deleteForm.action = `/admin/delete_act/${checkboxes[0].dataset.id}`;
        console.log('Delete form action set to:', deleteForm.action);
    } else {
        editBtn.classList.add('btn-disabled');
        editBtn.disabled = true;
        deleteBtn.classList.add('btn-disabled');
        deleteBtn.disabled = true;
        deleteForm.action = '';
        console.log('Delete form action cleared');
    }
}

function closeAlert() {
    const closeButtons = document.querySelectorAll('.alert .close');
    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const alert = button.closest('.alert');
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 300);
        });
    });
}

function updateCharCount(textareaId, spanId) {
    const textarea = document.getElementById(textareaId);
    const span = document.getElementById(spanId);
    span.textContent = `${textarea.value.length}/10000`;
}

function toggleStatus(id) {
    const url = `/admin/toggle_act_status/${id}`;
    const button = document.querySelector(`.toggle-status-btn[data-id="${id}"]`);

    fetch(url, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw new Error(err.error || 'Erreur lors de la mise à jour du statut'); });
        }
        return response.json();
    })
    .then(data => {
        button.textContent = data.is_active ? 'Active' : 'Inactive';
        button.classList.remove('active', 'inactive');
        button.classList.add(data.is_active ? 'active' : 'inactive');
        button.dataset.status = data.is_active ? 'true' : 'false';
        console.log(`Status toggled for act ${id}: ${data.is_active ? 'Active' : 'Inactive'}`);
    })
    .catch(error => {
        console.error('Error toggling status:', error);
        alert(error.message);
    });
}

function deleteAct() {
    const deleteForm = document.getElementById('deleteForm');
    const url = deleteForm.action;

    if (!url) {
        alert('Veuillez sélectionner une actualité à supprimer.');
        console.error('Delete form action is empty');
        return;
    }

    console.log('Attempting to delete act with URL:', url);

    if (confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?')) {
        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => {
            console.log('Delete response status:', response.status);
            if (!response.ok) {
                return response.json().then(err => { throw new Error(err.error || 'Erreur lors de la suppression'); });
            }
            return response.json();
        })
        .then(data => {
            alert('Actualité supprimée avec succès');
            console.log('Act deleted successfully:', data);
            window.location.reload();
        })
        .catch(error => {
            console.error('Error deleting act:', error);
            alert(error.message);
        });
    }
}

// Initialize listeners
document.addEventListener('DOMContentLoaded', () => {
    closeAlert();

    // Attach toggleStatus to status buttons
    document.querySelectorAll('.toggle-status-btn').forEach(button => {
        button.addEventListener('click', () => {
            toggleStatus(button.dataset.id);
        });
    });

    // Attach deleteAct to delete button
    const deleteBtn = document.getElementById('deleteBtn');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function(e) {
            e.preventDefault();
            deleteAct();
        });
    }
});

let sortDirection = {};
let lastSortedColumn = null;

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
        span.classList.remove('active-titre', 'active-description', 'active-type', 'active-image', 'active-date', 'active-status');
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
        } else if (column === 'description') {
            aValue = a.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
            bValue = b.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
        } else if (column === 'type') {
            aValue = a.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
            bValue = b.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
        } else if (column === 'image') {
            aValue = a.querySelector('td:nth-child(5) a') ? a.querySelector('td:nth-child(5) a').textContent.trim().toLowerCase() : '';
            bValue = b.querySelector('td:nth-child(5) a') ? b.querySelector('td:nth-child(5) a').textContent.trim().toLowerCase() : '';
        } else if (column === 'status') {
            aValue = a.querySelector('td:nth-child(6)').textContent.trim().toLowerCase();
            bValue = b.querySelector('td:nth-child(6)').textContent.trim().toLowerCase();
        } else if (column === 'date') {
            aValue = a.querySelector('td:nth-child(7)').textContent.trim() || '0';
            bValue = b.querySelector('td:nth-child(7)').textContent.trim() || '0';
            if (aValue !== '-' && bValue !== '-') {
                const [aDay, aMonth, aYear] = aValue.split('/').map(Number);
                const [bDay, bMonth, bYear] = bValue.split('/').map(Number);
                aValue = new Date(aYear, aMonth - 1, aDay);
                bValue = new Date(bYear, bMonth - 1, bDay);
            } else {
                aValue = aValue === '-' ? null : aValue;
                bValue = bValue === '-' ? null : bValue;
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
        const image = row.querySelector('td:nth-child(5) a') ? row.querySelector('td:nth-child(5) a').textContent.trim().toLowerCase() : '';
        const status = row.querySelector('td:nth-child(6)').textContent.trim().toLowerCase();
        const date = row.querySelector('td:nth-child(7)').textContent.trim().toLowerCase();

        let showRow = true;

        if (filterTitre && !titre.includes(filterTitre)) showRow = false;
        if (filterDescription && !description.includes(filterDescription)) showRow = false;
        if (filterType && type !== filterType) showRow = false;
        if (filterImage && !image.includes(filterImage)) showRow = false;
        if (filterStatus && status !== filterStatus) showRow = false;
        if (filterDate && !date.includes(filterDate)) showRow = false;

        row.style.display = showRow ? '' : 'none';
    });
}