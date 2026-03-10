
    <h2>Nos catégories</h2>
    @forelse($categories as $category)
        <div class="category-item">
            <a href="{{ route('categories.show', $category->id) }}">
                <h3>{{ $category->name }}</h3>
            </a>
            @if($category->is_highlighted)
                <span class="badge">Catégorie mise en avant</span>
            @endif
        </div>
    @empty
        <p>Aucune catégorie disponible.</p>
    @endforelse

