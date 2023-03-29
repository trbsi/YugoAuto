#!/bin/bash
target=${1:-usage}

case ${target} in
    install)
        composer install --no-dev && php artisan key:generate && php artisan storage:link && php artisan migrate && npm install && npm run build && php artisan db:seed --class=PlacesSeeder;
    ;;

    install-local)
        composer install && php artisan key:generate && php artisan storage:link && php artisan migrate:fresh --seed && npm install && npm run build
    ;;

    ide)
        php artisan ide-helper:generate && php artisan ide-helper:meta && php artisan ide-helper:models && php artisan ide-helper:eloquent
    ;;

    *)
        echo "Choose something!"
    ;;
esac
