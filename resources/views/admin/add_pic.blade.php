<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EHP-HASNAOUI - Galerie</title>
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
        .form-field input, .form-field select, .form-field textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.9em;
        }
        .form-field textarea {
            min-height: 100px;
            resize: vertical;
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
        th:nth-child(1), td:nth-child(1) { width: 5%; }
        th:nth-child(2), td:nth-child(2) { width: 20%; }
        th:nth-child(3), td:nth-child(3) { width: 20%; }
        th:nth-child(4), td:nth-child(4) { width: 20%; }
        th:nth-child(5), td:nth-child(5) { width: 15%; }
        th:nth-child(6), td:nth-child(6) { width: 20%; }
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
        .header-text.active-type,
        .header-text.active-image,
        .header-text.active-description,
        .header-text.active-status,
        .header-text.active-date {
            font-weight: bold;
        }
        .char-count {
            font-size: 0.8em;
            color: #666;
            margin-top: 5px;
            display: block;
        }
        #popupImage {
            max-width: 100%;
            max-height: 400px;
            object-fit: contain;
        }
        td:nth-child(4) {
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
        .alert .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 1.2em;
            cursor: pointer;
            color: inherit;
            opacity: 0.5;
        }
        .toggle-status-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
        }
        .toggle-status-btn.active {
            background: #28a745;
            color: white;
        }
        .toggle-status-btn.inactive {
            background: #dc3545;
            color: white;
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
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close">×</button>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
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
                                    <th onclick="sortTable('type')" style="cursor: pointer;">
                                        <span class="header-text">Type</span> <span id="sort-type"></span>
                                    </th>
                                    <th>
                                        <span class="header-text">Image</span>
                                    </th>
                                    <th onclick="sortTable('description')" style="cursor: pointer;">
                                        <span class="header-text">Description</span> <span id="sort-description"></span>
                                    </th>
                                    <th onclick="sortTable('date')" style="cursor: pointer;">
                                        <span class="header-text">Date</span> <span id="sort-date"></span>
                                    </th>
                                    <th onclick="sortTable('status')" style="cursor: pointer;">
                                        <span class="header-text">Statut</span> <span id="sort-status"></span>
                                    </th>
                                </tr>
                                <tr class="filter-row">
                                    <th></th>
                                    <th>
                                        <select id="filterType" onchange="filterTable()">
                                            <option value="">Tous</option>
                                            <option value="pédiatries et néonatologie">Pédiatries et néonatologie</option>
                                            <option value="salle opératoire">Salle opératoire</option>
                                            <option value="stérilisation">Stérilisation</option>
                                            <option value="laboratoire">Laboratoire</option>
                                            <option value="imagerie">Imagerie</option>
                                            <option value="hospitalisation">Hospitalisation</option>
                                            <option value="les urgences">Les urgences</option>
                                        </select>
                                    </th>
                                    <th>
                                        <input type="text" id="filterImage" placeholder="Filtrer image..." oninput="filterTable()">
                                    </th>
                                    <th>
                                        <input type="text" id="filterDescription" placeholder="Filtrer description..." oninput="filterTable()">
                                    </th>
                                    <th>
                                        <input type="text" id="filterDate" placeholder="Ex: 2025 ou 01/2025" oninput="filterTable()">
                                    </th>
                                    <th>
                                        <select id="filterStatus" onchange="filterTable()">
                                            <option value="">Tous</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="actTableBody">
                                @if(isset($pics) && $pics->isNotEmpty())
                                    @foreach($pics as $pic)
                                        <tr>
                                            <td><input type="checkbox" class="act-checkbox" data-id="{{ $pic->id }}" onchange="toggleButtons()"></td>
                                            <td>{{ $pic->type }}</td>
                                            <td>
                                                <a href="#" onclick="openImagePopup('{{ $pic->image ? asset($pic->image) : '' }}')" title="{{ $pic->image ? basename($pic->image) : '-' }}">
                                                    {{ $pic->image ? Str::limit(basename($pic->image), 20) : '-' }}
                                                </a>
                                            </td>
                                            <td>{{ $pic->description ? Str::limit($pic->description, 50) : '-' }}</td>
                                            <td>{{ $pic->created_at ? \Carbon\Carbon::parse($pic->created_at)->format('d/m/Y') : '-' }}</td>
                                            <td>
                                                <button class="toggle-status-btn {{ $pic->is_active ? 'active' : 'inactive' }}"
                                                        onclick="toggleStatus({{ $pic->id }})"
                                                        data-id="{{ $pic->id }}">
                                                    {{ $pic->is_active ? 'Active' : 'Inactive' }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="6">Aucune image trouvée.</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="popup-overlay undo" id="popupOverlay"></div>

        <div class="popup" id="addPopup">
            <h2>Ajouter une photo</h2>
            <form action="{{ route('upload_pic') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-field">
                    <label for="type">Type</label>
                    <select id="type" name="type" required>
                        <option value="" disabled {{ old('type', '') == '' ? 'selected' : '' }}>--Select--</option>
                        <option value="Pédiatries et néonatologie" {{ old('type') == 'Pédiatries et néonatologie' ? 'selected' : '' }}>Pédiatries et néonatologie</option>
                        <option value="Salle opératoire" {{ old('type') == 'Salle opératoire' ? 'selected' : '' }}>Salle opératoire</option>
                        <option value="Stérilisation" {{ old('type') == 'Stérilisation' ? 'selected' : '' }}>Stérilisation</option>
                        <option value="Laboratoire" {{ old('type') == 'Laboratoire' ? 'selected' : '' }}>Laboratoire</option>
                        <option value="Imagerie" {{ old('type') == 'Imagerie' ? 'selected' : '' }}>Imagerie</option>
                        <option value="Hospitalisation" {{ old('type') == 'Hospitalisation' ? 'selected' : '' }}>Hospitalisation</option>
                        <option value="Les urgences" {{ old('type') == 'Les urgences' ? 'selected' : '' }}>Les urgences</option>
                    </select>
                    @error('type')
                        <span class="error">{{ $message }}</span>
                    @endif
                </div>
                <div class="form-field">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/gif" required>
                    @error('image')
                        <span class="error">{{ $message }}</span>
                    @endif
                </div>
                <div class="form-field">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" maxlength="1000" oninput="updateCharCount('description', 'addCharCount')">{{ old('description') }}</textarea>
                    <span id="addCharCount" class="char-count">0/1000</span>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @endif
                </div>
                <div class="form-field">
                    <label for="is_active">Statut</label>
                    <select id="is_active" name="is_active" required>
                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active', '1') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('is_active')
                        <span class="error">{{ $message }}</span>
                    @endif
                </div>
                <div class="button-group">
                    <button type="submit">Ajouter</button>
                    <button type="button" onclick="closePopups()">Annuler</button>
                </div>
            </form>
        </div>

        <div class="popup" id="editPopup">
            <h2>Modifier une photo</h2>
            <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-field">
                    <label for="editType">Type</label>
                    <select id="editType" name="type" required>
                        <option value="" disabled>--Select--</option>
                        <option value="Pédiatries et néonatologie">Pédiatries et néonatologie</option>
                        <option value="Salle opératoire">Salle opératoire</option>
                        <option value="Stérilisation">Stérilisation</option>
                        <option value="Laboratoire">Laboratoire</option>
                        <option value="Imagerie">Imagerie</option>
                        <option value="Hospitalisation">Hospitalisation</option>
                        <option value="Les urgences">Les urgences</option>
                    </select>
                    @error('type')
                        <span class="error">{{ $message }}</span>
                    @endif
                </div>
                <div class="form-field">
                    <label for="editImage">Nouvelle image</label>
                    <input type="file" id="editImage" name="image" accept="image/jpeg,image/png,image/jpg,image/gif">
                    @error('image')
                        <span class="error">{{ $message }}</span>
                    @endif
                </div>
                <div class="form-field">
                    <label for="editDescription">Description</label>
                    <textarea id="editDescription" name="description" maxlength="1000" oninput="updateCharCount('editDescription', 'editCharCount')"></textarea>
                    <span id="editCharCount" class="char-count">0/1000</span>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @endif
                </div>
                <div class="form-field">
                    <label for="editIsActive">Statut</label>
                    <select id="editIsActive" name="is_active" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    @error('is_active')
                        <span class="error">{{ $message }}</span>
                    @endif
                </div>
                <div class="button-group">
                    <button type="submit">Modifier</button>
                    <button type="button" onclick="closePopups()">Annuler</button>
                </div>
            </form>
        </div>

        <div class="popup" id="imagePopup">
            <h3>Image de la galerie</h3>
            <img id="popupImage" src="" alt="Pic Image">
            <button class="close-btn" type="button" onclick="closePopups()">Fermer</button>
        </div>
    </main>

    <script>
        // Initialize state variables
        let lastSortedColumn = '';
        let sortDirection = {};

        // Initialize character count and close buttons on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCharCount('description', 'addCharCount');
            updateCharCount('editDescription', 'editCharCount');
            document.querySelectorAll('.alert .close').forEach(button => {
                button.addEventListener('click', () => {
                    button.parentElement.style.display = 'none';
                });
            });
            console.log('CSRF Token:', $('meta[name="csrf-token"]').attr('content'));
        });

        // Update character count for textareas
        function updateCharCount(textareaId, counterId) {
            const textarea = document.getElementById(textareaId);
            const counter = document.getElementById(counterId);
            if (textarea && counter) {
                counter.textContent = `${textarea.value.length}/${textarea.maxLength}`;
            }
        }

        // Toggle edit button based on checkbox selection
        function toggleButtons() {
            const checkboxes = document.querySelectorAll('.act-checkbox:checked');
            const editBtn = document.getElementById('editBtn');
            editBtn.disabled = checkboxes.length !== 1;
            editBtn.classList.toggle('btn-disabled', checkboxes.length !== 1);
        }

        // Open edit popup and fetch pic data
        function openEditPopup() {
            const selectedCheckbox = document.querySelector('.act-checkbox:checked');
            if (!selectedCheckbox) return;

            const picId = selectedCheckbox.dataset.id;
            $.ajax({
                url: `/admin/edit_pic/${picId}`,
                method: 'GET',
                success: function(data) {
                    $('#editType').val(data.type || '');
                    $('#editDescription').val(data.description || '');
                    $('#editIsActive').val(data.is_active ? '1' : '0');
                    $('#editForm').attr('action', `/admin/update_pic/${picId}`);
                    $('#editPopup').show();
                    $('#popupOverlay').show();
                    setTimeout(() => {
                        $('#editPopup').addClass('active');
                        $('#popupOverlay').addClass('active');
                    }, 10);
                    updateCharCount('editDescription', 'editCharCount');
                },
                error: function(xhr) {
                    console.error('Error fetching pic data:', xhr.status, xhr.responseText);
                    alert('Une erreur s\'est produite lors du chargement des données de l\'image.');
                }
            });
        }

        // Toggle pic status via AJAX
        function toggleStatus(picId) {
            console.log('Toggling status for pic ID:', picId);
            const button = $(`.toggle-status-btn[data-id="${picId}"]`);
            const originalText = button.text();
            button.prop('disabled', true).text('Chargement...');

            $.ajax({
                url: `/admin/toggle_pic_status/${picId}`,
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

        // Sort table by column
        function sortTable(column) {
            const tbody = document.getElementById('actTableBody');
            const rows = Array.from(tbody.querySelectorAll('tr'));

            if (lastSortedColumn === column) {
                sortDirection[column] = sortDirection[column] === 'asc' ? 'desc' : 'asc';
            } else {
                sortDirection = { [column]: 'asc' };
            }
            lastSortedColumn = column;

            // Reset sort indicators
            document.querySelectorAll('th span[id^="sort-"]').forEach(span => {
                span.className = '';
            });
            document.querySelectorAll('th .header-text').forEach(span => {
                span.classList.remove('active-type', 'active-image', 'active-description', 'active-date', 'active-status');
            });

            // Set sort indicator
            const sortIndicator = document.getElementById(`sort-${column}`);
            sortIndicator.className = sortDirection[column] === 'asc' ? 'sort-asc' : 'sort-desc';
            const activeHeaderText = document.querySelector(`th[onclick*="sortTable('${column}')"] .header-text`);
            if (activeHeaderText) {
                activeHeaderText.classList.add(`active-${column}`);
            }

            rows.sort((a, b) => {
                let aValue, bValue;

                if (column === 'type') {
                    aValue = a.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
                } else if (column === 'description') {
                    aValue = a.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                } else if (column === 'date') {
                    aValue = a.querySelector('td:nth-child(5)').textContent.trim() || '-';
                    bValue = b.querySelector('td:nth-child(5)').textContent.trim() || '-';
                    if (aValue !== '-' && bValue !== '-') {
                        const [aDay, aMonth, aYear] = aValue.split('/').map(Number);
                        const [bDay, bMonth, bYear] = bValue.split('/').map(Number);
                        aValue = new Date(aYear, aMonth - 1, aDay);
                        bValue = new Date(bYear, bMonth - 1, bDay);
                    } else {
                        aValue = aValue === '-' ? null : aValue;
                        bValue = bValue === '-' ? null : bValue;
                    }
                } else if (column === 'status') {
                    aValue = a.querySelector('td:nth-child(6) button').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(6) button').textContent.trim().toLowerCase();
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

        // Filter table based on input/select values
        function filterTable() {
            const tbody = document.getElementById('actTableBody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const filterType = document.getElementById('filterType').value.trim().toLowerCase();
            const filterImage = document.getElementById('filterImage').value.trim().toLowerCase();
            const filterDescription = document.getElementById('filterDescription').value.trim().toLowerCase();
            const filterDate = document.getElementById('filterDate').value.trim().toLowerCase();
            const filterStatus = document.getElementById('filterStatus').value.trim().toLowerCase();

            rows.forEach(row => {
                const type = row.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
                const image = row.querySelector('td:nth-child(3) a').textContent.trim().toLowerCase();
                const description = row.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                const date = row.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();
                const status = row.querySelector('td:nth-child(6) button').textContent.trim().toLowerCase();

                let showRow = true;

                if (filterType && type !== filterType) showRow = false;
                if (filterImage && !image.includes(filterImage)) showRow = false;
                if (filterDescription && !description.includes(filterDescription)) showRow = false;
                if (filterDate && !date.includes(filterDate)) showRow = false;
                if (filterStatus && status !== filterStatus) showRow = false;

                row.style.display = showRow ? '' : 'none';
            });

            const visibleRows = rows.filter(row => row.style.display !== 'none');
            if (visibleRows.length === 0 && rows.length > 0) {
                tbody.innerHTML = '<tr><td colspan="6">Aucun résultat trouvé.</td></tr>';
            } else if (visibleRows.length > 0) {
                tbody.innerHTML = '';
                rows.forEach(row => tbody.appendChild(row));
                rows.forEach(row => {
                    const type = row.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
                    const image = row.querySelector('td:nth-child(3) a').textContent.trim().toLowerCase();
                    const description = row.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                    const date = row.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();
                    const status = row.querySelector('td:nth-child(6) button').textContent.trim().toLowerCase();
                    let showRow = true;
                    if (filterType && type !== filterType) showRow = false;
                    if (filterImage && !image.includes(filterImage)) showRow = false;
                    if (filterDescription && !description.includes(filterDescription)) showRow = false;
                    if (filterDate && !date.includes(filterDate)) showRow = false;
                    if (filterStatus && status !== filterStatus) showRow = false;
                    row.style.display = showRow ? '' : 'none';
                });
            }
        }

        // Open add popup
        function openAddPopup() {
            $('#addPopup').show();
            $('#popupOverlay').show();
            setTimeout(() => {
                $('#addPopup').addClass('active');
                $('#popupOverlay').addClass('active');
            }, 10);
        }

        // Close all popups
        function closePopups() {
            $('.popup').removeClass('active');
            $('#popupOverlay').removeClass('active');
            setTimeout(() => {
                $('.popup').hide();
                $('#popupOverlay').hide();
            }, 300);
        }

        // Open image popup
        function openImagePopup(imageUrl) {
            $('#popupImage').attr('src', imageUrl || '');
            $('#imagePopup').show();
            $('#popupOverlay').show();
            setTimeout(() => {
                $('#imagePopup').addClass('active');
                $('#popupOverlay').addClass('active');
            }, 10);
        }

        // Validate edit form on submit
        $('#editForm').on('submit', function(e) {
            if (!$('#editType').val()) {
                e.preventDefault();
                alert('Veuillez sélectionner un type valide.');
            }
        });

        // Validate add form on submit
        $('#addPopup form').on('submit', function(e) {
            if (!$('#type').val()) {
                e.preventDefault();
                alert('Veuillez sélectionner un type valide.');
            }
        });
    </script>
</body>
</html>