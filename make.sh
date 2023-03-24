#!/bin/bash
target=${1:-usage}

case ${target} in
    install)
        composer install && php artisan key:generate && php artisan storage:link && php artisan migrate:fresh --seed && npm install && npm run prod && php artisan livewire:publish --assets;
    ;;

    install-local)
        composer install && php artisan key:generate && php artisan storage:link && php artisan migrate:fresh --seed && npm install && npm run dev && php artisan livewire:publish --assets && php artisan ide-helper:generate && php artisan ide-helper:meta && php artisan ide-helper:models && php artisan ide-helper:eloquent
    ;;

    ide)
        php artisan ide-helper:generate && php artisan ide-helper:meta && php artisan ide-helper:models && php artisan ide-helper:eloquent
    ;;

    *)
        echo "Choose something!"
    ;;
esac
