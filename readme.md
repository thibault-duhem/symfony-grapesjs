Installation du projet
=
## Symfony 5.4 / sonataAdmin 4 /  php 8.1.24 / mysql

### 1) Créer la bdd grapesjs user:root mdp:root 127.0.0.1 3306

### 2) Installer le projet et le lancer

```bash
git clone git@github.com:thibault-duhem/symfony-grapesjs.git
cd symfony-grapesjs
composer install
npm install
symfony server:start
npm run dev
php bin/console d:m:m
```
## Jouer avec l'éditeur (pas de sauvegarde)
### http://127.0.0.1:8000


# Procédure pour créer une page 
##### Il faut d'abord créer la page avant de pouvoir l'éditer car on a besoin de l'id pour mettre à jour l'entité.
###### Actuellement, les échanges entres l'entité et l'éditeur se font en ajax avec une api en continue. On pourra mettre un bouton (enregister) à l'avenir pour éviter trop de requêtes ajax


## Aller sur l'admin 
#### http://127.0.0.1:8000/admin

## Aller dans Page/Créer
#### http://127.0.0.1:8000/admin/app/page/create --> Donner un titre et valider

## On est redirigé sur 
#### http://127.0.0.1:8000/admin/app/page/{id}/edit --> On peut bricoler l'éditeur


## Visualiser le résultat
### http://127.0.0.1:8000/page/{id}