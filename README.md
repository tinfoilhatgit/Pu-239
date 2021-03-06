# Pu-239

## Goals:
1. Updated to PHP 7.2 - default settings - Done
2. Error free with MySQL 5.7 strict mode - default settings - Done
3. Remove merged bootstrap - Done
4. Update jquery - Done
5. Update all javascript files to remove jquery dependency
6. Merge, mininify and gzip css/js files to reduce the number of requests - Done
7. Replace manual concat/gzip of css/js file with webpack
8. Optimize all images for web - Done
9. Remove js from head and relocate to body
10. REplace Simple Captcha with reCAPTCHA V2 - Done
11. Fully responsive and mobile ready
12. Drag and Drop Image Upload - Done

This is a fork of U-232 V4.

PHP 7.0+ is required, PHP 7.2 recommended.

MySQL 5.6 is required. MySQL 5.7 recommended.

This code explicitly sets the php default timezone to 'UTC', it is recommended that you set the servers timezone to 'UTC' or change it in the code. The timezones must match. After changing the servers timezone, you must restart mysql.

This is still a WIP and a few pages may not be functional in there current location.

Do not use the xbt install, as it's update has not been started and is, therefore broken.

A working site with this code is at https://pu-239.pw/

### To Install:
```
# required apps
jpegoptim, optipng, pngquant, gifsicle

# required php extensions
php-gd, php-xml, php-json, php-mbstring, php-mysqli, php-zip, php-simplexml, php-curl, php-exif, php-bz2, php-imagick

# cache repositories(optional)
redis, php-redis
memchached, php-memcached
APCu
couchbase

# data storage
MySQL or MariaDB or Percona MySQL

# get the files
git clone https://github.com/darkalchemy/Pu-239.git

# install dependancies
cd Pu-239
composer install
npm install

# set ownership
sudo chown -R www-data:www-data ../Pu-239

# set webroot to path Pu-239/public

# add charset to [mysqld] section of mysqld.cnf
character-set-server=utf8mb4
collation-server=utf8mb4_unicode_ci

# add/modify these in [mysqld] to increase max size for index(required)
innodb_file_format = Barracuda
innodb_large_prefix = 1
innodb_file_per_table = 1

# add/modify this in [mysqld] to stop autoincrement on insert ignore(optional)
innodb_autoinc_lock_mode = 0

# restart mysql
sudo service mysql restart

# create database
CREATE DATABASE Pu-239;

# goto website and complete install, all fields must be completed and each fields includes an example and tooltip explanation when hovered

# set permissions and create necessary files
sudo php bin/uglify.php
sudo php bin/set_perms.php

# set ownership
sudo chown -R www-data:www-data ../Pu-239

# delete public/install folder once directed to
sudo rm -r public/install/

# insert trivia questions if desired
mysql database < database/trivia.php.sql

# insert tvmaze ids
mysql database < database/tvmaze.php.sql

# create your first user and login

# goto admin and create your bot/system user

# goto admin cleanup and activate/deactivate scripts, they are initially set to yesterday midnight

# add cron job to root cron for running cleanup, please change path as needed
sudo crontab -e

# runs cron_controller.php every minute, if not already running, as user www-data
* * * * * su www-data -s /bin/bash -c "/usr/bin/php /var/www/Pu-239/include/cron_controller.php" >/dev/null 2>&1
```

### To Update:
```
# get the files
# how you do this step will depend how you did it initially, I personally use rsync to overwrite files from git to my webpath, then remove the install folder
cd Pu-239
git pull

# update dependancies:
composer install
composer dump-autoload -o
npm install
sudo php bin/uglify.php
sudo php bin/set_perms.php

# set ownership
sudo chown -R www-data:www-data ../Pu-239

# update trivia questions if desired
mysql database < database/trivia.php.sql

# insert tvmaze ids 
mysql database < database/tvmaze.php.sql

# update database:
goto admin/upgrade_database to check/update the database
note: if that does exist, check the changelog for 6 Dec, 2017
```

### API's

reCAPTCHA V2 needs both the site key and secret key set in .env

Fanart.tv needs api key set in .env

TMDb API key allows upcoming movies and many images

OMDb API key allows movies and tv lookup

Google API key allows up to 1000 api hits instead of 100 per day, set in .env

IMDb no key needed, allow movies and tv lookup

TVMaze no key needed, allows tv lookup


### Making Changes to css/js files

Make any edits or changes to the files in templates and scripts folder, then run sudo php bin/uglify.php to concatenate, minify and gzip the files for use

### Cache Engines

couchbase, apcu, memcached, redis or file. file is set as default set in .env


### Image Proxy:

An image proxy for hot linked images is built in, disabled by default, enable in staff panel => site settings, this allows for browser caching


### Credits:

All Credit goes to the original code creators of U-232, tbdev, etc. Without them, this would not be possible.
