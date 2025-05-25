<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EHP-HASNAOUI - Réclamations</title>
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
        .form-field input, .form-field select, .form-field textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.9em;
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
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .action-buttons button {
            padding: 8px 16px;
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
        .percentage-display {
            font-size: 1em;
            font-weight: 500;
            color: #fff;
            background: #28a745;
            padding: 8px 12px;
            border-radius: 4px;
            display: inline-block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
            display: table;
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
        th:nth-child(2), td:nth-child(2) { width: 15%; } /* Nom */
        th:nth-child(3), td:nth-child(3) { width: 15%; } /* Téléphone */
        th:nth-child(4), td:nth-child(4) { width: 10%; } /* Wilaya */
        th:nth-child(5), td:nth-child(5) { width: 15%; } /* Complaint Type */
        th:nth-child(6), td:nth-child(6) { width: 15%; } /* Message */
        th:nth-child(7), td:nth-child(7) { width: 15%; } /* Solution */
        th:nth-child(8), td:nth-child(8) { width: 10%; } /* Statut */
        th:nth-child(9), td:nth-child(9) { width: 10%; } /* Date */
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
        .header-text.active-name, .header-text.active-phone, .header-text.active-wilaya, .header-text.active-complaint_type, .header-text.active-message, .header-text.active-solution, .header-text.active-status, .header-text.active-date {
            font-weight: bold;
        }
        .alert {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
            position: relative;
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
            line-height: 1;
            color: inherit;
            opacity: 0.8;
        }
        .alert .close:hover {
            opacity: 1;
        }
        .container-fluid {
            padding: 0;
        }
        .page-body-wrapper {
            width: 100%;
        }
    </style>
</head>
<body>
    <main class="main-container">
        <div id="viewport">
            @include('admin.sidebar')
            <div class="container-fluid page-body-wrapper">
                <div class="container" style="padding-left:100px;">
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

                    <div class="reclamation-list">
                        <form id="markProcessedForm" method="POST" action="">
                            @csrf
                            @method('PUT')
                            <div class="action-buttons">
                                <button id="markProcessedBtn" type="submit" form="markProcessedForm" class="btn-disabled" disabled>Marquer comme traité</button>
                                <div class="percentage-display">
                                    @if(isset($reclamations) && $reclamations->isNotEmpty())
                                        @php
                                            $totalReclamations = $reclamations->count();
                                            $processedReclamations = $reclamations->where('status', 'processed')->count();
                                            $percentage = $totalReclamations > 0 ? round(($processedReclamations / $totalReclamations) * 100, 2) : 0;
                                        @endphp
                                        Pourcentage de réclamations traitées : {{ $percentage }}%
                                    @else
                                        Pourcentage de réclamations traitées : 0%
                                    @endif
                                </div>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th onclick="sortTable('name')" style="cursor: pointer;">
                                            <span class="header-text">Nom</span> <span id="sort-name"></span>
                                        </th>
                                        <th onclick="sortTable('phone')" style="cursor: pointer;">
                                            <span class="header-text">Téléphone</span> <span id="sort-phone"></span>
                                        </th>
                                        <th onclick="sortTable('wilaya')" style="cursor: pointer;">
                                            <span class="header-text">Wilaya</span> <span id="sort-wilaya"></span>
                                        </th>
                                        <th onclick="sortTable('complaint_type')" style="cursor: pointer;">
                                            <span class="header-text">Type de réclamation</span> <span id="sort-complaint_type"></span>
                                        </th>
                                        <th onclick="sortTable('message')" style="cursor: pointer;">
                                            <span class="header-text">Message</span> <span id="sort-message"></span>
                                        </th>
                                        <th onclick="sortTable('solution')" style="cursor: pointer;">
                                            <span class="header-text">Solution</span> <span id="sort-solution"></span>
                                        </th>
                                        <th onclick="sortTable('status')" style="cursor: pointer;">
                                            <span class="header-text">Statut</span> <span id="sort-status"></span>
                                        </th>
                                        <th onclick="sortTable('date')" style="cursor: pointer;">
                                            <span class="header-text">Date</span> <span id="sort-date"></span>
                                        </th>
                                    </tr>
                                    <tr class="filter-row">
                                        <th></th>
                                        <th><input type="text" id="filterName" placeholder="Filtrer nom..." oninput="filterTable()"></th>
                                        <th><input type="text" id="filterPhone" placeholder="Filtrer téléphone..." oninput="filterTable()"></th>
                                        <th><input type="text" id="filterWilaya" placeholder="Filtrer wilaya..." oninput="filterTable()"></th>
                                        <th><input type="text" id="filterComplaintType" placeholder="Filtrer type..." oninput="filterTable()"></th>
                                        <th><input type="text" id="filterMessage" placeholder="Filtrer message..." oninput="filterTable()"></th>
                                        <th><input type="text" id="filterSolution" placeholder="Filtrer solution..." oninput="filterTable()"></th>
                                        <th>
                                            <select id="filterStatus" onchange="filterTable()">
                                                <option value="">Tous</option>
                                                <option value="pending">En attente</option>
                                                <option value="processed">Traité</option>
                                            </select>
                                        </th>
                                        <th><input type="text" id="filterDate" placeholder="Ex: 2025 ou 01/2025" oninput="filterTable()"></th>
                                    </tr>
                                </thead>
                                <tbody id="reclamationTableBody">
                                    @if(isset($reclamations) && $reclamations->isNotEmpty())
                                        @foreach($reclamations as $reclamation)
                                            <tr>
                                                <td><input type="checkbox" class="reclamation-checkbox" data-id="{{ $reclamation->id }}" onchange="toggleButtons()"></td>
                                                <td>
                                                    <a href="#" onclick="openReclamationPopup('{{ addslashes($reclamation->name) }}', '{{ addslashes($reclamation->phone) }}', '{{ addslashes($reclamation->wilaya) }}', '{{ addslashes(is_array($reclamation->complaint_type) ? implode(', ', $reclamation->complaint_type) : $reclamation->complaint_type) }}', '{{ addslashes($reclamation->message) }}', '{{ addslashes($reclamation->solution ?? '-') }}', '{{ $reclamation->status === 'pending' ? 'En attente' : 'Traité' }}', '{{ $reclamation->created_at ? \Carbon\Carbon::parse($reclamation->created_at)->format('d/m/Y') : '-' }}')">
                                                        {{ $reclamation->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $reclamation->phone }}</td>
                                                <td>{{ $reclamation->wilaya }}</td>
                                                <td>{{ is_array($reclamation->complaint_type) ? implode(', ', $reclamation->complaint_type) : $reclamation->complaint_type }}</td>
                                                <td>{{ Str::limit($reclamation->message, 50) }}</td>
                                                <td>{{ $reclamation->solution ?? '-' }}</td>
                                                <td>{{ $reclamation->status === 'pending' ? 'En attente' : 'Traité' }}</td>
                                                <td>{{ $reclamation->created_at ? \Carbon\Carbon::parse($reclamation->created_at)->format('d/m/Y') : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="9">Aucune réclamation trouvée.</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popup Overlay -->
        <div class="popup-overlay" id="popupOverlay"></div>

        <!-- Reclamation Details Popup -->
        <div class="popup" id="reclamationPopup">
            <h3>Détails de la réclamation</h3>
            <div class="form-field">
                <label>Nom</label>
                <input type="text" id="popupName" readonly>
            </div>
            <div class="form-field">
                <label>Téléphone</label>
                <input type="text" id="popupPhone" readonly>
            </div>
            <div class="form-field">
                <label>Wilaya</label>
                <input type="text" id="popupWilaya" readonly>
            </div>
            <div class="form-field">
                <label>Type de réclamation</label>
                <input type="text" id="popupComplaintType" readonly>
            </div>
            <div class="form-field">
                <label>Message</label>
                <textarea id="popupMessage" readonly rows="5"></textarea>
            </div>
            <div class="form-field">
                <label>Solution</label>
                <textarea id="popupSolution" readonly rows="3"></textarea>
            </div>
            <div class="form-field">
                <label>Statut</label>
                <input type="text" id="popupStatus" readonly>
            </div>
            <div class="form-field">
                <label>Date</label>
                <input type="text" id="popupDate" readonly>
            </div>
            <button class="close-btn" type="button" onclick="closePopups()">Fermer</button>
        </div>
    </main>

    <script>
        let lastSortedColumn = '';
        let sortDirection = {};

        document.addEventListener('DOMContentLoaded', () => {
            const rows = document.querySelectorAll('#reclamationTableBody tr');
            console.log('Number of table rows:', rows.length);
            if (rows.length === 0) {
                console.warn('No rows found in table body. Check $reclamations data or filterTable() logic.');
            }

            document.querySelectorAll('.alert .close').forEach(button => {
                button.addEventListener('click', () => {
                    button.parentElement.style.display = 'none';
                });
            });

            // Debug: Log form submission
            document.getElementById('markProcessedForm').addEventListener('submit', (e) => {
                console.log('Form submitted with action:', e.target.action);
            });
        });

        function toggleButtons() {
            const checkboxes = document.querySelectorAll('.reclamation-checkbox:checked');
            const markProcessedBtn = document.getElementById('markProcessedBtn');
            const markProcessedForm = document.getElementById('markProcessedForm');

            if (checkboxes.length === 1) {
                markProcessedBtn.classList.remove('btn-disabled');
                markProcessedBtn.disabled = false;
                markProcessedForm.action = `/admin/reclamations/${checkboxes[0].dataset.id}/mark-processed`;
                console.log('Form action set to:', markProcessedForm.action);
            } else {
                markProcessedBtn.classList.add('btn-disabled');
                markProcessedBtn.disabled = true;
                markProcessedForm.action = '';
                console.log('Form action cleared');
            }
        }

        function openReclamationPopup(name, phone, wilaya, complaint_type, message, solution, status, date) {
            document.getElementById('popupName').value = name;
            document.getElementById('popupPhone').value = phone;
            document.getElementById('popupWilaya').value = wilaya;
            document.getElementById('popupComplaintType').value = complaint_type;
            document.getElementById('popupMessage').value = message;
            document.getElementById('popupSolution').value = solution;
            document.getElementById('popupStatus').value = status;
            document.getElementById('popupDate').value = date;

            const popup = document.getElementById('reclamationPopup');
            const overlay = document.getElementById('popupOverlay');
            popup.style.display = 'block';
            overlay.style.display = 'block';
            setTimeout(() => {
                popup.classList.add('active');
                overlay.classList.add('active');
            }, 10);
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

        function sortTable(column) {
            const tbody = document.getElementById('reclamationTableBody');
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
                span.classList.remove('active-name', 'active-phone', 'active-wilaya', 'active-complaint_type', 'active-message', 'active-solution', 'active-status', 'active-date');
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
                } else if (column === 'phone') {
                    aValue = a.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
                } else if (column === 'wilaya') {
                    aValue = a.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                } else if (column === 'complaint_type') {
                    aValue = a.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();
                } else if (column === 'message') {
                    aValue = a.querySelector('td:nth-child(6)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(6)').textContent.trim().toLowerCase();
                } else if (column === 'solution') {
                    aValue = a.querySelector('td:nth-child(7)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(7)').textContent.trim().toLowerCase();
                } else if (column === 'status') {
                    aValue = a.querySelector('td:nth-child(8)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(8)').textContent.trim().toLowerCase();
                } else if (column === 'date') {
                    aValue = a.querySelector('td:nth-child(9)').textContent.trim();
                    bValue = b.querySelector('td:nth-child(9)').textContent.trim();
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
            const tbody = document.getElementById('reclamationTableBody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const filterName = document.getElementById('filterName').value.trim().toLowerCase();
            const filterPhone = document.getElementById('filterPhone').value.trim().toLowerCase();
            const filterWilaya = document.getElementById('filterWilaya').value.trim().toLowerCase();
            const filterComplaintType = document.getElementById('filterComplaintType').value.trim().toLowerCase();
            const filterMessage = document.getElementById('filterMessage').value.trim().toLowerCase();
            const filterSolution = document.getElementById('filterSolution').value.trim().toLowerCase();
            const filterStatus = document.getElementById('filterStatus').value.trim().toLowerCase();
            const filterDate = document.getElementById('filterDate').value.trim().toLowerCase();

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
                const phone = row.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
                const wilaya = row.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                const complaint_type = row.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();
                const message = row.querySelector('td:nth-child(6)').textContent.trim().toLowerCase();
                const solution = row.querySelector('td:nth-child(7)').textContent.trim().toLowerCase();
                const status = row.querySelector('td:nth-child(8)').textContent.trim().toLowerCase();
                const date = row.querySelector('td:nth-child(9)').textContent.trim().toLowerCase();

                let showRow = true;

                if (filterName && !name.includes(filterName)) {
                    showRow = false;
                }
                if (filterPhone && !phone.includes(filterPhone)) {
                    showRow = false;
                }
                if (filterWilaya && !wilaya.includes(filterWilaya)) {
                    showRow = false;
                }
                if (filterComplaintType && !complaint_type.includes(filterComplaintType)) {
                    showRow = false;
                }
                if (filterMessage && !message.includes(filterMessage)) {
                    showRow = false;
                }
                if (filterSolution && !solution.includes(filterSolution)) {
                    showRow = false;
                }
                if (filterStatus && (status !== filterStatus && (status === 'en attente' ? 'pending' : 'processed') !== filterStatus)) {
                    showRow = false;
                }
                if (filterDate && !date.includes(filterDate)) {
                    showRow = false;
                }

                row.style.display = showRow ? '' : 'none';
            });

            console.log('Visible rows after filtering:', rows.filter(row => row.style.display !== 'none').length);
        }
    </script>
</body>
</html>