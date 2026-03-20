<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestion des catégories</h1>

        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
            + Créer une catégorie
        </a>
    </div>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-striped table-hover align-middle">

                <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th width="350">Actions</th>
                </tr>
                </thead>

                <tbody>

                @foreach($categories as $category)

                    <tr>

                        <td>
                            <strong>{{ $category->name }}</strong>
                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                <!-- Modifier -->
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm">
                                    Modifier
                                </a>

                                <!-- Supprimer -->
                                <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" class="d-flex gap-2">
                                    @csrf
                                    @method('DELETE')

                                    <select name="transfer_category" class="form-select form-select-sm" required>

                                        @foreach($categories as $cat)

                                            @if($cat->id !== $category->id)

                                                <option value="{{ $cat->id }}">
                                                    Transférer vers : {{ $cat->name }}
                                                </option>

                                            @endif

                                        @endforeach

                                    </select>

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Supprimer
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>
