# BileMo - API Rest
*Projet 7 du parcours "Développeur d'applications PHP/Symfony" formation Openclassrooms*<br />

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/6fd3074c86ea425eb6d449e3ac83a3e3)](https://www.codacy.com/manual/alexdev06/BileMo?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=alexdev06/BileMo&amp;utm_campaign=Badge_Grade)

### Lien de login de l'API : https://bilemo.alexandremanteaux.fr/api/login (requête à faire en "POST" avec des datas JSON cf documentation)
### Lien vers la documentation de l'API : https://bilemo.alexandremanteaux.fr/api/doc

## Contexte
BileMo est une entreprise offrant toute une sélection de téléphones mobiles haut de gamme.

Vous êtes en charge du développement de la vitrine de téléphones mobiles de l’entreprise BileMo. Le business modèle de BileMo n’est pas de vendre directement ses produits sur le site web, mais de fournir à toutes les plateformes qui le souhaitent l’accès au catalogue via une API (Application Programming Interface). Il s’agit donc de vente exclusivement en B2B (business to business).

Il va falloir que vous exposiez un certain nombre d’API pour que les applications des autres plateformes web puissent effectuer des opérations.

### Besoin client
Le premier client a enfin signé un contrat de partenariat avec BileMo ! C’est le branle-bas de combat pour répondre aux besoins de ce premier client qui va permettre de mettre en place l’ensemble des API et de les éprouver tout de suite.

 Après une réunion dense avec le client, il a été identifié un certain nombre d’informations. Il doit être possible de :

* consulter la liste des produits BileMo ;
* consulter les détails d’un produit BileMo ;
* consulter la liste des utilisateurs inscrits liés à un client sur le site web ;
* consulter le détail d’un utilisateur inscrit lié à un client ;
* ajouter un nouvel utilisateur lié à un client ;
* supprimer un utilisateur ajouté par un client.
Seuls les clients référencés peuvent accéder aux API. Les clients de l’API doivent être authentifiés via OAuth ou JWT.

Vous avez le choix entre mettre en place un serveur OAuth et y faire appel (en utilisant le FOSOAuthServerBundle), et utiliser Facebook, Google ou LinkedIn. Si vous décidez d’utiliser JWT, il vous faudra vérifier la validité du token ; l’usage d’une librairie est autorisé.

### Présentation des données
Le premier partenaire de BileMo est très exigeant : il requiert que vous exposiez vos données en suivant les règles des niveaux 1, 2 et 3 du modèle de Richardson. Il a demandé à ce que vous serviez les données en JSON. Si possible, le client souhaite que les réponses soient mises en cache afin d’optimiser les performances des requêtes en direction de l’API.

### Livrables

* Diagrammes UML (modèles de données, classes, séquentiels)
* Les instructions pour installer le projet (dans un fichier README à la racine du projet)
* Les issues sur le repository GitHub
* Documentation technique de l’API à destination des futurs utilisateurs


## Bibliothèques utilisées :
- Symfony lts 4.4.7
- fzaninotto/faker 1.9.1
- symfony/apache-pack 1.0
- friendsofsymfony/rest-bundle 2.7
- jms/serializer-bundle  3.5
- lexik/jwt-authentication-bundle 2.6
- white-october/pagerfanta-bundle 1.3
- willdurand/hateoas-bundle 2.1
- nelmio/api-doc-bundle 3.6

## Procédure d'installation :
1. Importer le repository en le clonant ou en téléchargeant le zip

2. Installer les bibliothèques avec la commande `composer install`

3. Modifier les variables d'environnement dans le fichier .env : 
    * Configurer votre base de données avec son nom et les informations de connexion dans la section `doctrine/doctrine-bundle` :
      * Version du server
      * Login
      * Mot de passe
      * Nom de la base de données
    * Mettre en version de dev (développemnent) ou prod (production)dans la section`symfony/framework-bundle`
    
4. Pour créer la base de données : `php bin/console doctrine:database:create`

5. Pour installer les tables de données via le système de migrations : `php bin/console doctrine:migrations:migrate`

6. Installer un jeu de données : `php bin/console doctrine:fixtures:load`

7. Installer les clés de chiffrement avec OpenSSL: <br>
  * `mkdir -p config/jwt`<br>
  * `openssl genrsa -out config/jwt/private.pem -aes256 4096`
  * `openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem`
  * Il va vous demander de saisir une passphrase: renseignez là ensuite dans le fichier `.env` dans `JWT_PASSPHRASE=...`

8. Démarrer le serveur de Symfony avec la commande `symfony server:start`

9. Lire la documentation sur `api/doc`

10. En cas de bugs, vider les caches avec les commandes `php bin/console cache:clear` et `php bin/console cache:clear --env=prod`

## Pour tester l'API :
Faire une requête "POST" sur https://bilemo.alexandremanteaux.fr/api/login avec dans le body un objet JSON : {
  "username": "alex",
  "password": "password"
}
En réponse, vous obtiendrez un token JWT et un cookie contenant ce token à utiliser pour vous authentifier à chacune de vos requêtes.
