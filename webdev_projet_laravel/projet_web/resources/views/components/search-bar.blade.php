<form action="{{ route('user.index') }}" method="GET" class="mb-4">
    <input type="text" name="search" value="{{ $query ?? '' }}" placeholder="Rechercher un provider..." class="border p-2 rounded w-1/3">
    <button type="submit" class="bg-blue-500 text-white p-2 rounded">Rechercher</button>
</form>
