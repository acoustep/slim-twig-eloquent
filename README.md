# Slim, Twig & Eloquent

## In development

This repo is very much in development.  If you're coming from my [original blog post](http://fullstackstanley.com/read/using-eloquent-twig-and-slim-php) back in 2013 please download the 1.0 tagged release.

## Installation

Clone the repository ```https://github.com/acoustep/slim-twig-eloquent.git```

Run ```composer install```

In ```app/config.php``` edit the ```$environments``` variable to use your computer's ```hostname``` for development.  

You can retrieve your hostname by running ```hostname``` in your command line.

By default if the hostname is not found it will use the production settings.

Rename ```phinx.example.yml``` to ```phinx.yml``` and edit your settings accordingly.

To use the built in local PHP server use ```php -S localhost:8000 -t public/``` or the helper command ```php ste serve```.

## Slim Routes

Routes are all kept in ```app/routes.php```. To learn more about Slim's routing system see the [documentation](http://docs.slimframework.com/).

## Twig Views

Views are kept in ```app/views/```. Helper functions such as ```urlFor``` are supported. 

See the [Twig documentation](http://twig.sensiolabs.org/documentation) for more information.

## Eloquent Models

Models are kept in app/models/.  See the [Eloquent documentation](http://laravel.com/docs/4.2/eloquent) for more information.

Models can be generated with ```php ste model:make ModelName```. This command will also run ```composer dumpautoload```.

### Model and validation example

```
<?php
// app/models/User.php
use Illuminate\Database\Eloquent\Model as Model;

class User extends Model {

  protected $fillable = [
    'username',
    'created'
  ];

  public $timestamps = false;

  public static $rules = [
    'username' => 'required'
  ];

  public static $messages = [
    'required' => 'The :attribute is required.'
  ];

}
```

```
<?php
// app/routes.php

$app->get ('/user', function () use ( $app ) {

  $users = User::all();

  $user = new User;
  $user = $user->fill(['username' => '']);

  $validator = Validator::make(['username' => ''], User::$rules, User::$messages);

  dd($validator->messages()->first());
  // Outputs: "The username is required."
});

```

## Migrations

Migrations are kept in ```app/db/migrations``` and uses [Phinx](https://github.com/robmorgan/phinx).

See the documentation for Phinx [commands](http://docs.phinx.org/en/latest/commands.html) and [migrations](http://docs.phinx.org/en/latest/commands.html#the-migrate-command) to get started.

## Gulp

Setting up gulp for compiling your assets requires Node and NPM.

```npm install```

By default running ```gulp``` will watch and compile the following:

* ```app/assets/javascripts/**/*.js``` to ```public/js/application.js```
* ```app/assets/sass/**/*.scss``` to ```public/css/**/*.css```
* ```app/assets/less/**/*.scss``` to ```public/css/**/*.css```

### Switching from Javascript to Coffeescript

As a Coffeescript user I've made it super simple to use Coffeescript instead of Javascript.

Run ```gulp coffee``` instead of the default ```gulp```.

The coffee command watches and compiles to the following directories

* ```app/assets/coffeescripts/**/*.js``` to ```app/assets/javascripts/**/*.js``` to ```public/js/application.js```
* ```app/assets/sass/**/*.scss``` to ```public/css/**/*.css```
* ```app/assets/less/**/*.scss``` to ```public/css/**/*.css```

Note that Coffeescript files get written to the javascript directory first which will overwrite any files with the same name.

### SASS / LESS

You should be able to use either out of the box.  Both get compiled with ```gulp``` and ```gulp coffee```.

Sass files are stored in ```app/assets/sass``` and less files are stored in ```app/assets/less```.

## Commands

By default there are two commands for you to utilize: ```php ste serve``` and ```php ste make:model```.

``php ste serve`` runs the local PHP server.

```php ste make:model``` takes the name of your model as its first argument, generates a model file in ```app/models``` and runs ```composer dumpautoload``` for your convenience.

### Creating commands

Commands are made with symfony/console so see their [excellent documentation](http://symfony.com/doc/current/components/console/introduction.html) to get started.

Commands can be stored in app/commands.  To register your new command add it to the ```ste``` file in the root of your project.

## Changelog

### 2.0-alpha

* Updated to work with Slim 2.5 from 2.3
* Removed twig-extensions dependency
* Switched migrations to Phinx
* Added Whoops dependency
* Added gulp for assets
* Added two commands: ```serve``` and ```model:make```
