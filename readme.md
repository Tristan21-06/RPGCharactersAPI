# RPGCharacters

## Enoncé

Créer un api sécurisée par token pour la création, la modification et la suppression. 
Ces tokens sont stockés en base de données avec les droits par token. 
Cette API, sous format JSON, doit pouvoir fournir :
- Une liste de personnages définis par leur nom, leur type, leur force, leur défense, leurs pv et leur avatar (facultatif)
- Une liste de types définis leur nom

Codes de retours :
- Bon token : 200
- Mauvais token ou sans token : 401
- Non trouvé (modification/suppression) : 404

Bonus: Rajouter au moins un quota

!!!!!!!!!!!!  INTERDICTION D'UTILISER UN FRAMEWORK (PHP natif) !!!!!!!!!!!!

- Routes (* = token requis)
```
Personnage :
- Liste : /personnages                          GET
- Detail : /personnage/{name}                   GET
- Créer* : /personnage/create                   POST
- Modifier* : /personnage/update/{name}         PATCH
- Supprimer* : /personnage/{name}               DELETE

Type :
- Liste : /types                                GET
- Detail : /type/{name}                         GET
- Créer* : /type/create                         POST
- Modifier* : /type/update/{name}               PATCH
- Supprimer* : /type/{name}                     DELETE
```
- Base de données
```
Table 'types' :
- id INT PRIMARY
- name VARCHAR(50) NOT NULL

Table 'characters' :
- id INT PRIMARY
- name VARCHAR(100) NOT NULL UNIQUE
- type_id INT NOT NULL REFERENCES types(id)
- strength INT NOT NULL
- defense INT NOT NULL
- hp INT NOT NULL
- avatar_path TEXT NOT NULL

Table 'users' :
- id INT PRIMARY
- name VARCHAR(100) NOT NULL UNIQUE
- password VARCHAR(255) NOT NULL

Table 'tokens' :
- id INT PRIMARY
- user_id INT NOT NULL
- access_token VARCHAR(255) NOT NULL UNIQUE
- can_create TINYINT(1) DEFAULT 0
- can_update TINYINT(1) DEFAULT 0
- can_delete TINYINT(1) DEFAULT 0
```
- Exemple
  - Créer des utilisateurs ADMIN, MODERATEUR1, MODERATEUR2
    - ADMIN (admin) : créer, modifier, supprimer
    - MODERATEUR1 (mod1) : modifier, supprimer
    - MODERATEUR2 (mod2) : créer, supprimer

## Rendu

- Lien Github
- RPGCharacters : collection bruno
- dump.sql

## Dépendances requises

- apache 2.4.58
- composer 2.8.3
- mysql 8.0.42
- php 8.2.23

## Setup

- Cloner le projet dans un environnement Apache (XAMPP ou local)
- Copier le ficher ``.env`` dans un fichier ``.env.local`` à la racine du project et remplir les champs correspondants
- ``composer dump-autoload``
- Importer la base de données : 
  - En ligne de commande : ``mysql -u <utilisateur> -p<mot de passe> <base de données> < dump.sql``
  - Par phpmyadmin : Sélectionner la base de données -> Importer -> Glisser/Déposer le fichier dump.sql

## Informations

Dans ce projet, les utilisateurs ne sont pas utilisés mais les tokens liés le sont.
Dans le dump.sql : 
- La base de données est nommée ``rpgcharacters``
- Des utilisateurs sont créés par défaut avec les mots de passe identiques aux noms d'utilisateur :
  - admin
  - mod1
  - mod2