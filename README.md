Projet Réseau Social Facebook
L2-IRT-AL1
*Groupe 16
Les membres du groupe sont renseignés ci-après:

-ADJIBADE Housniyath
-EHYSSE Noussiratou
-HOUETOHOSSOU Maureen (responsable de groupe)

*Répartition des tâches

-ADJIBADE s'est occupée d'implémenter l'inscription, la connexion, la réinitialisation de mot de passe , la vérification (qui nous permet de confirmer que l'utilisateur est bien connecté)

-EHYSSE s'est occupée du côté création de compte Back office (administrateeur, modérateur, utilisateur standard), du module chat

-HOUETOHOSSOU séest occupée de la page d'accueil qui regroupe la publication de contenu, l'affichage du contenu publiés, les likes et dislikes associés ainsi que les commentaires


*Description du projet
Ce projet est un mini réseau social développé dans le cadre du TP. Il permet aux utilisateurs de :

-S'inscrire et de se connecter

-Modifier leur mot de passe (à travers la réinitialisation du mot de passe)

-Accéder à undashboard de navigation dès leur connexion

-Voir et interagir avec un fil d'actualité (page d'accueil)

-Créer des comptes entant qu'administrateur et autres

-Voir et envoyer des messages à dautres utilisateurs

*Identifiants de test

Prénom:Dolla 
Nom:TOBO
Email: Tobodolla@gmail.com
Mot de passe : 1234

*Mode de fonctionnement 
Avant tout après la publication d'un article dès que vous vous connecte, rechargez la page s'il vous plaît. Un souci que l'on n'a pas pu régler.

La base de données est à l'intérieur du dossier de fichiers . Elle est nommée reseau_social.sql

Dès son inscription, l'unicité de l'email de l'utilisateur est vérifié. Il est ensuite redirigé vers un formulaire de connexion où il est invité à entrer ses identifiants(mot de passe, email). Il a  le choix de réinitialiser son mot de passe par lien (token). Suite à sa connexion il est dynamiquement redirigé vers le dashboard qui le mène vers la page d'accueil avec la publication des post,etc.. Il a un bouton pour revenir au dashboard et naviguer entre les autresmodules. Il peut également se déconnecter grâce au bouton de déconnexion fonctionnel présent sur le dahboard et laisser la place à d'autrs utilisateurs. L'utilisatuer connecté est connu grâce à un message de bienvenue tout en bas du dashboard

*Technologies utilisées
Frontend: HTML, CSS , Bootstrap ,JavaScript
Backend: PHP
Base de données: MySQL
Communication client-serveurs: fetch() avec JSON

*Notes importantes



Le projet ne suit pas le modèle SPA strict care les pages sont séparées
L'utilisateur connecté est bien visible sur le dashboard
Le module de Back Office, Chat et Amis n'est pas vérifié. Nous ne savons pas s'il est fonctionnel
La gestion de profil n'est pas implémentée
HOUETOHOSSOU fera le commit de ADJIBADE car son ordinateur ne tenait plus
