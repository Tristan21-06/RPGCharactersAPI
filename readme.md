# RPGCharacters

## Enoncé

api demandé   s'agit  de crée la liste  des personnage d'un jeu vidéo
table bdd type
name : string
avatar:  img (path)

table  token

table bdd personnage
nom : personnage  string
type: mage, cav ect  relations
force: int
def : int
pv: int
avatar :  img (path stocker)

objectif :  lister les personnages "/"
bdd personnages
personnage/{username} :  détails  des informations (attentions  le username doit être unique)
non  trouver -> status 404
types
type/{id}
pour afficher le détails

bdd  utilisateur :
name:   string
password: string/hash

bdd token :
token:  string
can_create: bool
can_update: bool
can_delete: bool

Post:

personnage/create
creation personnnage

put/patch :
personnage/update/{id}
edition

DELETE :  suppressions   token

ADMIN  :  create update  supprimer

MODERATEUR  : modifier  ou supprimé
MODERATEUR2 : créer ou supprimé


AFFICHAGE : public  (pas de token a géré ou de droit)
POUR les autres  method  il faudra un token d'authorisation
NO FRAMEWORK

si je fais une action  avec le mauvais  ou sans  token qui m'est pas attribué -> error 401
si  réussis  success 200

Précisions  IMPORTANT  c'est  un api  !  retour  JSON

bonus :  rajouté  un quotas  example  ->  maximun  creation  ect 

livrable fichier .sql, collection bruno et github public

## Rendu

RPGCharacters : collection bruno
rpgcharacters.sql : dump sql

## Dépendences

- php ^8.0
- composer
- apache

## Setup

``composer dump-autoload``

