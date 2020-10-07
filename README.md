# Développez de A à Z le site communautaire SnowTricks

## Mise en place du projet

En ce qui concerne le serveur pour la mise en place du projet, si votre système d'exploitation est Windows, nous vous recommandons d'utiliser le server Wamp, car d'ailleurs c'est celui qui a été utilisé durant la conception de ce projet : 

Il est disponible à l'adresse suivante:
    
    - Windows : WAMP (http://www.wampserver.com/)

    Une autre alternative est Xampp : 
    - XAMP (https://www.apachefriends.org/fr/index.html)

Pour les utilisateurs de Mac : 
    - MAC : MAMP (https://www.mamp.info/en/mamp/)

Et pour les utilisateurs de Linux : 
    
    - Linux : LAMP (https://doc.ubuntu-fr.org/lamp)
    
    
## Importation du projet

Pour l'importation du projet sur votre pc l'installation de GIT est nécessaire, si il n'est pas encore présent sur votre pc, vous pouvez le télécharger via le lien suivant : 

    - GIT (https://git-scm.com/downloads) 
    
Dès que GIT sera installé, pour importer le projet il faudra vous placer, via la console, dans le dossier de votre choix puis lancer la commande suivante :

    - https://github.com/Steve237/Blog6.git
    
Le projet sera alors cloné dans le répertoire que vous avez choisi.

## Configuration des variables d'environnement

Afin de pouvoir exécuter correctement le projet, il vous sera indispensable de configurer auparavant les variables d'environnement comme la connexion à la base de données, ou le server smtp pour l'envoi des mails, cette étape se réalise dans le fichier .env situé à la racine du projet, depuis lequel vous devrez renseigner les identifiants de connexion à votre base de données, et de votre server SMTP pour l'envoi de mails, selon le modèle suivant.
    
    - DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7

    Pour le server Smtp, par exemple, si vous utilisez Gmail :

    -MAILER_URL=smtp://smtp.gmail.com:587?encryption=tls&username=votreadressemail&password=votremotdepasse

## Création de la base de données

Vous devez créer une base de données dont le nom est conforme à celui que vous avez renseigné dans le fichier .env puis y importer le fichier blogsnow.sql présent à la racine du dossier zip qu'on vous a transmis, vous disposerez alors de toutes les tables du projet: 

## Lancement du serveur

La base de donnée étant entièrement crée, incluant toutes les tables du projet, vous pouvez lancer le serveur via la commande suivante pour executer le projet : 

    - php bin/console server:run

L'url pour accéder au projet apparaîtra alors dans la console, il suffira de la copier/coller dans la barre de recherche de votre navigateur, puis vous aurez accès au projet.

## Grade obtenu sur Codacy

En ce qui concerne la qualité du code, Codacy nous a décerné le grade A : 

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/0e42332379984ac5a54d6b7ac9f3345b)](https://www.codacy.com/gh/Steve237/Blog6/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Steve237/Blog6&amp;utm_campaign=Badge_Grade)

Un lien vers l'analyse Codacy : 
https://app.codacy.com/gh/Steve237/Blog6/dashboard?branch=master
