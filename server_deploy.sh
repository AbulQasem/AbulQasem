#!/bin/sh
set -e
 
echo "Deploying application ..."
 
# Enter maintenance mode
(/usr/bin/php7.4-cli artisan down --message 'The app is being (quickly!) updated. Please try again in a minute.') || true
    # Update codebase
    git fetch origin deploy
    git reset --hard origin/deploy
 
    # Install dependencies based on lock file
    /usr/bin/php7.4-cli composer.phar install --no-interaction --prefer-dist --optimize-autoloader
 
    # Migrate database
    
 
    # Note: If you're using queue workers, this is the place to restart them.
    # ...
 
    # Clear cache
    /usr/bin/php7.4-cli artisan optimize
 
    # Reload PHP to update opcache
    echo "" | sudo -S service php7.4-fpm reload
# Exit maintenance mode
/usr/bin/php7.4-cli artisan up
 
echo "Application deployed!"