<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Produit;
use App\Models\OptionPersonnalisation;  // Vos options
use App\Models\ValeurOption;

class ProductCustomizationEditor extends Component
{
    public Produit $product;
    public $categorieOption;      // Catégorie "Vêtement"
    public $options;               // Options ["Tissu", "Couleur", "Taille"]
    public $activeOptionId;        // Option actuellement sélectionnée (ex: Tissu)
    public $selectedValues = [];   // [tissu_id => batik_id, couleur_id => rouge_id]
    public $currentImage;
    
    public function mount(Produit $product)
    {
        $this->product = $product;
        
        // 1. Récupérer la catégorie d'option via la sous-catégorie
        $this->categorieOption = $this->product->sousCategorie->categorieOptionPersonnalisation;
        // dd($this->categorieOption);
        if (!$this->categorieOption) {
            session()->flash('error', 'Ce produit n\'a pas de personnalisation');
            return redirect()->route('products.show', $product);
        }
        
        // 2. Récupérer TOUTES les options de cette catégorie (Tissu, Couleur, Taille...)
        $this->options = OptionPersonnalisation::where('categorie_option_personnalisation_id', $this->categorieOption->id)
            ->with('valeurs')  // Charge les valeurs (Batik, Coton...)
            ->get();
        
        // 3. Sélectionner la première option par défaut (ex: Tissu)
        $this->activeOptionId = $this->options->first()->id ?? null;
        
           // Au chargement : image_modele du produit (pas l'image_produit)
    $this->currentImage = $this->product->image_modele_neutre ?? $this->product->image_produit;
    }
    
    public function changeOption($optionId)
    {
        $this->activeOptionId = $optionId;
    }
    
    public function selectValue($optionId, $valueId)
    {
        $this->selectedValues[$optionId] = $valueId;
        
        // Changer l'aperçu image si la valeur a une image
        $valeur = ValeurOption::find($valueId);
        if ($valeur && $valeur->image_calque) {
            $this->currentImage = $valeur->image_calque;
        }
    }
    
    public function saveCustomizations()
    {
        session()->put('personnalisation_' . $this->product->id, $this->selectedValues);
        
        
        return redirect()->route('mesures.index', $this->product->id)
        ->with('success', 'Personnalisation enregistrée. Renseignez vos mesures.');
    }
    
    public function getCurrentOptionValues()
    {
        $option = $this->options->firstWhere('id', $this->activeOptionId);
        return $option ? $option->valeurs : collect();
    }

    // Définir le layout en propriété (méthode Livewire v3)
    public function layout()
    {
        return 'layouts.frontendapp';
    }
    
    public function render()
    {
        return view('livewire.product-customization-editor', [
            'currentValues' => $this->getCurrentOptionValues()
        ]);
    }
}