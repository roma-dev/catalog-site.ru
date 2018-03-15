<?php
namespace Engine;

use Frontend\controllers;

class Catalog
{
	static $app = null;
	
	private $services = [];	
	
	public static function init($config) 
	{
		if (null === self::$app)
		{
			self::$app = new self();
			self::$app->services['settings'] = $config;
			self::$app->services['httpHeader'] = new HttpHeader();
			self::$app->services['rules'] = require_once 'config/rules.php';
		}
		return self::$app;
	}
	
	public function __set($name, $value) 
	{

		self::$app->services[$name] = $value;
	}


	public function __get($name)
	{
		return self::$app->services[$name];	
	}
	
	
	public function goAction()
	{
		$controller = '\\Frontend\\controllers\\' . self::$app->services['request']->controller;
		
		$action = self::$app->services['request']->action;
		$id = self::$app->services['request']->id;
		$page = self::$app->services['request']->page;
		
		// если по какой-то причине не произойдет вызов экшена то отдаем код сервера "Внутренняя ошибка сервера"
		if (! call_user_func_array( [ new $controller(),  $action], [ $id, $page ]) ) 
		{
			self::$app->httpHeader->error(500);
		}	
	}

	

	private function __construct(){}
	private function __clone(){}
}