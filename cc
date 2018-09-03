#!/bin/bash

php app/console assets:install web --symlink
chmod -R 0777 app/cache
chmod -R 0777 app/logs
rm -Rf app/cache/*
php app/console cache:warmup --env=dev --no-debug
#php app/console cache:warmup --env=test --no-debug
chmod -R 0777 app/cache
chmod -R 0777 app/logs
#sudo chmod +x bin/*
chown -R www-data:www-data *
chmod -R 0755 /var/www/web
