<?php

namespace Engine;

class Request {
	
	private $controller;
	private $action;
	private $id;
	private $page;
	
	public function __construct() 
	{
		if (! $this->checkPath()) { Catalog::$app->httpHeader->error('404', 'Такой страницы не существует!'); }
		
		$this->controller = Catalog::$app->rules[ $this->getPath() ]['controller'];
		$this->action = Catalog::$app->rules[ $this->getPath() ]['action'];
		$this->id = isset($_GET['id']) ? $_GET['id'] : null; 
		$this->page = isset($_GET['page']) ? $_GET['page'] : null; 
		
	}

	/**
	 * 
	 * @return alias пример /category
	 */
			
	private function getPath()
	{
		return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}

	/**
	 * 
	 * @return bool Проверяет на наличие адреса в массиве rules
	 */
	
	private function checkPath()
	{
		return isset( Catalog::$app->rules[ $this->getPath() ] ) ? TRUE : FALSE ;
	}	
	
	public function __get($name) 
	{
		return $this->$name;
	}
}
