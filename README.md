# OfflineForum

This is an open source forum that was build with Laravel at its core. Build together with Laracast.

Prerequisites:

PHP 7.4
Composer latest version

Step 1

git clone git@github.com:OfflineONE/Offline.git

Step 2

composer install

Step 3

mv .env.example .env

Step 4

php artisan key:generate

Step 5

mysql -u -root 

(-u stands for user -root is the standart root user)

once you are inside the mysql

CREATE DATABASE pool;

(pool is just the standard database name for our app referencing from the .env file)

If you are not using mysql you have to change the config file and the env. file to which ever database tool you are using.

Step 6

php artisan migrate --seed

Step 7




