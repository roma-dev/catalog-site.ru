<?php
namespace Engine;

class Catalog
{
	static $app = null;
	
	private $services = [];	
	
	public static function init($config) 
	{
		if (null === self::$app)
		{
			self::$app								= new self();
			self::$app->services['settings']		= $config;
			self::$app->services['httpHeader']		= new HttpHeader();
			self::$app->services['accessControl']	= new AccessControl();
			self::$app->services['view']			= new View();
			self::$app->services['rules']			= require_once 'config/rules.php';
		}
		return self::$app;
	}
	
	public function __set($name, $value) 
	{
		// если происходит попытка установить значение в массив settings
		// пример Catalog::$app->settings = ['name', 'value']
		if($name == 'settings')
		{
			// проверяем что это правильный массив
			if( !is_array($value) or (count($value) != 2) or !isset($value[0]) or !isset($value[1]) )
			{
				self::$app->services['httpHeader']->error(500, 'Ошибка в присвоении');
			}
			// устанавливаем переменную в массив настроек
			self::$app->services['settings'][$value[0]] = $value[1];
			
			return;
		}
			
		self::$app->services[$name] = $value;
	}


	public function __get($name)
	{
		return self::$app->services[$name];	
	}
	
	
	public function goAction()
	{
		$controller = self::$app->services['settings']['controllerNamespace'] . self::$app->services['request']->controller;
		$action = self::$app->services['request']->action;
		$id = self::$app->services['request']->id;
		$page = self::$app->services['request']->page;
		
		// если по какой-то причине не произойдет вызов экшена то отдаем код сервера "Внутренняя ошибка сервера"
		if ( call_user_func_array( [ new $controller(),  $action], [ $id, $page ]) === false) 
		{
			self::$app->httpHeader->error(500);
		}	
	}

	

	private function __construct(){}
	private function __clone(){}
}