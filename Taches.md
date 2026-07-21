# Version 1
### 1) MCD ET MLD et script sql(1h)
Tsiky et Nekena
### 2) Template html
Nekena IA utilise : stitch
### 3) Migration
Tsiky



---

## `Côté client` , V1


### 1) Login automatique avec numéro de téléphone

* Creation de model `ClientModel`
* Creation de `AuthController` pour gerer les logins
* fonction dans model pour verifier le numero entree par l'user (soit misy soit tsisy)
* Creation de route pour login client
* `si existe` -> **redirection acceuil**
* `sinon` -> **message d'erreur**
* Ajout de filter pour filtrer les roles

### 2) affichage de acceuil 
* Creation de ClientController et fonction getHome() qui prend les infos a partir de la session 
* creations de OperationModel pour get les activites recentes 
  
### 3) depot
* Creation de route /client/depot pour traiter le depot
* Creation de la fonction processDepot dans controller
* debut de transaction

### 4) retrait
* Creation de route /client/retrait pour traiter le depot
* Creation de la fonction processRetrait dans controller
* debut de transaction : echoue si le montant est superieur a la solde
* handling des frais , methode dans ClientController


### 5) historique
* Creation d'une fonction historique dans CLientController pour prendres tous les operations lies au compte dans la session
* Ajout de route historique et d'un lien dans accueil qui va rediriger la bas

## 6) transfert
* Creation de route /client/depot pour traiter le depot
* Creation de la fonction processDepot dans controller
* handling des frais , methode dans ClientController


## `Côté client` , V2
## 1) transfert externe avec handling de frais de retrait
* Mettre les prefixes dans la session lors de la connexion
  -Creation de PrefixeModel ( id = 1 pour Yas)
  -fonction getPrefixes()
  -nom session , 'prefixes'
* Ajout de checkbox dans acceuil
  -lors du de l'input on verfie si le prefixe est dans le session (js)
    -si oui : active l'input
    -si non : cache l'input
* Modification de processTransfert : ajouter le frais de retrait correspondant au montant dans totalAdebiter si client de notre operateur
C'est un changement logique important : si tu souhaites **restreindre** le transfert multiple uniquement aux numéros de ton opérateur (YAS), voici les étapes simplifiées pour adapter ton système :

## 2) transfert multiple

* Validation stricte dès la saisie (JS)
* Le JavaScript vérifie désormais chaque numéro de la liste : si **un seul numéro** ne commence pas par un préfixe YAS, le bouton "Confirmer" est désactivé ou un message d'erreur bloque la soumission.


* Filtrage serveur obligatoire (Contrôleur)
* Avant tout traitement, le contrôleur rejette la requête si l'un des numéros fournis ne correspond pas à un préfixe YAS.
* Cela garantit que le transfert multiple reste un circuit fermé (100% interne).


* Calcul et exécution simplifiés
* Comme tous les numéros sont YAS, le calcul des frais de retrait devient systématique si la case est cochée.
* Le système débite l'expéditeur du `Montant Total + Frais Transfert + Frais Retrait` et credite chaque destinataire YAS de sa part respective en une seule transaction sécurisée.



## alea2
epargne : n% (apidirina interface)
rehefa vola TRANSFERT -> n% makany amin'epargne  , ambony solde .

* Creation de table epargne : (ok)
  -valeur_epargne (%)
  -solde_epargne actuel
* Creattion model epargne 


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


## 4 Prefixes pour autre operateur
[X] Ajout des donnees pour les autres operateurs dans le seeder

## 5 Commission en plus
[X] Creation d'une nouvelle table pour la configuration de la commission en plus pour les transferts vers autres operateurs
[X] Modification de la methode `processTransfert()` pour appliquer la commission en plus pour les transferts vers autres operateurs

## 6 Separation situation gain pour chaque operateur
[X] Modification de la methode `situationGains()` pour separer `gain_operateur` (net) et `gain_autres_operateurs` (commission externe reversee)
[X] Mise a jour de `situation_gains.php` pour utiliser les nouvelles variables du controleur (`gain_operateur`, `gain_autres_operateurs`, `gain_interne`, `gain_externe` par transaction)

## 7 Situation des montants a envoyer a chaque operateur
[X] Creation de la methode `situationOperateurs()` dans OperateurController :
    + Filtrage des transferts externes (`id_client2` null) via la table `operation`
    + Regroupement par operateur destinataire grace au prefixe du numero
    + Calcul du montant total transfere et de la commission due par operateur
[X] Creation de la route `operateur/montants-operateurs`
[X] Creation de la page d'affichage (`situation_operateurs.php`) avec KPIs et tableau par operateur

## Alea
[X] Creation de la table promotion pour les frais de transfert vers meme operateur
[X] Creation de la methode clalculerPromotion dans CLientController
[X] Appplication de la promotion dans les frais de transfert dans la methode `processTransfert`