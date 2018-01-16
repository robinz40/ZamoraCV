composer install
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load

username admin : Admin
password : azerty

username user : user1
password : azerty