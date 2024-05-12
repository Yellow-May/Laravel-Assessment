# BE Assessment

## Installation Steps

First update .env file with DB credentials

```shell
composer install && php artisan storage:link && php artisan migrate && php artisan db:seed && php artisan serve
```

## Features

- [Admin Authentication](#authentication)
- [Products CRUD](#products)

Please refer to the API collection json for detailed view of the API request.
It can be imported into Postman for easy testing.

## Authentication

Authentication is handled by the built in [sanctum](https://laravel.com/docs/11.x/sanctum)

A token is generated on login and saved in the DB session table and deleted when user logs out.

There is no registration endpoint, only a single login endpoint is available with a single admin account.

```js
email: admin@example.com
password: password
```

I chose this method to speed up the task process as registration endpoint can be added at a later time but login is required for the rest of the features.

## Products

There are a total of four(4) products endpoints which can be view in the API request json file

All CRUD routes are protected so only a logged in admin can access the routes

Aside the products routes, there is a lookup categories route as well.

This endpoint returns all available categories in the DB.

As of now the categories are hardcoded and seeded to the DB table, later on it is possible to make it updatable.

The purpose of the table is to have a field in the product that can be filtered with aside searching against the product name.

### Product Fields

- Image
- Name
- Category (Selected from a list of categories saved on the DB)
- Quantity
- Price
- Description

### Features available for Products

- Create Product
- Update Product
- View single product
- Delete Product
- Fetch all Product and filter by searchKeys and/or category
