# About

BlaBlaCar free alternative written in Laravel (PHP+MySQL). This is web version.

## Live site

https://yugoauto.com

# Used components

## Tailwindcss components

https://flowbite.com/docs/components/tables/

## Auto complete

Used for auto complete for cities

https://jqueryui.com/autocomplete/#custom-data

## Datetime picker

Used for time picker

https://github.com/xdan/datetimepicker

## Cookie consent

https://cookieconsent.popupsmart.com/gdpr-cookie-consent/

## Toastr

Used for showing notifications

https://github.com/CodeSeven/toastr

# Tech

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
```

## Firebase credentials

1. Open https://console.firebase.google.com/project/_/settings/serviceaccounts/adminsdk and select the project you want
   to generate a private key file for.
1. Click on "Manage service account permissions"
1. Under Actions column click on 3 dots and click on "Manage keys"
1. On the new page click ADD KEY > Create new key
1. Securely store the JSON file containing the key.

# Server config

## File upload

In order to be able to upload a file enable: highlight_file() and tmpfile().

## Supervisor

`php artisan queue:work --sleep=3 --tries=3 --max-time=3600`
