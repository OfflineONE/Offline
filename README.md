# Offline

This is an offline forum.




Prerequisites:
--------------------------------------------------------------------

```
macOS
```
```
Laravel valet or homestead
```
```
PHP 7.4
```
```
git
```
```
Composer latest version
```
```
install Redis-server
```
--------------------------------------------------------------------

Step 1

```
git clone git@github.com:OfflineONE/Offline.git
```


--------------------------------------------------------------------
Step 2

```
composer install
```

--------------------------------------------------------------------
Step 3

```
mv .env.example .env
```

--------------------------------------------------------------------
Step 4

```
php artisan key:generate
```

--------------------------------------------------------------------
Step 5

```
mysql -u -root 
```

(-u stands for user -root is the standard root user)

once you are inside the mysql

```
CREATE DATABASE pool;
```

("pool" is just the standard database name for our app referencing from the .env file)

If you are not using mysql you have to change the config file and the env. file to which ever database tool you are using.

--------------------------------------------------------------------
Step 6

```
php artisan migrate --seed
```

--------------------------------------------------------------------
Step 7





--------------------------------------------------------------------

1. Visit: http://offline.test/register and register an account.

1. Edit `config/admin.php`, adding the email address of the account you just created.

1. Visit: http://offline.test/admin/channels and add at least one channel. 

--------------------------------------------------------------------

For production set:

QUEUE_DRIVER=database
