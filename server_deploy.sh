#!/bin/sh
set -e
 
echo "Deploying application ..."
 
    # Enter maintenance mode
    /usr/bin/php7.4-cli artisan down 
    # Update codebase
    git fetch origin deploy
    git reset --hard origin/deploy
 
    # Install dependencies based on lock file
    /usr/bin/php7.4-cli composer.phar install --no-interaction --prefer-dist --optimize-autoloader
    /usr/bin/php7.4-cli composer.phar dump-autoload
 
   
    # Clear cache
    /usr/bin/php7.4-cli artisan optimize
 

    # Exit maintenance mode
    /usr/bin/php7.4-cli artisan up
 
echo "Application deployed!"