# Slim, Twig & Eloquent

## In development

This branch is very much in early development.  If you're looking for something more stable please switch to the master branch.

## Installation

In ```app/config.php``` edit the environments variable to use your computer's ```hostname``` for development.  By default if the hostname is not found it will use your production settings.

Rename ```phinx.example.yml``` to ```phinx.yml``` and edit your settings accordingly.

### Gulp

Setting up gulp for compiling your assets will require Node and NPM.

```npm install```

By default running ```gulp``` will watch and compile the following:

* ```app/assets/javascripts/**/*.js``` to ```public/js/application.js```
* ```app/assets/sass/**/*.scss``` to ```public/css/**/*.css```
* ```app/assets/less/**/*.scss``` to ```public/css/**/*.css```

#### Switching from Javascript to Coffeescript

As a Coffeescript user I've made it super simple to use it instead of javascript.

Just run ```gulp coffee``` instead of the default ```gulp```.

Note that Coffeescript files get written to the javascript directory first which will overwrite any files with the same name.

#### SASS / LESS

You should be able to use either out of the box.  Both get compiled with ```gulp``` and ```gulp coffee```. However using both at the same time will obviously cause clashes. 

## Gotchas

Add ```use Illuminate\Database\Eloquent\Model as Eloquent;``` to the top of your models.

Make sure you run ```composer dumpautoload``` after creating new models.

## Model and validation example

```
<?php
// app/models/User.php
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {

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


## Changelog

* Updated to work with Slim 2.5 from 2.3
* Removed twig extensions dependency
* Switched migrations to Phinx
* Added Whoops dependency
* Added gulp for assets
