<?php
session_cache_limiter(false);
session_start();
/* Get PHP Dependancies */
require_once 'vendor/autoload.php';
 
/* Get Configuration */
require_once __DIR__.'/config.php';
 
require_once __DIR__.'/'.APP_FOLDER.'application.php';
 
require_once __DIR__.'/'.APP_FOLDER.'routes.php';
 
$app->run();
