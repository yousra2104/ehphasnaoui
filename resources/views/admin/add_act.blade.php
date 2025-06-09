<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EHP-HASNAOUI - Actualités</title>
    <link rel="icon" href="../assets/img/logozoom.PNG" />
    <link rel="stylesheet" href="../assets/css/globals.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/admincss/tableau.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/tableau.js"></script>
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
            padding: 20px; /* Increased padding slightly */
            z-index: 1000;
            transition: opacity 0.3s ease;
            width: 90%;
            max-width: 600px; /* Increased max-width for slightly larger popup */
            max-height: 80vh; /* Limit height to 80% of viewport */
            overflow-y: auto; /* Enable scrolling if content overflows */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
            margin-bottom: 12px;
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
        .button-group {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .close-btn {
            margin-top: 10px;
            padding: 8px 16px;
            background: #ccc;
            border: none;
            cursor: pointer;
            border-radius: 4px;
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
        th:nth-child(4), td:nth-child(4) { width: 15%; }
        th:nth-child(5), td:nth-child(5) { width: 15%; }
        th:nth-child(6), td:nth-child(6) { width: 15%; }
        th:nth-child(7), td:nth-child(7) { width: 10%; }
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
        .header-text.active-titre, .header-text.active-type, .header-text.active-date, .header-text.active-status {
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
        td:nth-child(5) {
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        td:nth-child(5) a {
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

                    <div class="action-buttons">
                        <button onclick="openAddPopup()">Ajouter</button>
                        <button id="editBtn" onclick="openEditPopup()" class="btn-disabled" disabled>Modifier</button>
                    </div>

                    <div class="act-list">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th onclick="sortTable('titre')" style="cursor: pointer;">
                                        <span class="header-text">Titre</span> <span id="sort-titre"></span>
                                    </th>
                                    <th>
                                        <span class="header-text">Description</span>
                                    </th>
                                    <th onclick="sortTable('type')" style="cursor: pointer;">
                                        <span class="header-text">Type</span> <span id="sort-type"></span>
                                    </th>
                                    <th>
                                        <span class="header-text">Image</span>
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
                                        <input type="text" id="filterTitre" placeholder="Filtrer titre..." oninput="filterTable()">
                                    </th>
                                    <th>
                                        <input type="text" id="filterDescription" placeholder="Filtrer description..." oninput="filterTable()">
                                    </th>
                                    <th>
                                        <select id="filterType" onchange="filterTable()">
                                            <option value="">Tous</option>
                                            <option value="événement">Événement</option>
                                            <option value="annonce">Annonce</option>
                                            <option value="article">Article</option>
                                        </select>
                                    </th>
                                    <th>
                                        <input type="text" id="filterImage" placeholder="Filtrer image..." oninput="filterTable()">
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
                            <tbody id="actTableBody">
                                @if(isset($acts) && $acts->isNotEmpty())
                                    @foreach($acts as $act)
                                        <tr>
                                            <td><input type="checkbox" class="act-checkbox" data-id="{{ $act->id }}" onchange="toggleButtons()"></td>
                                            <td>{{ $act->titre }}</td>
                                            <td>{{ Str::limit($act->description, 50) }}</td>
                                            <td>{{ $act->type }}</td>
                                            <td>
                                                @if($act->image)
                                                    <a href="#" onclick="openImagePopup('{{ asset($act->image) }}')" title="{{ basename($act->image) }}">
                                                        {{ Str::limit(basename($act->image), 20) }}
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <button class="toggle-status-btn {{ $act->is_active ? 'active' : 'inactive' }}"
                                                        onclick="toggleStatus({{ $act->id }}, {{ $act->is_active ? 'true' : 'false' }})">
                                                    {{ $act->is_active ? 'Active' : 'Inactive' }}
                                                </button>
                                            </td>
                                            <td>{{ $act->date_ajout ? \Carbon\Carbon::parse($act->date_ajout)->format('d/m/Y') : '-' }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="7">Aucune actualité trouvée.</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="popup-overlay" id="popupOverlay"></div>

        <div class="popup" id="addPopup">
            <h2>Ajouter une actualité</h2>
            <form action="{{ route('upload_act') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-field">
                    <label for="titre">Titre</label>
                    <input type="text" id="titre" name="titre" required>
                    @error('titre')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" maxlength="10000" required oninput="updateCharCount('description', 'addCharCount')"></textarea>
                    <span id="addCharCount" class="char-count">0/10000</span>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="type">Type</label>
                    <select id="type" name="type" required>
                        <option value="" disabled selected>--Select--</option>
                        <option value="événement">Événement</option>
                        <option value="annonce">Annonce</option>
                        <option value="article">Article</option>
                    </select>
                    @error('type')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image">
                    @error('image')
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
                <div class="form-field">
                    <label for="date_ajout">Date d'ajout</label>
                    <input type="date" id="date_ajout" name="date_ajout" required>
                    @error('date_ajout')
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
            <h2>Modifier une actualité</h2>
            <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-field">
                    <label for="editTitre">Titre</label>
                    <input type="text" id="editTitre" name="titre" required>
                    @error('titre')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="editDescription">Description</label>
                    <textarea id="editDescription" name="description" maxlength="10000" required oninput="updateCharCount('editDescription', 'editCharCount')"></textarea>
                    <span id="editCharCount" class="char-count">0/10000</span>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="editType">Type</label>
                    <select id="editType" name="type" required>
                        <option value="" disabled selected>--Select--</option>
                        <option value="événement">Événement</option>
                        <option value="annonce">Annonce</option>
                        <option value="article">Article</option>
                    </select>
                    @error('type')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="editImage">Nouvelle image</label>
                    <input type="file" id="editImage" name="image">
                    @error('image')
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
                <div class="form-field">
                    <label for="editDateAjout">Date d'ajout</label>
                    <input type="date" id="editDateAjout" name="date_ajout" required>
                    @error('date_ajout')
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
            <h3>Image de l'actualité</h3>
            <img id="popupImage" src="" alt="Actualité Image">
            <button class="close-btn" type="button" onclick="closePopups()">Fermer</button>
        </div>
    </main>

    <script src="../assets/js/adminjs/add_act.js"></script>
</body>
</html>