# nouveau projet
```sh
symfony new Gestion-des-eleves-et-stages
```
# aide à générer certain code pour Symfony
```sh
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
```
# Base de données
```sh
doctrine:schema:create
doctrine:schema:drop
doctrine:schema:update
doctrine:schema:validate
```
# Classe = Entity
```
symfony console make:entity
```
# CRUD
```
symfony console make:crud
```