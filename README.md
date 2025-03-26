# PHPStan Doctrine Issue Reproduction

## Install
```shell
composer install
composer -d app install
```

## Analyse
```shell
vendor/bin/phpstan --configuration=app/phpstan.php
```

## Test
```shell
php app/bootstrap.php
```
