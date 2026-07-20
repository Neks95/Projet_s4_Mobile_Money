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







