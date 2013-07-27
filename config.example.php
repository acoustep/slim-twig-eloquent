<?php
/* Project Title */
define('TITLE', 'App name');
 
/* App folder */
define('APP_FOLDER', 'app/');
 
/* Database driver */
define('DB_DRIVER', 'mysql');
 
/* Database host */
define('DB_HOST', 'localhost');
 
/* Database name */
define('DB_DATABASE', 'test');
 
/* Database username */
define('DB_USERNAME', 'root');
 
/* Database password */
define('DB_PASSWORD', '');
 
/* Database collation */
define('DB_COLLATION', 'utf8_general_ci');
 
/* Database charset */
define('DB_CHARSET', 'utf8');
 
/* Database table prefix */
define('DB_PREFIX', '');
 
define('PUBLIC_FOLDER', 'public/');
 
define('BASE_URL', 'http://localhost/project/');
 
/* define environment */
$_ENV['SLIM_MODE'] = 'development';
 
/* Configuration - If you wish to either override or set specific options for different environments */
// require_once APP_FOLDER.'config/'.$_ENV['SLIM_MODE'].'.php';
 
/* All variables you wish to pass to the template must go in the $data array */
$data['title'] = TITLE; 
$data['public_folder'] = PUBLIC_FOLDER;
$data['base_url'] = BASE_URL;
