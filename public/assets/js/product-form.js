

document.addEventListener('DOMContentLoaded', function() {
    const personnalisableSelect = document.getElementById('personnalisable');
    const categorieBlock = document.getElementById('personnalisable-categorie-block');
    const optionsBlock = document.getElementById('personnalisable-options');
    const imageUploadBlock = document.getElementById('personnalisable-image-upload');
    const categorieSelect = document.getElementById('categorie_option_personnalisation_id');

    const hiddenOptionInput = document.getElementById('option_personnalisation_id');
    const hiddenValeurInput = document.getElementById('valeur_option_id');

    function togglePersonnalisableBlocks() {
        if (personnalisableSelect.value === '1') {
            categorieBlock.style.display = 'block';
            optionsBlock.style.display = 'none';
            imageUploadBlock.style.display = 'none';
        } else {
            categorieBlock.style.display = 'none';
            optionsBlock.style.display = 'none';
            imageUploadBlock.style.display = 'none';
        }
    }

    function loadOptionsByCategorie() {
        const categorieId = categorieSelect.value;
        if (!categorieId) {
            optionsBlock.style.display = 'none';
            imageUploadBlock.style.display = 'none';
            optionsBlock.innerHTML = '';
            return;
        }

        optionsBlock.innerHTML = '<p>Chargement des options pour la catégorie sélectionnée...</p>';
        optionsBlock.style.display = 'block';
        imageUploadBlock.style.display = 'block';

        fetch(`/api/options-categorie/${categorieId}`, {
            headers: { 'Accept': 'application/json' }
        })
        .then(response => {
            if (!response.ok) throw new Error('Erreur réseau');
            return response.json();
        })
        .then(data => {
            let html = '';
            data.options.forEach(option => {
                // Conteneur principal avec data-option-personnalisation-id
                html += `<div class="option-block mb-3" data-option-personnalisation-id="${option.id}">`;
                html += `<label for="option_${option.id}">${option.nom_option}</label>`;
                html += `<select name="options[${option.id}]" id="option_${option.id}" class="form-select mb-2" data-option-personnalisation-id="${option.id}">`;
                html += `<option value="">-- Aucune valeur --</option>`;
                option.valeurs.forEach(valeur => {
                    html += `<option value="${valeur.id}">${valeur.valeur}</option>`;
                });
                html += `</select>`;

                option.sous_options.forEach(sousOpt => {
                    html += `<label for="sousoption_${sousOpt.id}">${sousOpt.nom_sous_option}</label>`;
                    // Ajout data-option-personnalisation-id parent pour monter cet id lors du changement
                    html += `<select name="sousoptions[${sousOpt.id}]" id="sousoption_${sousOpt.id}" class="form-select mb-2" data-option-personnalisation-id="${option.id}">`;
                    html += `<option value="">-- Aucune valeur --</option>`;
                    sousOpt.valeurs.forEach(valeur => {
                        html += `<option value="${valeur.id}">${valeur.valeur}</option>`;
                    });
                    html += `</select>`;
                });

                html += `</div>`;
            });
            optionsBlock.innerHTML = html;
        })
        .catch(error => {
            console.error('Erreur chargement options:', error);
            optionsBlock.innerHTML = '<p>Erreur lors du chargement des options.</p>';
        });
    }

    // Ecouteur pour mise à jour des inputs cachés
    optionsBlock.addEventListener('change', function(event) {
        if(event.target.tagName === 'SELECT') {
            // Récupérer l'id de l'option personnalisée soit sur le select,
            // soit sur le conteneur parent .option-block
            let optionPersoId = event.target.getAttribute('data-option-personnalisation-id');
            if(!optionPersoId) {
                const parent = event.target.closest('.option-block');
                if(parent) optionPersoId = parent.getAttribute('data-option-personnalisation-id');
            }
            const valeurOptionId = event.target.value;

            hiddenOptionInput.value = optionPersoId || '';
            hiddenValeurInput.value = valeurOptionId || '';
        }
    });

    personnalisableSelect.addEventListener('change', togglePersonnalisableBlocks);
    categorieSelect.addEventListener('change', loadOptionsByCategorie);

    // Initialisation au chargement
    togglePersonnalisableBlocks();
    loadOptionsByCategorie();
});
