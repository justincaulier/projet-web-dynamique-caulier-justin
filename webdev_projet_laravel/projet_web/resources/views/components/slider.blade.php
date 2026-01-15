<div class="slider-container mb-6 relative w-full h-64 md:h-80 lg:h-96 overflow-hidden rounded">
    @foreach($images as $img)
        <div class="slide w-full h-full">
            <img src="{{ asset('images/' . $img) }}" alt="Slider image" class="w-full h-full object-cover rounded">
        </div>
    @endforeach
</div>

<script>
    let slideIndex = 0;
    function showSlides() {
        const slides = document.querySelectorAll('.slide');
        slides.forEach(slide => slide.style.display = 'none');
        slideIndex++;
        if(slideIndex > slides.length) slideIndex = 1;
        slides[slideIndex-1].style.display = 'block';
        setTimeout(showSlides, 3000);
    }
    document.addEventListener('DOMContentLoaded', showSlides);
</script>
