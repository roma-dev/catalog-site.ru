<?php

use Engine\Catalog;
use Engine\Request;

// минусуем из строки подстроку frontend
define('ROOT_DIR', substr(__DIR__, 0, -8 ));

require_once __DIR__ . '/../vendor/autoload.php';

$config		= require_once __DIR__. '/config/config.php';
$rules		= require_once __DIR__. '/config/rules.php';

Catalog::init($config);

Catalog::$app->rules = $rules;

Catalog::$app->request = new Request();

Catalog::$app->goAction();
