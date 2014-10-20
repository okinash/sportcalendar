Howmework1

Quick guide to install:

1)composer install

2)php app/console doctrine:database:create

3)php app/console doctrine:schema:update

4)php app/console doctrine:fixtures:load

Predefined user:
login: admin
pass: 123456
(Use this credentials for login form)

5) for unit tests run:
phpunit -c app

for testing set current date first in
.../Tests/SportCalendarTest.php:16

$date = new \DateTimeImmutable('2014-10-21');

