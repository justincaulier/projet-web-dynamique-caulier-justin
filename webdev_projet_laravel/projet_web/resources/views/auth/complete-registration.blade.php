<h2>Complétez votre inscription</h2>

<form method="POST"
      action="{{ url('/complete-registration/' . $user->id) }}"
      enctype="multipart/form-data">
    @csrf

    <label>Nom :</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

    <label>Prénom :</label>
    <input type="text" name="surname" value="{{ old('surname', $user->surname) }}" required>

    <label>Email :</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

    <!-- Checkbox prestataire -->
    <div>
        <input type="checkbox" id="is_provider" name="is_provider" value="1"
               @if(old('is_provider') || $user->role === 'PROVIDER') checked @endif>
        <label for="is_provider">Je suis un prestataire</label>
    </div>

    <!-- Champs supplémentaires pour prestataires -->
    <div id="provider_fields" style="display: none; margin-top: 15px;">
        <label>Description :</label>
        <textarea name="description">{{ old('description', $user->description) }}</textarea>

        <label>Photo ou logo :</label>
        <input type="file" name="photo">

        <label>Adresse :</label>
        <input type="text" name="address" value="{{ old('address', $user->address) }}">

        <label>Numéro de TVA :</label>
        <input type="text" name="tva" value="{{ old('tva', $user->tva) }}">

        <label>Lien site :</label>
        <input type="url" name="website" value="{{ old('website', $user->website) }}">

        <label>Téléphone :</label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">

        <h3>Stages :</h3>
        <div id="stages-container">
            <div class="stage">
                <label>Description :</label>
                <input type="text" name="stages[0][description]">
                <label>Tarif :</label>
                <input type="number" name="stages[0][price]" step="0.01">
                <label>Date début :</label>
                <input type="date" name="stages[0][start_date]">
                <label>Date fin :</label>
                <input type="date" name="stages[0][end_date]">
                <label>Informations complémentaires :</label>
                <textarea name="stages[0][info]"></textarea>
            </div>
        </div>

        <h3>Promotions :</h3>
        <div id="promotions-container">
            <input type="text" name="promotions[0]" placeholder="Ex: -10% massage">
        </div>
    </div>
    <button type="submit">Finaliser</button>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('is_provider');
        const providerFields = document.getElementById('provider_fields');

        // Afficher si déjà coché (reload)
        if (checkbox.checked) {
            providerFields.style.display = 'block';
        }

        // Toggle au clic
        checkbox.addEventListener('change', function () {
            providerFields.style.display = this.checked ? 'block' : 'none';
        });
    });
</script>
