#Test Task: Advertisements Backend

Notes:
- authentication: laravel sanctum (token based)
- images for advert are separated in different table, in theory, i had 3 choices:
    1. create "image_1", "image_2", "image_3" columns in "adverts" table, but it's not flexible, but maybe more optimized(because we do not need to do joins)
    2. using json formatted column, but it  wouldn't have strong structure.
    3. separate table - sql query will be a bit complex, but it's the most flexible way(maybe in future, you will need to store image size, or image placeholder, or increase limit of images amount)

###Stack:
- framework: laravel - 9th version
- database: mysql - latest
- webserver: nginx

Project is dockerized

### How to install:
1. docker-compose build && docker-compose up -d
1. Enter php container: docker-compose exec php sh 
    1. php artisan key:generate 
    1. php artisan migrate
    1. php artisan db:seed
    1. php artisan storage:link
 

