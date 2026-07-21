## 1 accueil operateur
[X] Creation de route pour l'accueil operateur
[X] Creation de route pour le login operateur
[X] Fonction login pour enregistrer en session le role de l'operateur
[X] Fonction index pour afficher l'accueil operateur 
[X] Creation de bouton pour operateur dans le connexion client
[X] Creation de la page d'accueil operateur
[X] Gestion des prefixes (affichage et formulaire pour en ajouter un nouveau)
[X] Gestion des baremes de frais :
    + Filtrage des baremes selon le type d'operation choisi
    + Creation du formulaire pour ajouter et modifier un bareme (`form_bareme_frais.php`)
    + Verification pour eviter que deux tranches de prix ne se melangent
    + Suppression d'un bareme

## 2 Situation des Gains
[X] Creation de la route pour voir les gains (`operateur/gain`)
[X] `gain()`  dans OperateurCOntroller :
    + Lecture directe des frais enregistres dans la table `operation`
    + Separation claire entre les gains des retraits et ceux des transferts
[X] Affichage de la page des gains (`situation_gains.php`) avec le total global

## 3 Situation des Comptes Clients
[X] Creation de la route pour voir les comptes clients (`operateur/clients`)
[X] Creation de la methode pour l'affichage :
    + Recuperation des clients avec le nom de leur operateur
    + Calcul de la somme de tous les soldes des clients
    + Calcul du nombre total de clients inscrits
[X] Affichage de la page avec le tableau des comptes (`situation_clients.php`)

## 4 Prefixex pour autre operateur
[X] Ajout des donnees pour les autres operateurs dans le seeder

## 5 Commission en plus
[X] Creation d'une nouvelle table pour la configuration de la commission en plus pour les transferts vers autres operateurs
[X] Modification de la methode `processRetrait()` pour appliquer la commission en plus pour les transferts vers autres operateurs

## 6 Separation situation gain pour chaque operateur
[X] Modification de la methode `gain()` pour separer les gains par operateur et afficher le total pour chaque operateur
[] Affichage des gains des autres operateurs

## 7 Situation des montant a envoyer a chaque operateur
[] Creation d'une nouvelle page pour afficher le montant a envoyer a chaque operateur pour les transferts vers autres operateurs