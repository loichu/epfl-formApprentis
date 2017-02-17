# EPFL-Form

## BUT 

Réaliser un formulaire pour la postulation des nouveaux apprentis EPFL, pour tous les métiers.
Les languages WEB choisis sont PHP, Javascript (et frameworks).

## Attentes

Le formulaire permet d'uploader des fichiers (tels que des CV, lettre de motivations etc) sur notre serveur. 
Il faudra ensuite donner des droit de lecture aux personnes responsables.

Le formulaire crée un dossier au nom de l'apprenti(composé ainsi: sciper invité - date et heure - email), classé par métier, avec ses informations et ses fichiers uploadés.

Un Tequila invité temporaire devra être crée afin de limiter l'accès au formulaire, puis ajouté dans un groupe d'accès au formulaire.

Une page d'acceuil (index.php) indique les étapes d'inscription à l'utilisateur, il crée son compte temporaire et se connecte ensuite et redirige vers le formulaire.

Au chargement, le formualaire ne propose que le choix du métier, puis affiche ou non le reste du formulaire selon le métier choisi (voir particularités)

Le site doit être équipé de vérification multiple, côté client et serveur:
* Contrôles d'entrées sur les champs (saisie, required, ...)

* Contrôles sur fichiers (nom, taille, format, ...)

**Le projet devra être terminé début octobre 2016**

## Particularités

Les demandes d'apprentissages pour les métiers de laboratoires se font auprès d'une autre association, 
lorsque l'une des 3 filières est sélectionnée, une redirection vers le site de cette association se fait.

Lorsque la profession d'informaticien est choisie, un choix entre les filières disponibles doit apparaitre.

Lorsque la profession de polymécanicien est choisie, un champ upload supplémentaire doit apparaitre pour le certificat de capacité GIM-CH.

## Améliorations futures