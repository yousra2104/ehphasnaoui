<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EHP-HASNAOUI - Organismes Conventionnés</title>
    <link rel="icon" href="../assets/img/logozoom.PNG" />
    <link rel="stylesheet" href="../assets/css/globals.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/admincss/tableau.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        .close-btn {
            margin-top: 10px;
            padding: 8px 16px;
            background: #ccc;
            border: none;
            cursor: pointer;
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
        th:nth-child(2), td:nth-child(2) { width: 35%; } /* Nom */
        th:nth-child(3), td:nth-child(3) { width: 25%; } /* Logo */
        th:nth-child(4), td:nth-child(4) { width: 15%; } /* Statut */
        th:nth-child(5), td:nth-child(5) { width: 20%; } /* Date */
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
        .header-text.active-name, .header-text.active-date, .header-text.active-status {
            font-weight: bold;
        }
        #popupImage {
            max-width: 100%;
            max-height: 400px;
            object-fit: contain;
        }
        td:nth-child(3) {
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        td:nth-child(3) a {
            display: inline-block;
            max-width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .alert {
            position: relative;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #dff0d8;
            border-color: #d6e9c6;
            color: #3c763d;
        }
        .alert-danger {
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
        }
        .toggle-status-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
        }
        .toggle-status-btn.active {
            background-color: #28a745;
            color: white;
        }
        .toggle-status-btn.inactive {
            background-color: #dc3545;
            color: white;
        }
        .toggle-status-btn:disabled {
            cursor: not-allowed;
            opacity: 0.6;
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
                            <button type="button" class="close">×</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close">×</button>
                            {{ session()->get('error') }}
                        </div>
                    @endif

                    <div class="action-buttons">
                        <button onclick="openAddPopup()">Ajouter</button>
                        <button id="editBtn" onclick="openEditPopup()" class="btn-disabled" disabled>Modifier</button>
                    </div>

                    <div class="org-list">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th onclick="sortTable('name')" style="cursor: pointer;">
                                        <span class="header-text">Nom</span> <span id="sort-name"></span>
                                    </th>
                                    <th>
                                        <span class="header-text">Logo</span>
                                    </th>
                                    <th onclick="sortTable('status')" style="cursor: pointer;">
                                        <span class="header-text">Statut</span> <span id="sort-status"></span>
                                    </th>
                                    <th onclick="sortTable('date')" style="cursor: pointer;">
                                        <span class="header-text">Date d'ajout</span> <span id="sort-date"></span>
                                    </th>
                                </tr>
                                <tr class="filter-row">
                                    <th></th>
                                    <th>
                                        <input type="text" id="filterName" placeholder="Filtrer nom..." oninput="filterTable()">
                                    </th>
                                    <th>
                                        <input type="text" id="filterLogo" placeholder="Filtrer logo..." oninput="filterTable()">
                                    </th>
                                    <th>
                                        <select id="filterStatus" onchange="filterTable()">
                                            <option value="">Tous</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </th>
                                    <th>
                                        <input type="text" id="filterDate" placeholder="Ex: 2025 ou 01/2025" oninput="filterTable()">
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="orgTableBody">
                                @if(isset($organisms) && $organisms->isNotEmpty())
                                    @foreach($organisms as $org)
                                        <tr>
                                            <td><input type="checkbox" class="org-checkbox" data-id="{{ $org->id }}" onchange="toggleButtons()"></td>
                                            <td>{{ $org->name }}</td>
                                            <td>
                                                @if($org->logo && file_exists(public_path('storage/' . $org->logo)))
                                                    <a href="#" onclick="openImagePopup('{{ asset('storage/' . $org->logo) }}')" title="{{ basename($org->logo) }}">
                                                        {{ Str::limit(basename($org->logo), 20) }}
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <button class="toggle-status-btn {{ $org->is_active ? 'active' : 'inactive' }}"
                                                        data-id="{{ $org->id }}"
                                                        onclick="toggleStatus({{ $org->id }})">
                                                    {{ $org->is_active ? 'Active' : 'Inactive' }}
                                                </button>
                                            </td>
                                            <td>{{ $org->created_at ? \Carbon\Carbon::parse($org->created_at)->format('d/m/Y') : '-' }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="5">Aucun organisme trouvé.</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="popup-overlay" id="popupOverlay"></div>

        <div class="popup" id="addPopup">
            <h2>Ajouter un organisme</h2>
            <form action="{{ route('admin.organisms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-field">
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="name" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="logo">Logo</label>
                    <input type="file" id="logo" name="logo">
                    @error('logo')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="is_active">Statut</label>
                    <select id="is_active" name="is_active" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    @error('is_active')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit">Ajouter</button>
                    <button type="button" onclick="closePopups()">Annuler</button>
                </div>
            </form>
        </div>

        <div class="popup" id="editPopup">
            <h2>Modifier un organisme</h2>
            <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-field">
                    <label for="editName">Nom</label>
                    <input type="text" id="editName" name="name" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="editLogo">Nouveau logo</label>
                    <input type="file" id="editLogo" name="logo">
                    @error('logo')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="editIsActive">Statut</label>
                    <select id="editIsActive" name="is_active" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    @error('is_active')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit">Modifier</button>
                    <button type="button" onclick="closePopups()">Annuler</button>
                </div>
            </form>
        </div>

        <div class="popup" id="imagePopup">
            <h3>Logo de l'organisme</h3>
            <img id="popupImage" src="" alt="Organisme Logo">
            <button class="close-btn" type="button" onclick="closePopups()">Fermer</button>
        </div>
    </main>

    <script>
        let lastSortedColumn = '';
        let sortDirection = {};

        function toggleButtons() {
            const checkboxes = document.querySelectorAll('.org-checkbox:checked');
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
            const selectedCheckbox = document.querySelector('.org-checkbox:checked');
            if (!selectedCheckbox) return;

            const orgId = selectedCheckbox.dataset.id;
            fetch(`/admin/organisms/${orgId}/edit`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch organism data');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('editName').value = data.name || '';
                    document.getElementById('editIsActive').value = data.is_active ? '1' : '0';
                    document.getElementById('editForm').action = `/admin/organisms/${orgId}`;
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
                    console.error('Error fetching organism data:', error);
                    alert('Une erreur s\'est produite lors du chargement des données de l\'organisme.');
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
            const popup = document.getElementById('imagePopup');
            const popupImage = document.getElementById('popupImage');
            const overlay = document.getElementById('popupOverlay');

            console.log('Attempting to load image:', imageSrc);

            if (!imageSrc || imageSrc === '') {
                console.error('No valid image source provided');
                alert('Aucun logo disponible.');
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
                console.error('Failed to load image:', imageSrc);
                alert('Erreur lors du chargement du logo. Vérifiez que l\'image existe.');
                closePopups();
            };

            popupImage.onload = () => {
                console.log('Image loaded successfully:', imageSrc);
            };
        }

        function toggleStatus(orgId) {
            console.log('Toggling status for organism ID:', orgId);
            const button = $(`.toggle-status-btn[data-id="${orgId}"]`);
            const originalText = button.text();
            button.prop('disabled', true).text('Chargement...');

            $.ajax({
                url: `/admin/toggle_organism_status/${orgId}`,
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log('Toggle success:', data);
                    if (data.is_active) {
                        button.removeClass('inactive').addClass('active').text('Active');
                    } else {
                        button.removeClass('active').addClass('inactive').text('Inactive');
                    }
                    button.prop('disabled', false);
                },
                error: function(xhr) {
                    console.error('Error toggling status:', xhr.status, xhr.responseText);
                    alert('Une erreur s\'est produite lors du changement de statut. Code: ' + xhr.status);
                    button.text(originalText).prop('disabled', false);
                }
            });
        }

        function sortTable(column) {
            const tbody = document.getElementById('orgTableBody');
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
                span.classList.remove('active-name', 'active-status', 'active-date');
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
                } else if (column === 'status') {
                    aValue = a.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                } else if (column === 'date') {
                    aValue = a.querySelector('td:nth-child(5)').textContent.trim();
                    bValue = b.querySelector('td:nth-child(5)').textContent.trim();
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
            const tbody = document.getElementById('orgTableBody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const filterName = document.getElementById('filterName').value.trim().toLowerCase();
            const filterLogo = document.getElementById('filterLogo').value.trim().toLowerCase();
            const filterStatus = document.getElementById('filterStatus').value.trim().toLowerCase();
            const filterDate = document.getElementById('filterDate').value.trim().toLowerCase();

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
                const logo = row.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
                const status = row.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                const date = row.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();

                let showRow = true;

                if (filterName && !name.includes(filterName)) {
                    showRow = false;
                }
                if (filterLogo && !logo.includes(filterLogo)) {
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
    </script>
</body>
</html>