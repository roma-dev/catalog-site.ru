<?php
session_start();

ini_set('display_errors',1);
error_reporting(E_ALL);

use Engine\Catalog;
use Engine\Request;

// минусуем из строки подстроку backend
define('ROOT_DIR', substr(__DIR__, 0, -7 ));

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__. '/config/config.php';
$rules = require_once __DIR__. '/config/rules.php';

Catalog::init($config);

Catalog::$app->rules = $rules;

Catalog::$app->request = new Request();

Catalog::$app->goAction();