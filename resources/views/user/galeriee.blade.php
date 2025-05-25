<style>
    .specialties-container {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        padding: 40px 20px;
        max-width: 1280px;
        margin: 0 auto;
        background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    }
    .specialty-section {
        margin-bottom: 60px;
        border-radius: 12px;
        padding: 20px;
        background: #fff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    .specialty-section h2 {
        font-size: 32px;
        color: #1a1a1a;
        margin: 0 0 30px;
        font-weight: 400;
        text-transform: capitalize;
        position: relative;
        padding-bottom: 12px;
        background: linear-gradient(to left, #0d1b2a, #265b94);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    .specialty-section h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 3px;
        background: linear-gradient(to left, #0d1b2a, #265b94);
        border-radius: 2px;
    }
    .photos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        padding: 10px;
    }
    .photo-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        background: #fff;
        position: relative;
    }
    .photo-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 12px 24px rgba(35, 182, 234, 0.3);
    }
    .photo-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease;
    }
    .photo-card:hover img {
        transform: scale(1.05);
    }
    .photo-card p {
        font-size: 15px;
        color: #333;
        margin: 15px;
        line-height: 1.5;
        text-align: center;
        max-height: 70px;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 400;
    }
    .photo-popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        animation: fadeIn 0.3s ease;
    }
    .photo-popup.active {
        display: flex;
    }
    .photo-popup img {
        max-width: 90%;
        max-height: 75vh;
        object-fit: contain;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        animation: scaleIn 0.3s ease;
    }
    .photo-popup .description-container {
        background: rgba(255, 255, 255, 0.95);
        max-width: 80%;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        margin: 0 20px;
        transition: transform 0.3s ease;
    }
    .photo-popup .description-container p {
        color: #1a1a1a;
        font-size: 17px;
        text-align: center;
        margin: 0;
        line-height: 1.7;
        font-weight: 400;
    }
    .photo-popup .close-popup {
        position: absolute;
        top: 20px;
        right: 30px;
        color: #fff;
        font-size: 40px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .photo-popup .close-popup:hover {
        color: #23B6EA;
        transform: rotate(90deg);
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes scaleIn {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    @media (max-width: 768px) {
        .specialties-container {
            padding: 20px 10px;
        }
        .specialty-section {
            padding: 15px;
        }
        .specialty-section h2 {
            font-size: 26px;
            margin-bottom: 20px;
        }
        .photos-grid {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 15px;
            padding: 8px;
        }
        .photo-card img {
            height: 140px;
        }
        .photo-card p {
            font-size: 14px;
            max-height: 60px;
            margin: 12px;
        }
        .photo-popup img {
            max-width: 95%;
            max-height: 65vh;
        }
        .photo-popup .description-container {
            max-width: 90%;
            padding: 15px;
        }
        .photo-popup .description-container p {
            font-size: 15px;
        }
        .photo-popup .close-popup {
            font-size: 32px;
            top: 15px;
            right: 20px;
        }
    }
    @media (max-width: 480px) {
        .photos-grid {
            grid-template-columns: 1fr;
        }
        .photo-card img {
            height: 160px;
        }
        .photo-popup .description-container p {
            font-size: 14px;
        }
    }
</style>
<body>
    

<div class="specialties-container">
    @if (isset($specialties) && is_array($specialties))
        @foreach ($specialties as $specialty)
            @php
                $photos = collect($pics ?? [])->filter(function ($pic) use ($specialty) {
                    return isset($pic['type']) && $pic['type'] === $specialty['original'];
                })->values()->toArray();
            @endphp
            @if (!empty($photos))
                <div class="specialty-section" id="section-{{ $specialty['sanitized'] }}">
                    <h2>{{ $specialty['original'] }} :</h2>
                    <div class="photos-grid">
                        @foreach ($photos as $index => $pic)
                            <div class="photo-card" data-specialty="{{ $specialty['sanitized'] }}" data-index="{{ $index }}">
                                <img src="{{ asset($pic['image'] ?? 'assets/img/placeholder.jpg') }}" alt="{{ $pic['type'] ?? 'Image' }}" data-src="{{ asset($pic['image'] ?? 'assets/img/placeholder.jpg') }}">
                                <p>{{ $pic['description'] ?? 'No description available' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <p>No specialties available.</p>
    @endif
</div>

<div class="photo-popup" id="photo-popup">
    <span class="close-popup" onclick="closePopup()">×</span>
    <img src="" alt="Popup Image" id="popup-image">
    <div class="description-container">
        <p id="popup-description"></p>
    </div>
</div>

<script>
    function openPopup(sanitizedSpecialty, index) {
        const popup = document.getElementById('photo-popup');
        const popupImage = document.getElementById('popup-image');
        const popupDescription = document.getElementById('popup-description');
        const photoCard = document.querySelector(`.photo-card[data-specialty="${sanitizedSpecialty}"][data-index="${index}"]`);
        
        if (photoCard) {
            const img = photoCard.querySelector('img');
            const imgSrc = img.getAttribute('data-src') || img.src;
            const description = photoCard.querySelector('p').textContent;

            popupImage.src = ''; // Reset to avoid caching
            popupImage.src = imgSrc;
            popupDescription.textContent = description;
            popup.classList.add('active');

            // Handle image load errors
            popupImage.onerror = () => {
                console.error('Failed to load image:', imgSrc);
                popupDescription.textContent = 'Error loading image';
            };
            popupImage.onload = () => {
                console.log('Image loaded successfully:', imgSrc);
            };
        } else {
            console.error('Photo card not found for specialty:', sanitizedSpecialty, 'index:', index);
        }
    }

    function closePopup() {
        const popup = document.getElementById('photo-popup');
        popup.classList.remove('active');
        document.getElementById('popup-image').src = '';
        document.getElementById('popup-description').textContent = '';
    }

    // Add event listeners to photo cards
    document.querySelectorAll('.photo-card').forEach(card => {
        card.addEventListener('click', () => {
            const sanitizedSpecialty = card.getAttribute('data-specialty');
            const index = card.getAttribute('data-index');
            openPopup(sanitizedSpecialty, index);
        });
    });
</script></body>