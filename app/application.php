<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Slim\Slim;

/* Setup Slim with Twig */
$app = new Slim( array( 
  'view' => new \Slim\Views\Twig(),
  'templates.path' => __DIR__ . '/views'
));

// Only invoked if mode is "production"
$app->configureMode( 'production', function () use ( $app ) {
  $app->config( array(
    'log.enable' => true,
    'debug'      => false
  ));
});

// Only invoked if mode is "development"
$app->configureMode( 'development', function () use ( $app ) {
  $app->config(array(
    'log.enable' => false,
    'debug' => true
  ));
});

$view = $app->view();
$view->parserOptions = array(
  'debug' => true,
  'cache' => dirname(__FILE__) . '/views/cache'
);

$view->parserExtensions = array(
  new \Slim\Views\TwigExtension(),
);

/* Connect to Eloquent ORM */
$capsule = new Capsule;
$capsule->addConnection( array(
  'driver' => DB_DRIVER,
  'host' => DB_HOST,
  'database' => DB_DATABASE,
  'username' => DB_USERNAME,
  'password' => DB_PASSWORD,
  'collation' => DB_COLLATION,
  'charset' => DB_CHARSET,
  'prefix' => DB_PREFIX
));
$capsule->bootEloquent();
$capsule->setAsGlobal();

