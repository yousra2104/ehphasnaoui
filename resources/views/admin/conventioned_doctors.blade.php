<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EHP-HASNAOUI - Médecins Conventionnés</title>
    <link rel="icon" href="../assets/img/logozoom.PNG" />
    <link rel="stylesheet" href="../assets/css/globals.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/admincss/tableau.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
            display: block;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            z-index: 1000;
            transition: opacity 0.3s ease;
        }
        .popup.active {
            display: block;
            opacity: 1;
        }
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            transition: opacity 0.3s ease;
        }
        .popup-overlay.active {
            display: block;
            opacity: 1;
        }
        .form-field {
            margin-bottom: 15px;
        }
        .form-field label {
            display: block;
            margin-bottom: 5px;
            font-size: 0.9em;
        }
        .form-field input, .form-field select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.9em;
        }
        .button-group {
            display: flex;
            gap: 10px;
        }
        .action-buttons {
            margin-bottom: 20px;
        }
        .action-buttons button {
            padding: 8px 16px;
            margin-right: 10px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            background: #007bff;
            color: white;
        }
        .action-buttons button.btn-disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #ccc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #f4f4f4;
            cursor: pointer;
        }
        th:nth-child(1), td:nth-child(1) { width: 5%; } /* Checkbox */
        th:nth-child(2), td:nth-child(2) { width: 30%; } /* Nom */
        th:nth-child(3), td:nth-child(3) { width: 25%; } /* Spécialité */
        th:nth-child(4), td:nth-child(4) { width: 20%; } /* Date */
        th:nth-child(5), td:nth-child(5) { width: 20%; } /* Statut */
        .filter-row th {
            padding: 4px;
            background: #e9ecef;
        }
        .filter-row input, .filter-row select {
            width: 100%;
            padding: 6px;
            font-size: 0.9em;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .sort-asc::after {
            content: ' ▲';
        }
        .sort-desc::after {
            content: ' ▼';
        }
        .header-text.active-name, .header-text.active-speciality, .header-text.active-date {
            font-weight: bold;
        }
        .alert {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .alert .close {
            float: right;
            font-size: 1.2em;
            cursor: pointer;
        }
        .status-toggle {
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            display: inline-block;
            text-align: center;
        }
        .status-active {
            background-color: #28a745;
        }
        .status-inactive {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <main class="main-container">
        <div id="viewport">
            @include('admin.sidebar')
            <div class="container-fluid page-body-wrapper">
                <div class="container" style="padding-left:200px;">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" onclick="this.parentElement.style.display='none'">×</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                    <div class="action-buttons">
                        <button onclick="openAddPopup()">Ajouter</button>
                        <button id="editBtn" onclick="openEditPopup()" class="btn-disabled" disabled>Modifier</button>
                    </div>

                    <div class="act-list">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th onclick="sortTable('name')" style="cursor: pointer;">
                                        <span class="header-text">Nom du médecin</span> <span id="sort-name"></span>
                                    </th>
                                    <th onclick="sortTable('speciality')" style="cursor: pointer;">
                                        <span class="header-text">Spécialité</span> <span id="sort-speciality"></span>
                                    </th>
                                    <th onclick="sortTable('date')" style="cursor: pointer;">
                                        <span class="header-text">Date</span> <span id="sort-date"></span>
                                    </th>
                                    <th>Statut</th>
                                </tr>
                                <tr class="filter-row">
                                    <th></th>
                                    <th>
                                        <input type="text" id="filterName" placeholder="Filtrer nom..." oninput="filterTable()">
                                    </th>
                                    <th>
                                        <select id="filterSpeciality" onchange="filterTable()">
                                            <option value="">Tous</option>
                                            <option value="dermatologie">Dermatologie</option>
                                            <option value="urologie">Urologie</option>
                                            <option value="cardiologie">Cardiologie</option>
                                            <option value="hématologie">Hématologie</option>
                                            <option value="pédiatrie">Pédiatrie</option>
                                            <option value="médecine générale">Médecine générale</option>
                                        </select>
                                    </th>
                                    <th>
                                        <input type="text" id="filterDate" placeholder="Ex: 2025 ou 01/2025" oninput="filterTable()">
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="actTableBody">
                                @if(isset($doctors) && $doctors->isNotEmpty())
                                    @foreach($doctors as $doctor)
                                        <tr>
                                            <td><input type="checkbox" class="act-checkbox" data-id="{{ $doctor->id }}" onchange="toggleButtons()"></td>
                                            <td>{{ $doctor->name }}</td>
                                            <td>{{ $doctor->speciality }}</td>
                                            <td>{{ $doctor->created_at ? \Carbon\Carbon::parse($doctor->created_at)->format('d/m/Y') : '-' }}</td>
                                            <td>
                                                <span class="status-toggle {{ $doctor->is_active ? 'status-active' : 'status-inactive' }}"
                                                      data-id="{{ $doctor->id }}"
                                                      onclick="toggleStatus({{ $doctor->id }})">
                                                    {{ $doctor->is_active ? 'Actif' : 'Inactif' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="5">Aucun médecin conventionné trouvé.</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popup Overlay -->
        <div class="popup-overlay" id="popupOverlay"></div>

        <!-- Add Conventioned Doctor Popup -->
        <div class="popup" id="addPopup">
            <h2>Ajouter un médecin conventionné</h2>
            <form action="{{ route('upload_conventioned_doctor') }}" method="POST">
                @csrf
                <div class="form-field">
                    <label for="name">Nom complet du médecin</label>
                    <input type="text" id="name" name="name" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="speciality">Spécialité</label>
                    <select id="speciality" name="speciality" required>
                        <option value="" disabled selected>--Sélectionner--</option>
                        <option value="dermatologie">Dermatologie</option>
                        <option value="urologie">Urologie</option>
                        <option value="cardiologie">Cardiologie</option>
                        <option value="hématologie">Hématologie</option>
                        <option value="pédiatrie">Pédiatrie</option>
                        <option value="médecine générale">Médecine générale</option>
                    </select>
                    @error('speciality')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit">Ajouter</button>
                    <button type="button" onclick="closePopups()">Annuler</button>
                </div>
            </form>
        </div>

        <!-- Edit Conventioned Doctor Popup -->
        <div class="popup" id="editPopup">
            <h2>Modifier un médecin conventionné</h2>
            <form id="editForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="form-field">
                    <label for="editName">Nom complet du médecin</label>
                    <input type="text" id="editName" name="name" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="editSpeciality">Spécialité</label>
                    <select id="editSpeciality" name="speciality" required>
                        <option value="" disabled selected>--Sélectionner--</option>
                        <option value="dermatologie">Dermatologie</option>
                        <option value="urologie">Urologie</option>
                        <option value="cardiologie">Cardiologie</option>
                        <option value="hématologie">Hématologie</option>
                        <option value="pédiatrie">Pédiatrie</option>
                        <option value="médecine générale">Médecine générale</option>
                    </select>
                    @error('speciality')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit">Modifier</button>
                    <button type="button" onclick="closePopups()">Annuler</button>
                </div>
            </form>
        </div>
    </main>

    <script>
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
        }

        function openEditPopup() {
            const selectedCheckbox = document.querySelector('.act-checkbox:checked');
            if (!selectedCheckbox) return;

            const doctorId = selectedCheckbox.dataset.id;
            fetch(`/admin/edit_conventioned_doctor/${doctorId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch doctor data');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('editName').value = data.name || '';
                    document.getElementById('editSpeciality').value = data.speciality || '';
                    document.getElementById('editForm').action = `/admin/update_conventioned_doctor/${doctorId}`;
                    const popup = document.getElementById('editPopup');
                    const overlay = document.getElementById('popupOverlay');
                    popup.style.display = 'block';
                    overlay.style.display = 'block';
                    setTimeout(() => {
                        popup.classList.add('active');
                        overlay.classList.add('active');
                    }, 10);
                })
                .catch(error => {
                    console.error('Error fetching doctor data:', error);
                    alert('Une erreur s\'est produite lors du chargement des données du médecin.');
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

        function toggleStatus(doctorId) {
            console.log(`Toggling status for doctor ID: ${doctorId}`);
            fetch(`/admin/toggle_conventioned_doctor_status/${doctorId}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const toggleElement = document.querySelector(`.status-toggle[data-id="${doctorId}"]`);
                        toggleElement.textContent = data.is_active ? 'Actif' : 'Inactif';
                        toggleElement.className = `status-toggle ${data.is_active ? 'status-active' : 'status-inactive'}`;
                    } else {
                        alert(data.error || 'Une erreur s\'est produite lors de la mise à jour du statut.');
                    }
                })
                .catch(error => {
                    console.error('Error toggling status:', error);
                    alert('Une erreur s\'est produite lors de la mise à jour du statut.');
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
                span.classList.remove('active-name', 'active-speciality', 'active-date');
            });

            const sortIndicator = document.getElementById(`sort-${column}`);
            sortIndicator.className = sortDirection[column] === 'asc' ? 'sort-asc' : 'sort-desc';
            const activeHeaderText = document.querySelector(`th[onclick*="sortTable('${column}')"] .header-text`);
            if (activeHeaderText) {
                activeHeaderText.classList.add(`active-${column}`);
            }

            rows.sort((a, b) => {
                let aValue, bValue;

                if (column === 'name') {
                    aValue = a.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
                } else if (column === 'speciality') {
                    aValue = a.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
                } else if (column === 'date') {
                    aValue = a.querySelector('td:nth-child(4)').textContent.trim() || '0';
                    bValue = b.querySelector('td:nth-child(4)').textContent.trim() || '0';
                    if (aValue !== '-' && bValue !== '-') {
                        const [aDay, aMonth, aYear] = aValue.split('/').map(Number);
                        const [bDay, bMonth, bYear] = bValue.split('/').map(Number);
                        aValue = new Date(aYear, aMonth - 1, aDay);
                        bValue = new Date(bYear, bMonth - 1, bYear);
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
            const filterName = document.getElementById('filterName').value.trim().toLowerCase();
            const filterSpeciality = document.getElementById('filterSpeciality').value.trim().toLowerCase();
            const filterDate = document.getElementById('filterDate').value.trim().toLowerCase();

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
                const speciality = row.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
                const date = row.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();

                let showRow = true;

                if (filterName && !name.includes(filterName)) {
                    showRow = false;
                }
                if (filterSpeciality && speciality !== filterSpeciality) {
                    showRow = false;
                }
                if (filterDate && !date.includes(filterDate)) {
                    showRow = false;
                }

                row.style.display = showRow ? '' : 'none';
            });
        }
    </script>
</body>
</html>