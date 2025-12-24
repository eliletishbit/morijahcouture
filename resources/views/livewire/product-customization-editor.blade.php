<div class="row p-4 g-4">
    <!-- Colonne valeurs personnalisations (gauche) -->
    <div class="col-md-5 border rounded p-3" style="max-height: 600px; overflow-y: auto;">
        <h5>Valeurs de personnalisation</h5>
        <div class="row row-cols-3 g-2">
            @forelse($values as $valeur)
                <div class="col text-center">
                    <label class="d-block cursor-pointer">
                        <input 
                            type="radio" 
                            wire:click="selectValue({{ $activeOptionId }}, {{ $valeur->id }})" 
                            name="option_{{ $activeOptionId }}" 
                            class="d-none" 
                            @if(isset($selectedValues[$activeOptionId]) && $selectedValues[$activeOptionId] == $valeur->id) checked @endif
                        />
                        <img src="{{ asset('storage/' . ($valeur->image ?? 'default_image.png')) }}" alt="{{ $valeur->valeur ?? 'Option' }}" class="img-thumbnail mb-1" style="height: 60px; object-fit: cover;">
                        <div>{{ $valeur->valeur }}</div>
                    </label>
                </div>
            @empty
                <p class="text-muted">Aucune valeur disponible.</p>
            @endforelse
        </div>
    </div>

    <!-- Colonne options verticales (centre) -->
    <div class="col-md-2 border rounded p-3 d-flex flex-column align-items-center" style="max-height: 600px; overflow-y: auto;">
        <h5 class="mb-3">Options</h5>
        @foreach($options as $option)
            <button 
                wire:click="changeOption({{ $option->id }})" 
                class="btn btn-outline-primary w-100 mb-2 d-flex align-items-center justify-content-start {{ $activeOptionId == $option->id ? 'active' : '' }}"
                style="gap: 0.5rem;"
            >
                <img src="{{ asset('storage/' . ($option->icone ?? 'default_icon.png')) }}" alt="{{ $option->nom_option }}" style="width: 30px; height: 30px; object-fit: contain;">
                <span>{{ $option->nom_option }}</span>
            </button>
        @endforeach
    </div>

    <!-- Colonne image personnalisée (droite) -->
    <div class="col-md-5 border rounded p-3 d-flex flex-column align-items-center justify-content-center">
        <h5>Image du produit personnalisée</h5>
        <img src="{{ asset('storage/' . ($currentImage ?? $product->image_produit)) }}" alt="Image personnalisée" class="img-fluid rounded" style="max-height: 450px; object-fit: contain;">
    </div>

    <!-- Bouton enregistrer, plein largeur sous les colonnes -->
    <div class="col-12 mt-3">
        <button wire:click="saveCustomizations" class="btn btn-success w-100">Enregistrer la personnalisation</button>
        <button wire:click="closeEditor" class="btn btn-secondary w-100 mt-2">Fermer</button>
    </div>
</div>
