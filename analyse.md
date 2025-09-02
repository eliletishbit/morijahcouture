<!-- Document d’Analyse Fonctionnelle et Modélisation des Entités - Système E-commerce Laravel -->

1. Structure Produit et Hiérarchie Catégorielle

1.1 Entités et Relations


## Categorie

id

nom

description

relation : a plusieurs SousCategorie


## SousCategorie

id

nom

categorie_id (FK)

relation : peut avoir plusieurs Collection

Note : Si la catégorie parente est "Accessoires", alors pas de collection.



## Collection

id

nom

image_principale

sous_categorie_id (FK)

relation : a plusieurs Produit


## Produit

id

nom

description

prix_base

collection_id (nullable, FK)

sous_categorie_id (FK)

personnalisable (bool)

type_produit (ex: veste, chaussure)

gamme_taille (par défaut: sur-mesure)

tissu_id (FK)

delai_fabrication

delai_livraison

relation : plusieurs CaracteristiqueProduit



## CaracteristiqueProduit

id

produit_id (FK)

type (tissu, style, pointure, etc)

valeur



2. Module Lookbook


## Lookbook

id

titre

sous_titre

description

statut (new, promo, archivé, etc)


## ImageLookbook

id

url

lookbook_id (FK)

is_principale (bool)



## VideoLookbook

id

url

lookbook_id (FK)



## PointInteractif

id

image_lookbook_id (FK)

position_x

position_y

produit_id (FK, nullable)

description_popup



3. Personnalisation Produit

Les produits personnalisables ont des caractéristiques dynamiques. Création d'une table liée :


## OptionPersonnalisation

id

produit_id (FK)

nom_option ("Tissu", "Bouton", etc)

type_option (texte, image, sélection, etc)


## ValeurOption

id

option_personnalisation_id (FK)

valeur

image (nullable)



4. Catalogue d’échantillons


## CatalogueEchantillon

id

nom

description

relation : contient jusqu'à 6 Echantillon



## Echantillon

id

nom

type (velours, brillant, etc)

catalogue_id (FK)



5. Carte Cadeau


## CarteCadeau

id

montant

mode_envoi (email | impression)

from

to

message

email_destination (si mode = email)



6. Avis Produits


## AvisProduit

id

produit_id (FK)

nom_client

email

ville

titre

commentaire

photo (nullable)

note (1 à 5)



7. Idées de Produits (Filtres)


## IdeeProduit

id

nom ("Mariage", "Look d’été", etc)

CategorieIdeeProduit (pivot)

idee_produit_id (FK)

produit_id (FK)



8. Pages Clés et Fonctions Associées

Page Collection : affiche des produits de base sans bouton d’achat + bouton "Concevez votre veste" en haut

Page Produit : fiche produit avec bouton "Personnaliser" et caractéristiques dynamiques

Page Lookbook : avec images, vidéos, points interactifs

Popup Produit Lookbook : image, titre, prix, bouton "Voir le produit"

Page Echantillons : liste de catalogues et formulaire de commande

Page Carte Cadeau : formulaire avec choix de mode d’envoi

Page Filtrage Idées Produits : par catégorie, style, évènement, couleur, etc


### pertinence et fiabilite du systeme d'information de la plateforme d'ecommerce
Voici des explications détaillées pour chacun de tes points :

---

### 1. Pourquoi lier PointInteractif à ImageLookbook ?  
**Pertinence** :  
- Un point interactif doit être affiché à une position précise sur une image donnée du lookbook (ex : un bouton sur la manche d’une veste sur une photo).
- Cela permet d’associer chaque point à une image spécifique, même si un lookbook contient plusieurs images.

**Stockage en base** :  
- Table `point_interactif` avec une colonne `image_lookbook_id` (FK vers `image_lookbook`).
- Les coordonnées `position_x` et `position_y` (souvent en pourcentage ou pixels) indiquent où placer le point sur l’image.

**Utilisation dans le code** :  
- Quand tu affiches une image lookbook, tu récupères tous les points interactifs liés à cette image (`where image_lookbook_id = ...`).
- Sur le front (React), tu places un composant "point" à la position indiquée sur l’image.
- Au clic sur le point, tu ouvres une popup ou un composant qui affiche les infos du produit lié (`produit_id`), ou une description si pas de produit.

---

### 2. OptionPersonnalisation et ValeurOption (explication et utilité)  
- **OptionPersonnalisation** : représente un type d’option personnalisable pour un produit (ex : "Tissu", "Bouton", "Broderie").
  - Chaque produit peut avoir plusieurs options de personnalisation.
- **ValeurOption** : représente les choix possibles pour une option (ex : pour "Tissu", tu peux avoir "Coton", "Laine", "Soie").
  - Chaque option peut avoir plusieurs valeurs.

**Implication** :  
- Permet de gérer dynamiquement les options de personnalisation pour chaque produit, sans figer les champs dans la table produit.
- Utile pour afficher des sélecteurs dynamiques sur la fiche produit (ex : choisir le tissu, la couleur, etc).

---

### 3. Différence entre Option de personnalisation et Caractéristique produit  
- **CaractéristiqueProduit** :  
  - Attributs fixes ou descriptifs d’un produit (ex : tissu utilisé, style, pointure, couleur affichée sur la fiche).
  - Sert à décrire le produit tel qu’il est vendu ou présenté.
- **OptionPersonnalisation** :  
  - Attributs modifiables par le client lors de la commande (ex : choisir le tissu, ajouter une broderie, sélectionner un bouton).
  - Sert à construire un produit personnalisé selon les choix du client.

---

### 4. Table pivot CategorieIdeeProduit (relation N:N entre IdeeProduit et Produit)  
**Pertinence** :  
- Un produit peut correspondre à plusieurs idées/inspirations (ex : une veste peut être dans "Mariage" et "Look d’été").
- Une idée peut regrouper plusieurs produits (ex : "Look d’été" contient plusieurs vêtements).

**Utilité** :  
- La table pivot `categorie_idee_produit` permet de filtrer les produits par idée sur le site (ex : afficher tous les produits pour "Mariage").
- Permet de créer des pages d’inspiration ou de filtrage avancé pour l’utilisateur.

---

**Résumé** :  
- Les liens FK permettent une navigation précise et flexible dans la base.
- Les options de personnalisation rendent le système adaptable à chaque produit.
- Les caractéristiques décrivent le produit, les options permettent de le modifier.
- Les tables pivot facilitent le filtrage et l’inspiration sur le site.

#############################################################################

### les stacks à utiliser
laravel + inertia
react
axios
bootstrap
fontawesome





