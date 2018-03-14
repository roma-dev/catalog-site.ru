<?php
namespace \core;

class Core {

	// экземпляр реестра
	private static $instance;
	
	// массив объектов
	private static $app = [];

	// массив настроек приложение
	private static $config = [];

	public static function singleton() {

		if( !isset( self::$instance ) ) {
	            self::$instance = new self();
	        }

	    return self::$instance;
	}
	
	public function __set($key, $object) {

		require_once($object);
		//создаем объект в массиве объектов
		self::$app[$key] = new $key();
	}


	public function __get($key){
		if ( is_object(self::$app[$key]) ) {
			return self::$app[$key];	
		}
	}

	private function __construct($config){
		self::$config = $config;
	}

	private function __clone(){}
	private function __wakeup(){}
	private function __sleep(){}

}