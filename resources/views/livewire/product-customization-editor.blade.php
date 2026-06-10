
{{-- resources/views/livewire/product-customization-editor.blade.php --}}
<div style="min-height: 150vh; background: #f8f9fa;">
    <div class="container-fluid py-4">
        <div class="row g-4">
            <!-- COLONNE OPTIONS (col-md-2) -->
            <div class="col-md-2">
                <div class="card shadow-sm border-0 rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4 pb-2">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-palette me-2"></i>Options
                        </h5>
                    </div>
                    <div class="card-body pt-2">
                        <div class="d-flex flex-column gap-2">
                            @foreach($options as $option)
                                <button 
                                    wire:click="changeOption({{ $option->id }})"
                                    class="btn rounded-3 d-flex align-items-center justify-content-between {{ $activeOptionId == $option->id ? 'btn-primary shadow-sm' : 'btn-outline-secondary bg-white' }}"
                                    style="padding: 12px 16px; transition: all 0.2s;">
                                    <span class="fw-medium">
                                        @if($option->icone)
                                            <img src="{{ asset('storage/' . $option->icone) }}" style="width: 24px; height: 24px; margin-right: 10px;">
                                        @endif
                                        {{ $option->nom_option }}
                                    </span>
                                    @if(isset($selectedValues[$option->id]))
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLONNE VALEURS (col-md-4) -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4 pb-2">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-grid-3x3-gap-fill me-2"></i>

                            {{--  --}}
                            
                            {{ $options->firstWhere('id', $activeOptionId)?->nom_option }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @forelse($currentValues as $valeur)
                                <div class="col-md-6 col-lg-4">
                                    <label style="cursor: pointer;">
                                        <input type="radio" 
                                               wire:click="selectValue({{ $activeOptionId }}, {{ $valeur->id }})"
                                               name="option_values"
                                               class="d-none">
                                        <div class="value-card text-center p-3 rounded-3 {{ isset($selectedValues[$activeOptionId]) && $selectedValues[$activeOptionId] == $valeur->id ? 'selected border-primary bg-primary-soft' : 'border bg-white' }}"
                                             style="transition: all 0.2s; cursor: pointer;">
                                            @if($valeur->image)
                                                <img src="{{ asset('storage/' . $valeur->image) }}" 
                                                     class="rounded-2 mb-2"
                                                     style="width: 70px; height: 70px; object-fit: cover;">
                                            @else
                                                <div class="rounded-2 mb-2 bg-light d-flex align-items-center justify-content-center"
                                                     style="width: 70px; height: 70px; margin: 0 auto;">
                                                    <i class="bi bi-image fs-1 text-muted"></i>
                                                </div>
                                            @endif
                                            <div class="fw-semibold small">{{ $valeur->valeur }}</div>
                                            @if($valeur->prix_supplementaire > 0)
                                                <small class="text-success fw-bold">+{{ number_format($valeur->prix_supplementaire, 0) }}€</small>
                                            @endif
                                        </div>
                                    </label>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <i class="bi bi-emoji-frown fs-1 text-muted"></i>
                                    <p class="text-muted mt-2">Aucune valeur disponible</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLONNE APERÇU (col-md-6) -->
           <!-- COLONNE APERÇU (col-md-6) -->
<div class="col-md-6">
    <div class="card shadow-sm border-0 rounded-4 h-100">
        <div class="card-header bg-white border-0 pt-4 pb-2">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-eye me-2"></i>Aperçu personnalisé
            </h5>
        </div>
        <div class="card-body d-flex flex-column">
            <div class="preview-container text-center mb-3" 
                 style="background: #f5f5f5; border-radius: 16px; min-height: 80vh; display: flex; align-items: center; justify-content: center;">
                
                {{-- Une seule image : l'image actuelle (neutre ou personnalisée) --}}
                <img src="{{ asset('storage/' . $currentImage) }}"  
                     id="preview-image"
                     class="img-fluid rounded-3"
                     style="max-width: 85%; max-height: 70vh; object-fit: contain;">
            </div>

            <div class="mt-auto pt-3">
                <div class="price-summary mb-3 p-3 bg-light rounded-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Prix de base :</span>
                        <span class="fw-bold">{{ number_format($product->prix_base, 0, ',', ' ') }} €</span>
                    </div>

                    @php
                        $supplementTotal = 0;
                        foreach($selectedValues as $optionId => $valueId) {
                            $valeur = \App\Models\ValeurOption::find($valueId);
                            if ($valeur && $valeur->prix) {
                                $supplementTotal += $valeur->prix;
                            }
                        }
                    @endphp

                    @if($supplementTotal > 0)
                        <div class="d-flex justify-content-between mb-2">
                            <span>Suppléments :</span>
                            <span class="text-success fw-bold">+ {{ number_format($supplementTotal, 0, ',', ' ') }} €</span>
                        </div>
                        <hr class="my-2">
                    @endif

                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Total :</span>
                        <span class="fw-bold fs-5 text-primary">{{ number_format($product->prix_base + $supplementTotal, 0, ',', ' ') }} €</span>
                    </div>
                </div>

                <button type="button" wire:click="saveCustomizations" class="btn btn-dark w-100 py-2 fw-semibold">
                    <i class="bi bi-check-circle me-2"></i> Personnaliser et continuer
                </button>
            </div>
        </div>
    </div>
</div>
            
        </div>
    </div>
    
    <style>
        .value-card {
            transition: all 0.2s ease-in-out;
        }
        .value-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .value-card.selected {
            border: 2px solid #0d6efd;
            background-color: rgba(13, 110, 253, 0.05);
        }
        .preview-container {
            background: #f0f0f0;
            background-image: radial-gradient(circle at 25% 40%, rgba(255,255,255,0.8) 2%, transparent 2.5%);
            background-size: 20px 20px;
        }
        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }
        .btn-primary {
            transform: translateX(5px);
        }
        .cursor-pointer {
            cursor: pointer;
        }
    </style>
</div>
