### Setup ###

After you cloned the project, run these commands to get set up locally:

``` bash

# copy .env.example to .env
cp .env.example .env

# generate app key
php artisan key:generate

# install composer dependencies
composer install

# run migrations
php artisan migrate:fresh --seed

php artisan serve

# finally from the root directoy run all the tests to be sure the project setup was succesfull
php artisan test
```

### Routes ###

Run ``` php artisan route:list``` to list the available API routes.

```
| GET|HEAD  | api/author          | author.index   | App\Http\Controllers\AuthorController@index   | api        |
| POST      | api/author          | author.store   | App\Http\Controllers\AuthorController@store   | api        |
| GET|HEAD  | api/author/{author} | author.show    | App\Http\Controllers\AuthorController@show    | api        |
| PUT|PATCH | api/author/{author} | author.update  | App\Http\Controllers\AuthorController@update  | api        |
| DELETE    | api/author/{author} | author.destroy | App\Http\Controllers\AuthorController@destroy | api        |
| GET|HEAD  | api/news            | news.index     | App\Http\Controllers\NewsController@index     | api        |
| POST      | api/news            | news.store     | App\Http\Controllers\NewsController@store     | api        |
| GET|HEAD  | api/news/{news}     | news.show      | App\Http\Controllers\NewsController@show      | api        |
| PUT|PATCH | api/news/{news}     | news.update    | App\Http\Controllers\NewsController@update    | api        |
| DELETE    | api/news/{news}     | news.destroy   | App\Http\Controllers\NewsController@destroy   | api        |
```

#### Filter parameters ####

* Filter news published between dates e.g. `api/news?filter[published_between]=2021-01-01,2021-01-10`
* Filter title e.g. `api/news?filter[title]=test`
* Filter published news e.g. `api/news?filter[is_published]=0`
* Filter author ids e.g. `api/news?filter[author_id]=1`
* Filter author's names e.g. `api/author?filter[first_name]=John&[last_name]=Doe`
* The negative sign (-) sorts in descending order e.g. `api/news?sort=title,-is_published`
