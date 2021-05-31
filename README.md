In this sample project I used Repository design pattern and policy for authorization.
and use passport for auth.

##project requirement
```
git clone https://github.com/vahidmohammadi2310/paystarTest
composer install
```

### edit .env file

create database and change database name in .env

for authentication i used passport package 

```
php artisan passport:install --force
```

edit below field in .env
```
client_id=""
client_secret=""
```
then migrate
```
php artisan migrate
```

I used seeder for add user and default permiision to database

```
php artisan db:seed
```

## policy 

create: 1
read : 2
update : 3
delete : 4

for example : 1230 cant delete because dont have 4 or 0234 cant create just could read(2),update(3)and delete(4)

in postman collection in Permission folder we can change access by change permission.



