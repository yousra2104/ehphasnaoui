<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EHP-HASNAOUI - Messages de Contact</title>
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
            display: table; /* Ensure table is visible */
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
        th:nth-child(2), td:nth-child(2) { width: 20%; } /* Name */
        th:nth-child(3), td:nth-child(3) { width: 20%; } /* Email */
        th:nth-child(4), td:nth-child(4) { width: 15%; } /* Phone */
        th:nth-child(5), td:nth-child(5) { width: 20%; } /* Subject */
        th:nth-child(6), td:nth-child(6) { width: 10%; } /* Status */
        th:nth-child(7), td:nth-child(7) { width: 10%; } /* Date */
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
        .header-text.active-name, .header-text.active-email, .header-text.active-phone, .header-text.active-subject, .header-text.active-status, .header-text.active-date {
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

                    <div class="act-list">
                        <form id="markProcessedForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="action-buttons">
                                <button id="markProcessedBtn" type="submit" form="markProcessedForm" class="btn-disabled" disabled>Marquer comme traité</button>
                                <!-- Percentage of Processed Messages -->
                                <div class="percentage-display">
                                    @if(isset($messages) && $messages->isNotEmpty())
                                        @php
                                            $totalMessages = $messages->count();
                                            $processedMessages = $messages->where('status', 'processed')->count();
                                            $percentage = $totalMessages > 0 ? round(($processedMessages / $totalMessages) * 100, 2) : 0;
                                        @endphp
                                        Pourcentage de demandes traitées : {{ $percentage }}%
                                    @else
                                        Pourcentage de demandes traitées : 0%
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
                                        <th onclick="sortTable('email')" style="cursor: pointer;">
                                            <span class="header-text">Email</span> <span id="sort-email"></span>
                                        </th>
                                        <th onclick="sortTable('phone')" style="cursor: pointer;">
                                            <span class="header-text">Téléphone</span> <span id="sort-phone"></span>
                                        </th>
                                        <th onclick="sortTable('subject')" style="cursor: pointer;">
                                            <span class="header-text">Sujet</span> <span id="sort-subject"></span>
                                        </th>
                                        <th onclick="sortTable('status')" style="cursor: pointer;">
                                            <span class="header-text">Statut</span> <span id="sort-status"></span>
                                        </th>
                                        <th onclick="sortTable('date')" style="cursor: pointer;">
                                            <span class="header-text">Date</span> <span id="sort-date"></span>
                                        </th>
                                    </tr>
                                    <tr class="filter-row">
                                        <th></th> <!-- Spacer -->
                                        <th><input type="text" id="filterName" placeholder="Filtrer nom..." oninput="filterTable()"></th>
                                        <th><input type="text" id="filterEmail" placeholder="Filtrer email..." oninput="filterTable()"></th>
                                        <th><input type="text" id="filterPhone" placeholder="Filtrer téléphone..." oninput="filterTable()"></th>
                                        <th><input type="text" id="filterSubject" placeholder="Filtrer sujet..." oninput="filterTable()"></th>
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
                                <tbody id="actTableBody">
                                    @if(isset($messages) && $messages->isNotEmpty())
                                        @foreach($messages as $message)
                                            <tr>
                                                <td><input type="checkbox" class="act-checkbox" data-id="{{ $message->id }}" onchange="toggleButtons()"></td>
                                                <td>
                                                    <a href="#" onclick="openMessagePopup('{{ $message->name }}', '{{ $message->email }}', '{{ $message->phone }}', '{{ $message->subject }}', '{{ $message->message }}')">
                                                        {{ $message->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $message->email }}</td>
                                                <td>{{ $message->phone }}</td>
                                                <td>{{ $message->subject }}</td>
                                                <td>{{ $message->status === 'pending' ? 'En attente' : 'Traité' }}</td>
                                                <td>{{ $message->created_at ? \Carbon\Carbon::parse($message->created_at)->format('d/m/Y') : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="7">Aucun message trouvé.</td></tr>
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

        <!-- Message Details Popup -->
        <div class="popup" id="messagePopup">
            <h3>Détails du message</h3>
            <div class="form-field">
                <label>Nom</label>
                <input type="text" id="popupName" readonly>
            </div>
            <div class="form-field">
                <label>Email</label>
                <input type="text" id="popupEmail" readonly>
            </div>
            <div class="form-field">
                <label>Téléphone</label>
                <input type="text" id="popupPhone" readonly>
            </div>
            <div class="form-field">
                <label>Sujet</label>
                <input type="text" id="popupSubject" readonly>
            </div>
            <div class="form-field">
                <label>Message</label>
                <textarea id="popupMessage" readonly rows="5"></textarea>
            </div>
            <button class="close-btn" type="button" onclick="closePopups()">Fermer</button>
        </div>
    </main>

    <script>
        let lastSortedColumn = '';
        let sortDirection = {};

        // Debug: Log the number of rows in the table body
        document.addEventListener('DOMContentLoaded', () => {
            const rows = document.querySelectorAll('#actTableBody tr');
            console.log('Number of table rows:', rows.length);
            if (rows.length === 0) {
                console.warn('No rows found in table body. Check $messages data or filterTable() logic.');
            }
        });

        // Handle alert close button
        document.querySelectorAll('.alert .close').forEach(button => {
            button.addEventListener('click', () => {
                button.parentElement.style.display = 'none';
            });
        });

        function toggleButtons() {
            const checkboxes = document.querySelectorAll('.act-checkbox:checked');
            const markProcessedBtn = document.getElementById('markProcessedBtn');
            const markProcessedForm = document.getElementById('markProcessedForm');

            if (checkboxes.length === 1) {
                markProcessedBtn.classList.remove('btn-disabled');
                markProcessedBtn.disabled = false;
                markProcessedForm.action = `/admin/contact-messages/${checkboxes[0].dataset.id}/mark-processed`;
            } else {
                markProcessedBtn.classList.add('btn-disabled');
                markProcessedBtn.disabled = true;
                markProcessedForm.action = '';
            }
        }

        function openMessagePopup(name, email, phone, subject, message) {
            document.getElementById('popupName').value = name;
            document.getElementById('popupEmail').value = email;
            document.getElementById('popupPhone').value = phone;
            document.getElementById('popupSubject').value = subject;
            document.getElementById('popupMessage').value = message;

            const popup = document.getElementById('messagePopup');
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
                span.classList.remove('active-name', 'active-email', 'active-phone', 'active-subject', 'active-status', 'active-date');
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
                } else if (column === 'email') {
                    aValue = a.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
                } else if (column === 'phone') {
                    aValue = a.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                } else if (column === 'subject') {
                    aValue = a.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();
                } else if (column === 'status') {
                    aValue = a.querySelector('td:nth-child(6)').textContent.trim().toLowerCase();
                    bValue = b.querySelector('td:nth-child(6)').textContent.trim().toLowerCase();
                } else if (column === 'date') {
                    aValue = a.querySelector('td:nth-child(7)').textContent.trim();
                    bValue = b.querySelector('td:nth-child(7)').textContent.trim();
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
            const filterName = document.getElementById('filterName').value.trim().toLowerCase();
            const filterEmail = document.getElementById('filterEmail').value.trim().toLowerCase();
            const filterPhone = document.getElementById('filterPhone').value.trim().toLowerCase();
            const filterSubject = document.getElementById('filterSubject').value.trim().toLowerCase();
            const filterStatus = document.getElementById('filterStatus').value.trim().toLowerCase();
            const filterDate = document.getElementById('filterDate').value.trim().toLowerCase();

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
                const email = row.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
                const phone = row.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                const subject = row.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();
                const status = row.querySelector('td:nth-child(6)').textContent.trim().toLowerCase();
                const date = row.querySelector('td:nth-child(7)').textContent.trim().toLowerCase();

                let showRow = true;

                if (filterName && !name.includes(filterName)) {
                    showRow = false;
                }
                if (filterEmail && !email.includes(filterEmail)) {
                    showRow = false;
                }
                if (filterPhone && !phone.includes(filterPhone)) {
                    showRow = false;
                }
                if (filterSubject && !subject.includes(filterSubject)) {
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

            // Debug: Log visible rows after filtering
            const visibleRows = rows.filter(row => row.style.display !== 'none');
            console.log('Visible rows after filtering:', visibleRows.length);
        }
    </script>
</body>
</html>