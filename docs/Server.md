# Server config

## Deployment script

``` 
git reset
git checkout .
git checkout master
git pull --rebase
composer install --no-dev
php artisan migrate --force
npm i
npm run build

php artisan optimize:clear
php artisan route:cache
php artisan config:cache
php artisan view:cache

php artisan runcloud:restart-supervisor
```

## File upload

In order to be able to upload a file enable: highlight_file() and tmpfile().

## Supervisor

`php artisan queue:work --sleep=3 --tries=3 --max-time=3600`
