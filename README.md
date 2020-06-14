# BileMo - API Rest
*Projet 7 du parcours "Développeur d'applications PHP/Symfony" formation Openclassrooms*<br />

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/6fd3074c86ea425eb6d449e3ac83a3e3)](https://www.codacy.com/manual/alexdev06/BileMo?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=alexdev06/BileMo&amp;utm_campaign=Badge_Grade)

### Lien vers la page de connexion de l'API : https://bilemo.alexandremanteaux.fr/api/login
### Lien vers la documentation de l'API : https://bilemo.alexandremanteaux.fr/api/doc

## Bibliothèques utilisées:
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

3. Modifier les variables d'environnement dans le fichier .env: 
    * Configurer votre base de données avec son nom et les informations de connexion dans la section `doctrine/doctrine-bundle`:
      * Version du server
      * Login
      * Mot de passe
      * Nom de la base de données
    * Mettre en version de dev(développemnent) ou prod(production)dans la section`symfony/framework-bundle `
    
4. Pour créer la base de données avec la commande : `php bin/console doctrine:database:create`

5. Pour installer les tables de données via le système de migrations: `php bin/console doctrine:migrations:migrate`

6. Installer un jeu de données : `php bin/console doctrine:fixtures:load`

7. Installer les clés de chiffrement avec OpenSSL: <br />
  * `mkdir -p config/jwt`<br />
  * `openssl genrsa -out config/jwt/private.pem -aes256 4096`
  * `openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem`
  * Il va vous demander de saisir une passphrase: renseignez là ensuite dans le fichier `.env` dans `JWT_PASSPHRASE=...`

8. Démarrer le server de Symfony avec la commande `symfony server:start`

9. Lire la documentation sur `api/doc`

10. En cas de bugs, vider les cachez avec les commandes `php bin/console cache:clear` et `php bin/console cache:clear --env=prod`

## Pour tester l'API :
Faire une requête "POST" sur https://bilemo.alexandremanteaux.fr/api/login avec dans le body un objet JSON : {
  "username": "alex",
  "password": "password"
}
En réponse, vous obtiendrez un token JWT et un cookie contenant ce token à utiliser pour vous authentifier à chacune de vos requêtes.
