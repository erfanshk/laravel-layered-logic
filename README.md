# Laravel Layered Logic
[![Latest Version](https://img.shields.io/github/release/erfanshk/laravel-layered-logic.svg?style=flat-square)](https://github.com/erfanshk/laravel-layered-logic/releases)
[![run-tests](https://github.com/erfanshk/laravel-layered-logic/actions/workflows/run-tests.yml/badge.svg)](https://github.com/erfanshk/laravel-layered-logic/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/erfanshk/laravel-layered-logic.svg?style=flat-square)](https://packagist.org/packages/erfanshk/laravel-layered-logic)
## Under Development - Beta Release
A simple package to make repositories , services and their corresponding interfaces for laravel.
### Works on
> Laravel ^11.0
### How to Install
Just run the command below and everything is ready.
```php
composer require erfanshk/laravel-layered-logic
```
### How it works
LayeredLogicInitServiceProvider gets registered on your laravel app, which comes with a simple command

```php
php artisan make:layered User
```
It creates the following files:


- App
  - Layers
    - Controllers
      - UserController 
      - Requests
        - UserRequest
    - Resources
      - UserResource
      - Collection
        - UserCollection
    - Repositories
      - UserRepository
      - Interfaces
        - UserRepositoryInterface
    - Services
      - UserService
      - Interfaces
        - UserServiceInterface


It also registers repository and service interfaces as singletons in the published LayeredLogicServiceProvider in:
> App\Providers\LayeredLogicServiceProvider

The binding array is located in
> config\layered.php

By running:
```php
php artisan make:layered {model}
```
it is automatically registered in the app container.
Now you can use your pre-made UserService by injecting the UserServiceInterface anywhere in your application.

### What you get by using this package?
It really depends on what coding style you have. LayeredLogic main objective is to bring abstraction to laravel models and controllers.
It also makes the creating and registering of such easy and less time-consuming.


### Development
If you have any ideas to enhance the package, I would be more than happy to hear from you. 
