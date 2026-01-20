@if ($items->lastPage() > 1)
    <nav class="mt-6 flex items-center gap-2 flex-wrap">

        {{-- Première --}}
        <a href="{{ $items->url(1) }}"
           class="px-3 py-1 border rounded {{ $items->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}">
            ⏮
        </a>

        {{-- Précédent --}}
        <a href="{{ $items->previousPageUrl() }}"
           class="px-3 py-1 border rounded {{ $items->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}">
            ◀
        </a>

        {{-- Numéros --}}
        @for ($page = 1; $page <= $items->lastPage(); $page++)
            <a href="{{ $items->url($page) }}"
               class="px-3 py-1 border rounded
               {{ $page === $items->currentPage() ? 'bg-blue-500 text-white font-bold' : '' }}">
                {{ $page }}
            </a>
        @endfor

        {{-- Suivant --}}
        <a href="{{ $items->nextPageUrl() }}"
           class="px-3 py-1 border rounded {{ $items->currentPage() === $items->lastPage() ? 'opacity-50 pointer-events-none' : '' }}">
            ▶
        </a>

        {{-- Dernière --}}
        <a href="{{ $items->url($items->lastPage()) }}"
           class="px-3 py-1 border rounded {{ $items->currentPage() === $items->lastPage() ? 'opacity-50 pointer-events-none' : '' }}">
            ⏭
        </a>

    </nav>
@endif
