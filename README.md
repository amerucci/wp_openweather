# Projet - Développer un plugin météo wordpress

## Objectifs : 

Dans ce projet il vous sera demandé de réaliser un plugin wordpress totalement administrable
Ce plugin sera un plugin météo
Vous récupérer les informations depuis le site : https://openweathermap.org/
Vous ferez appel à une api pour récupérer les informations météorologiques d’une ville ciblée.
Les intitulés des conditions devront être en français et les températures en degré Celsius.

Dans un premier temps, il vous faudra à l’activation du plugin réaliser plusieurs taches
- Création d’un lien menu dans la barre latérale de l’administration
- Créer 2 tables dans la base de données : 
	- Table «  shortcode »
	- Table «  communes »

## Structure : 

Shortcode : 
id 
int(6)
shortcode
varchar(30)


Communes :
id 
int(6)
code
int(6)
nom
varchar(30)

- Hydrater la table communes avec les informations en provenance de l’API : https://geo.api.gouv.fr/communes
- Créer automatiquement une page nommé météo dans laquelle sera appelé automatiquement le short code qui aura été enregistré dans la table shortcode (plus d’explications par la suite). 

Il sera demandé que lors de la désactivation du plugin la page soit automatiquement supprimée, mais aussi que lors de l’activation du plugin une vérification devra être faite afin de ne pas le recréer à chaque fois.

# Administration du plugin

Tout d’abord une fois le plugin activé, vous devrez depuis la page d’administration de votre plugin, générer une clé une clé d’API qui vous sera utile pour faire vos appels.
Cette clé d’api devra être enregistré dans la table wp-option
Il faudra aussi être possible de modifier cette clé si jamais nous nous sommes trompé et ce toujours depuis l’administration.

Ensuite il faudra être en capacité de renseigner la ville dont nous souhaitons récupérer les informations.
Le choix de la ville devra se faire depuis la base de donnée afin d’être sur de l’orthographe de celle ci.
Une fois la ville choisie, un champ devra apparaitre contenant les informations suivantes: [meteo ville="Lons-le-Saunier"]
Ceci est un short code, à coté de ce champ se trouvera un bouton qui au clique copiera le contenu de notre champ.
Ce short code devra par la suite être collé dans n’importe quelle page ou widget. 
Lors de la consultation du site le short code devra être interprété et par conséquent afficher toutes les informations météorologiques de la ville ciblée par le short code.

Un autre encart permettra de personnaliser le short code insérer automatiquement dans la page météo.
La page météo quand à elle affichera les informations météorologiques sur plusieurs jours.
Par le biais de case à cocher pour pourrez décider d’afficher oui ou non certaines informations (ex : humidité, force du vent)
En fonction des options sélectionnées un short code sera généré.
Une fois que vous cliquerez sur un bouton sauvegarder que vous aurez créé alors celui ci sera alors enregistré dans la table shortcode et ainsi appelé automatiquement sur al page météo.

# CONTRAINTE : 

Attention lors des créations de tables ou d’enregistrement en aucun cas les informations de connexion ne doivent être saisie en clair. 
Ce plugin à pour but de pouvoir être réutilisé par conséquent je ne dois pas être contraint de modifier des informations dans tel ou tel fichier.
Tout comme la clé API, celle ci ne doit pas être rentrée en dur dans le code.

# ATTENDU : 

Un design du plugin propre moderne et intuitif.
Votre code devra être versionné sur GitHub Votre plugin devra être en visible sur un site en ligne.
Le travail se fera de manière individuelle. Vous n'êtes pas obligé de développer un thème pour votre site. Vous pourrez utiliser un thême existant.
Le développement des fonctionnalités de votre plugin devra être fait en MVC.


# BONUS : 

Pour la sélection de la ville dans la génération du shortcode vous pourrez utiliser de l’AJAX afin de faire en sorte que cela se charge plus rapidement. 
Pour l’encart de la page météo, vous pouvez faire en sorte de rajouter des champs images, afin de choisir des images personnalisées pour les représentations des conditions météo. https://openweathermap.org/weather-conditions



