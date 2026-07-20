# Version 1
### 1) MCD ET MLD et script sql(1h)
Tsiky et Nekena
### 2) Template html
Nekena IA utilise : stitch
### 3) Migration
Tsiky



---

## `Côté client`

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
* Ajout de route historique et d'un lien dans accueil qui va rediriger la bas1

## 6) transfert
* Creation de route /client/depot pour traiter le depot
* Creation de la fonction processDepot dans controller
* handling des frais , methode dans ClientController






