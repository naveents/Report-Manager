 composer create-project symfony/framework-standard-edition reportmanager "2.8.*"
 composer require --dev doctrine/doctrine-fixtures-bundle
 php app/console doctrine:fixtures:load --fixtures=src/DataFixtures/
