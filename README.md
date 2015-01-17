# Slim, Twig & Eloquent

## In development

This branch is very much in early development.  If you're looking for something more stable please switch to the master branch.

## Installation

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

## Changelog

* Updated to work with Slim 2.5 from 2.3
* Removed symfony console dependency
* Removed twig extensions dependency
* Switched migrations to Phinx
* Added symfony/Yaml dependency for Phinx
* Added Whoops dependency
* Added gulp for assets
