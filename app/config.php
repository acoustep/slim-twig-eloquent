<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Yaml\Yaml;

$config = Yaml::parse('../phinx.yml');

// Set your environments to match your computer's hostname
$environments = ['precise32' => 'development'];

// Use production if environment isn't found
if(array_key_exists(gethostname(), $environments))
  $environment = $environments[gethostname()];
else
  $environment = 'production';

/**
 ** Configure the database and boot Eloquent
 ** You can set these in phinx.yml
 **/
$capsule = new Capsule;
$capsule->addConnection(array(
  'driver'    => 'mysql',
  'host'      => $config['environments'][$environment]['host'],
  'database'  => $config['environments'][$environment]['name'],
  'username'  => $config['environments'][$environment]['user'],
  'password'  => $config['environments'][$environment]['pass'],
  'charset'   => $config['environments'][$environment]['charset'],
  'collation' => 'utf8_general_ci',
  'prefix'    => ''
));
$capsule->setAsGlobal();
$capsule->bootEloquent();

// set timezone for timestamps etc
date_default_timezone_set('GMT');
