<h1>Gestion des catégories</h1>

<a href="{{ route('admin.categories.create') }}">Créer une catégorie</a>

<table border="1">

    <tr>
        <th>Nom</th>
        <th>Actions</th>
    </tr>

    @foreach($categories as $category)

        <div>

            <strong>{{ $category->name }}</strong>

            <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}">
                @csrf
                @method('DELETE')

                <select name="transfer_category" required>

                    @foreach($categories as $cat)

                        @if($cat->id !== $category->id)

                            <option value="{{ $cat->id }}">
                                {{ $cat->name }}
                            </option>

                        @endif

                    @endforeach

                </select>

                <button type="submit">
                    Supprimer
                </button>

            </form>

        </div>

    @endforeach

</table>
