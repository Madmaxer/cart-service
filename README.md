# cart-service

The microservice handles creating, updating, removing products data

## tech stack

* PHP >= 7.1
* Nginx
* MySQL
* Composer
* Xdebug (dev only)

## local environment setup

1. Add an /etc/hosts entry 
```
127.0.0.1       cart.local
```

2. Clone the [microservices-docker](https://github.com/microservices-docker) repository and run 'product' service.

## swagger api docs

API docs are located at GET /api/documentation

Re-generating API documentation:
```
php artisan l5-swagger:generate
```

## build, run, test

* install Composer dependencies
* run migrations
* run tests and inspections

Running tests, syntax check and inspections:
```
/var/www/html # ./vendor/bin/phing test
```

## configuration

* .env file
