<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualités - EHP-HASNAOUI</title>
    <link rel="stylesheet" href="{{ asset('assets/css/actualites.css') }}">
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
        }
        .modal-content img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .modal-content h2 {
            font-size: 1.8em;
            color: #333;
            margin: 10px 0;
        }
        .modal-content .date {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        .modal-content p {
            color: #444;
            line-height: 1.6;
        }
        .close-modal {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.2em;
            cursor: pointer;
            color: #333;
            background: #ddd;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .close-modal:hover {
            background: #ccc;
        }
    </style>
</head>
<body>
    <section class="blog section" id="blog">
        <div class="container">
            <div class="row" id="blog-posts">
                @forelse($acts->where('is_active', true) as $act)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="single-news">
                            <div class="news-head">
                                <img src="{{ $act->image ? asset($act->image) : asset('assets/img/placeholder.jpg') }}" alt="{{ $act->titre }}">
                            </div>
                            <div class="news-body">
                                <div class="news-content">
                                    <div class="date">{{ $act->date_ajout ? \Carbon\Carbon::parse($act->date_ajout)->format('d/m/Y') : 'Non défini' }}</div>
                                    <h2><a href="#" onclick="openModal({{ $act->id }})">{{ $act->titre }}</a></h2>
                                    <p class="text" style="color: #9499A2;">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($act->description), 170) }}...
                                    </p>
                                    <a href="#" class="buttonn" onclick="openModal({{ $act->id }})">Lire la suite</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Aucune actualité disponible.</p>
                @endforelse
            </div>
        </div>
    </section>

    <div id="blogModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">×</span>
            <div id="modal-content"></div>
        </div>
    </div>

    <script>
        function openModal(id) {
            console.log('Fetching actualite with ID:', id);
            fetch(`{{ url('/actualites') }}/${id}`)
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) throw new Error(`Erreur HTTP: ${response.status}`);
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    document.getElementById('modal-content').innerHTML = `
                        ${data.image ? `<img src="${data.image}" alt="${data.titre}">` : ''}
                        <div class="date">${data.date}</div>
                        <h2>${data.titre}</h2>
                        <p>${data.description}</p>
                    `;
                    document.getElementById('blogModal').style.display = 'flex';
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Impossible de charger l\'actualité: ' + error.message);
                });
        }

        function closeModal() {
            document.getElementById('blogModal').style.display = 'none';
            document.getElementById('modal-content').innerHTML = '';
        }

        window.onclick = function(event) {
            if (event.target === document.getElementById('blogModal')) {
                closeModal();
            }
        };
    </script>
</body>
</html>