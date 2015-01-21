<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Yaml\Parser;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;

// Disable Whoops in CLI as it hides exceptions
if(php_sapi_name() !== 'cli') {
  $run     = new Whoops\Run;
  $handler = new PrettyPageHandler;
  $run->pushHandler($handler);
  $run->register();
}

// YAML parser seems to stop the cli from running
$yaml = new Parser();
if(file_exists('phinx.yml'))
  $config_location = 'phinx.yml'; 
elseif(file_exists('..'.DIRECTORY_SEPARATOR.'phinx.yml'))
  $config_location = '..'.DIRECTORY_SEPARATOR.'phinx.yml'; 
else
  throw new Exception("phinx.yml not found. Did you rename phinx.example.yml?");
$config = $yaml->parse(file_get_contents($config_location));


// Set your environments to match your computer's hostname
$environments = ['precise32' => 'development'];

// Use production if environment isn't found
if(array_key_exists(gethostname(), $environments))
  $environment = $environments[gethostname()];
else
  $environment = 'production';

// Sqlite requires a file location and Phinx appends an sqlite3 extension
if($config['environments'][$environment]['adapter'] === 'sqlite')
  $database = '../'.$config['environments'][$environment]['name'].'.sqlite3';
else
  $database = $config['environments'][$environment]['name'];

/**
 ** Configure the database and boot Eloquent
 ** You can set these in phinx.yml
 **/
$capsule = new Capsule;
$capsule->addConnection(array(
  'driver'    => $config['environments'][$environment]['adapter'],
  'host'      => $config['environments'][$environment]['host'],
  'database'  => $database,
  'username'  => $config['environments'][$environment]['user'],
  'password'  => $config['environments'][$environment]['pass'],
  'charset'   => $config['environments'][$environment]['charset'],
  'collation' => 'utf8_general_ci',
  'prefix'    => ''
));
$capsule->setAsGlobal();
$capsule->bootEloquent();

// set timezone for timestamps etc
// date_default_timezone_set('GMT');
