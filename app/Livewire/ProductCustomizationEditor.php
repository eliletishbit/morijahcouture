<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produit;
use App\Models\ValeurOption;

class ProductCustomizationEditor extends Component
{
    public Produit $product;
    public $options;
    public $activeOptionId;
    public $searchTerm = '';
    public $selectedValues = []; 
    public $currentImage;
    public $showEditor = false;

    public function mount(Produit $product)
    {
        $this->product = $product;
        $this->options = $product->optionsPersonnalisation()->with('sousOptions.valeurs', 'valeurs')->get();
        $this->activeOptionId = $this->options->first()->id ?? null;
        $this->currentImage = $product->image_principale;
    }

    public function closeEditor()
    {
        $this->showEditor = false;
    }

    public function changeOption($optionId)
    {
        $this->activeOptionId = $optionId;
        $this->searchTerm = '';
    }

    public function selectValue($optionId, $valueId)
    {
        $this->selectedValues[$optionId] = $valueId;
        $valeur = ValeurOption::find($valueId);
        $this->currentImage = $valeur && $valeur->image ? $valeur->image : $this->product->image_produit;
    }

    public function saveCustomizations()
    {
        session(['customizations' => $this->selectedValues]);
        $this->showEditor = false;
        // eventuellement redirection ou message
    }

    public function getFilteredValuesProperty()
    {
        $option = $this->options->firstWhere('id', $this->activeOptionId);
        if (!$option) return collect();

        $valeurs = $option->valeurs->merge($option->sousOptions->flatMap->valeurs);

        if ($this->searchTerm) {
            return $valeurs->filter(fn($val) => stripos($val->valeur, $this->searchTerm) !== false);
        }
        return $valeurs;
    }

    public function render()
    {
        return view('livewire.product-customization-editor', [
            'values' => $this->filteredValues,
        ])->layout('layouts.livewirecustomizationeditor');
    }
}
