<?php
namespace Engine;

class Catalog
{
	static $app = null;
	
	private $services = [];	
	
	public static function singleton($config) 
	{
		if (null === self::$app)
		{
			self::$app = new self();
			self::$app->services['settings'] = $config;
			
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
	
	
	private function __construct(){}
	private function __clone(){}
}