# Projet Web - Application de lecture de musique : SpØtyφ - Groupe 11: LE BOULCH Antoine, LE GOFF Quentin, PAITIER Mathias

## Installation nécessaire sur la VM pour utiliser l'application :

- installer apache2 :              ```sudo apt install apache2```
  - modules : php-pgsql ``sudo apt install php-pgsql`` et  libapache2-mod-php ``sudo  apt install libapache2-mod-php``
- installer postgresql 13 :        ``` sudo apt install postgresql-13 ```
  - ``CREATE EXTENSION IF NOT EXISTS pgcrypto;``

Connexion à la VM:  
> ssh user1@10.10.51.81  
> mdp : Groupe11

### Pour se connecter à la base de données nommée groupe11:   
> user : groupe11  
> mdp : Groupe11

Pour mettre les données dans la base de données, deux choix:
- executer model.sql puis data.sql
- executer Spotyφ_creation.sql

Les deux MCDs sont disponibles: spotyphi_0.mcd (première version) et spotyphi_final.mcd (version finale)
Les liens des deux versions du Figma ainsi que du diapo sont disponibles dans Figmas-Diapo.txt

Nous n'avons pas téléchargé toutes les musiques dans la base de donnée ce qui explique pourquoi certaines ne lisent pas de musique.
Les musiques dont on peut écouter l'audio sont:
- les 4 musiques de l'album "Putain cest génial" - Patrick Sébastien
- Kalash - Booba
- What Is Love - Haddaway
- toutes les musiques de "Different World" - Allan Walker

## Accès au site
Avec  http://10.10.51.81/ via le réseau ISEN.


## Remarques
Changement du site root pour arriver directement sur l'index en allant sur l'IP du serveur. 
Le site a été mis dans un répertoire "client" en prévision de la réalisation d'une partie Admin. Un vhost pourra être mis en place pour rediriger vers celui-ci.  
Le client n'a pas la possibilité de se balader dans l'arborescence des dossiers via la barre de recherche (-Indexes sur le répertoire client)