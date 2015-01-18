<?php
require '../vendor/autoload.php';
$app = new \Slim\Slim([
  'debug' => true,
  'cache' => dirname(__FILE__) . '/cache',
  'view' => new \Slim\Views\Twig(),
  'templates.path' => '..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR,
]);

$app->view->parserExtensions = array(
  new \Slim\Views\TwigExtension(),
);

$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);


require __DIR__.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'routes.php';

$app->run();
