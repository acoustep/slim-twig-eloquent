# Slim, Twig & Eloquent

This is a very bare bones template for using the following:

* Slim
* Slim Views
* Twig
* Eloquent
* Illuminate\Validation

## Installation

Run ```git clone https://github.com/acoustep/slim-twig-eloquent.git``` then in terminal run ```composer install```

Rename ```config.example.php``` to ```config.php``` and edit your application settings.

Make sure your ```.htaccess``` RewriteBase points to the right location (default is ```/public``` for development but you'll probably want to switch it to ```/``` for production or if you use virtual hosts).

## Usage

Put your models in ```app/models```, your templates in ```app/views``` and your routes in ```app/routes.php```.

Make sure to run ```composer update``` after you create a new model.

## To do

* Example
* Migrations