<link rel="stylesheet" href="../assets/css/convention.css">
<style>
.prev.qu-prev, .next.qu-next {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
<center>
    <div class="section-title mt-4">
        <h2>Organismes conventionnés :</h2>
        <img src="../assets/img/section-img.png" alt="#" />
    </div>
</center>
<div class="container">
    <div class="schedule-inner">
        <div class="swiper conv-slider">
            <button class="prev qu-prev"><i class="fas fa-angle-left"></i></button>
            <div class="swiper-wrapper">
                @forelse ($organisms as $index => $organism)
                    <div class="swiper-slide">
                        <div class="single-schedule {{ $index == 0 ? 'first' : 'middle' }} mx-2">
                            <div class="single-clients wow fadeIn" data-wow-delay="{{ 0.2 + ($index * 0.2) }}s">
                                <img src="{{ asset('storage/' . $organism->logo) }}" class="img-fluid" alt="{{ $organism->name }}" />
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <div class="single-schedule middle mx-2">
                            <div class="single-clients wow fadeIn" data-wow-delay="0.2s">
                                <p>Aucun organisme conventionné disponible.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <button class="next qu-next"><i class="fas fa-angle-right"></i></button>
        </div>
    </div>
</div>

<script src="../assets/js/conv.js"></script>