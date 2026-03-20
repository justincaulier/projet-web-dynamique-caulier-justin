<div id="mainCarousel" class="carousel slide mb-4" data-bs-ride="carousel">

    {{-- Indicateurs --}}
    <div class="carousel-indicators">
        @foreach($images as $index => $image)
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $index }}"
                    @if($index === 0) class="active" aria-current="true" @endif
                    aria-label="Slide {{ $index + 1 }}"></button>
        @endforeach
    </div>

    {{-- Slides --}}
    <div class="carousel-inner">
        @foreach($images as $index => $image)
            <div class="carousel-item @if($index === 0) active @endif">
                <img src="{{ asset('storage/sliders/' . $image) }}" class="d-block w-100 carousel-img" alt="Slide {{ $index + 1 }}">
            </div>
        @endforeach
    </div>

    {{-- Contrôles --}}
    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Précédent</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Suivant</span>
    </button>
</div>
