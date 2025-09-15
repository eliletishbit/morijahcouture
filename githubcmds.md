✅ workflow exact :
1. Créer et switcher sur une nouvelle branche
bash
# Méthode 1 (en une commande) :
git checkout -b crud-produits

# Méthode 2 (en deux commandes) :
git branch crud-produits      # Crée la branche
git checkout crud-produits    # Se positionne dessus
2. Développer et pousser la fonctionnalité
bash
# Faire vos modifications...
git add .                                  # Ajouter tous les fichiers
git commit -m "Implémentation CRUD produits"  # Commit descriptif
git push -u origin crud-produits           # Pousser la branche sur GitHub
3. Fusionner dans master (après développement)
bash
# Se positionner sur master
git checkout master

# IMPORTANT: Récupérer les dernières modifications
git pull origin master

# Fusionner la branche fonctionnalité
git merge crud-produits

# Pousser le master mis à jour
git push origin master
🚨 Points d'attention importants :
🔹 Gestion des conflits
Si d'autres personnes ont modifié les mêmes fichiers que vous :

bash
# Git vous signalera des conflits
# Ouvrez les fichiers concernés et résolvez les conflits
# Puis terminez le merge :
git add .
git commit -m "Résolution des conflits après merge"
🔹 Supprimer les branches fusionnées (nettoyage)
bash

# Supprimer la branche locale
git branch -d crud-produits


# Supprimer la branche distante (sur GitHub)
git push origin --delete crud-produits
🔹 Bien nommer vos branches
Utilisez une convention de nommage :

feature/nom-feature (ex: feature/crud-produits)

fix/nom-correction (ex: fix/bug-panier)

hotfix/urgence (ex: hotfix/security-patch)