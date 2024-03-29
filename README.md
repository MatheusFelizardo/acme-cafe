# Acme Cafe - Backend

## How to run


**Requirements**

* **PHP:**
* **Composer:** [https://getcomposer.org/download](https://getcomposer.org/download).

**Steps:**

1. **Clone the project:**

   ```bash
   git clone [https://github.com/MatheusFelizardo/acme-cafe](https://github.com/MatheusFelizardo/acme-cafe)```

2. **Install the dependencies**
    ```bash 
    composer install
    ```
3. Copy the .env.example and change to .env
    ```
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:dZK2r4C1sO8uqrw5hn2o7Gw3amOwB6HY5D0fv5ivwi0=
    APP_DEBUG=true
    APP_TIMEZONE=UTC
    APP_URL=http://localhost

    APP_LOCALE=en
    APP_FALLBACK_LOCALE=en
    APP_FAKER_LOCALE=en_US

    APP_MAINTENANCE_DRIVER=file
    APP_MAINTENANCE_STORE=database

    BCRYPT_ROUNDS=12

    LOG_CHANNEL=stack
    LOG_STACK=single
    LOG_DEPRECATIONS_CHANNEL=null
    LOG_LEVEL=debug

    DB_CONNECTION=sqlite
    # # DB_HOST=127.0.0.1
    # # DB_PORT=3306
    # # DB_DATABASE=laravel
    # # DB_USERNAME=root
    # # DB_PASSWORD=

    SESSION_DRIVER=database
    SESSION_LIFETIME=120
    SESSION_ENCRYPT=false
    SESSION_PATH=/
    SESSION_DOMAIN=null

    BROADCAST_CONNECTION=log
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=database

    CACHE_STORE=database
    CACHE_PREFIX=

    MEMCACHED_HOST=127.0.0.1

    REDIS_CLIENT=phpredis
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

    MAIL_MAILER=log
    MAIL_HOST=127.0.0.1
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="hello@example.com"
    MAIL_FROM_NAME="${APP_NAME}"

    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=
    AWS_USE_PATH_STYLE_ENDPOINT=false

    VITE_APP_NAME="${APP_NAME}"
    ```
4. **Create a laravel key** 
    ```bash 
    php artisan key:generate
    ```
5. **Run the application**
    ```bash 
    php artisan serve
    ```

You can test the request sending a GET request to http://localhost:8000/api/users. It should list some created users.


## Database
1. You can regenerate from zero using ```php artisan migrate:fresh```
2. In case regenerating it from zero, you can use the seeder command to add the dishes for the menu in the database: ```php artisan db:seed DishSeeder```

## Endpoints
The base url for development is http://localhost:8000/api
### Users

1. Create: POST /users
```JSON
{ 
	"name": "User Example",
	"nif": "319513948"
}
```
2. List all: GET /users (No body required)
3. List by id: GET /users/{user_id}
```
Example: /users/9b9a5b2d-6f65-4df3-88a8-6e40a92f2af9
```
4. Login: POST /users/authenticate
```JSON
{ 
	"nif": "319513948"
}
```
5. Update: PUT /users/{user_id} 
```
Example: /users/9b9a5b2d-6f65-4df3-88a8-6e40a92f2af9
```
```JSON
{ 
	"name": "Theus"
}
```
6. Delete: DELETE /users/{user_id} (No body)
```
Example: /users/9b9a5b2d-6f65-4df3-88a8-6e40a92f2af9
```

### Dishes

1. Create: POST /dishes
```JSON
{ 
	"name": "Dish 1",
	"description": "Delicous dish 1",
	"price": 2.50,
    "image": null, // optional - default: null (To do: implement image upload)
	"featured": true, // optional - default: false
    "is_active": false // optional - default: true
}
```
2. List all: GET /dishes (No body required)
3. List by id: GET /dishes/{dish_id} 
```
Example: /dishes/2
```
4. Update: PUT /dishes/{dish_id} 
```
Example: /dishes/3
```
```JSON
{ 
    // the values you want to update
	"name": "Dish 1",
	"description": "Delicous dish 1",
	"price": 2.50,
    "image": null, 
	"featured": true, 
    "is_active": false 
}
```
5. Delete: DELETE /dishes/{dish_id} (No body)
```
Example: /dishes/3
```


### Dishes Category 
This will be used if we need to filter or show the dishes grouped by category. This has the "food_categories" table filled default with the values in the migration "2024_03_20_162507_food_categories"

1. List: GET /dishes/categories (No body)
2. Associate a category for a dish: POST /dishes/{dishId}/category
```JSON
{ 
    "food_category_id": 1
}
```
3. Update the associated category: PUT /dishes/{dishId}/category
```JSON
{ 
    // this will replace one category by another
	"old_category": 4,
	"new_category": 1
}
```
4. Disassociate a category: DELETE /dishes/{dishId}/category/{categoryId}
```
Example: /dishes/2/category/1
This will disassociate the category id 1 in the dish id 2
```


### Vouchers
The voucher will be a service, but for now it's possible to create the association via API request

1. List all: GET /vouchers (No body)
2. Create: POST /vouchers/generate
3. Associate with a user: POST /voucher/{voucherCode}/associate/{userId}
```
After generating the user and the voucher, you can associate using the route as the example.
Example: /voucher/AP8B2F552024/associate/9b9c9a5b-1981-4cf3-a42d-d08307d59a1d
```