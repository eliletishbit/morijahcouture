 ancien code js pour la creation produit personnalisable

 // document.addEventListener('DOMContentLoaded', function() {
//     const personnalisableSelect = document.getElementById('personnalisable');
//     const categorieBlock = document.getElementById('personnalisable-categorie-block');
//     const optionsBlock = document.getElementById('personnalisable-options');
//     const imageUploadBlock = document.getElementById('personnalisable-image-upload');
//     const categorieSelect = document.getElementById('categorie_option_personnalisation_id');

//     function togglePersonnalisableBlocks() {
//         if (personnalisableSelect.value === '1') {
//             categorieBlock.style.display = 'block';
//             optionsBlock.style.display = 'none';
//             imageUploadBlock.style.display = 'none';
//         } else {
//             categorieBlock.style.display = 'none';
//             optionsBlock.style.display = 'none';
//             imageUploadBlock.style.display = 'none';
//         }
//     }

//     function loadOptionsByCategorie() {
//         const categorieId = categorieSelect.value;
//         if (!categorieId) {
//             optionsBlock.style.display = 'none';
//             imageUploadBlock.style.display = 'none';
//             optionsBlock.innerHTML = '';
//             return;
//         }

//         optionsBlock.innerHTML = '<p>Chargement des options pour la catégorie sélectionnée...</p>';
//         optionsBlock.style.display = 'block';
//         imageUploadBlock.style.display = 'block';

//         fetch(`/api/options-categorie/${categorieId}`, {
//             headers: {
//                 'Accept': 'application/json'
//             }
//         })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Erreur réseau');
//             }
//             return response.json();
//         })
//         .then(data => {
//             let html = '';

//             data.options.forEach(option => {
//                 html += `<div class="option-block mb-3">`;
//                 html += `<label for="option_${option.id}">${option.nom_option}</label>`;
//                 html += `<select name="options[${option.id}]" id="option_${option.id}" class="form-select mb-2">`;
//                 html += `<option value="">-- Aucune valeur --</option>`;
//                 option.valeurs.forEach(valeur => {
//                     html += `<option value="${valeur.id}">${valeur.valeur}</option>`;
//                 });
//                 html += `</select>`;

//                 option.sous_options.forEach(sousOpt => {
//                     html += `<label for="sousoption_${sousOpt.id}">${sousOpt.nom_sous_option}</label>`;
//                     html += `<select name="sousoptions[${sousOpt.id}]" id="sousoption_${sousOpt.id}" class="form-select mb-2">`;
//                     html += `<option value="">-- Aucune valeur --</option>`;
//                     sousOpt.valeurs.forEach(valeur => {
//                         html += `<option value="${valeur.id}">${valeur.valeur}</option>`;
//                     });
//                     html += `</select>`;
//                 });

//                 html += `</div>`;
//             });

//             console.log(html); // pour le debug
//             optionsBlock.innerHTML = html;
//         })
//         .catch(error => {
//             console.error('Erreur chargement options:', error);
//             optionsBlock.innerHTML = '<p>Erreur lors du chargement des options.</p>';
//         });
//     }

//     personnalisableSelect.addEventListener('change', togglePersonnalisableBlocks);
//     categorieSelect.addEventListener('change', loadOptionsByCategorie);

//     // Initialisation au chargement
//     togglePersonnalisableBlocks();
//     loadOptionsByCategorie();
// });

// //script d'injection valeur option id et option personnalisation id dans les option hidden de la vue
// document.addEventListener('DOMContentLoaded', function() {
//     const hiddenOptionInput = document.getElementById('option_personnalisation_id');
//     const hiddenValeurInput = document.getElementById('valeur_option_id');
//     const optionsBlock = document.getElementById('personnalisable-options');

//     optionsBlock.addEventListener('change', function(event) {
//         if (event.target.tagName === 'SELECT') {
//             const optionPersoId = event.target.getAttribute('data-option-personnalisation-id');
//             const valeurOptionId = event.target.value;

//             hiddenOptionInput.value = optionPersoId || '';
//             hiddenValeurInput.value = valeurOptionId || '';
//         }
//     });
// });

/////////////////////////////////////////////////////////////////////////////////////////////