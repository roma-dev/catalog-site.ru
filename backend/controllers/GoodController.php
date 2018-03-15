<?php

namespace Backend\controllers;

use Engine\Catalog;

class GoodController {
	
	private $viewsPath = 'backend/views/good';

	public function __construct() 
	{
		// меняем директорию видов для нашего контроллера
		Catalog::$app->settings = [ 'viewsPath', $this->viewsPath];
	}
	
	public function goods($id, $page)
	{
		echo Catalog::$app->view->render('goods', ['id'=> $id, 'page' => $page]);
	}
	
	public function view($id, $page)
	{
		echo Catalog::$app->view->render('view', ['id'=> $id, 'page' => $page]);
	}
	
	public function update($id, $page)
	{
		echo Catalog::$app->view->render('update', ['id'=> $id, 'page' => $page]);
	}
	
	public function create($id, $page)
	{
		echo Catalog::$app->view->render('create', ['id'=> $id, 'page' => $page]);
	}
	
}