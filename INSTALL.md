# Requirement

- PHP >= 7.1

# Web Site Settings

Edit file in /fuel/app/config if needed.

# Composer and packages

    cd /path/to/project/root
    composer install --prefer-dist

# FuelPHP Environment Initialization

    php oil r install


# Create DB Tables for Sentry Auth

    php oil r migrate --packages=sentry


# Create DB Tables for Web Site

    php oil r migrate


# Change Admin Account Information

Default website admin account and password is admin/admin. Change the admin account login information or create a new admin account after install completed.


