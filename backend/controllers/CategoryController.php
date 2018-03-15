<?php

namespace Backend\controllers;

use Engine\Catalog;

class CategoryController {
	
	private $viewsPath = 'backend/views/category';

	public function __construct() 
	{
		// меняем директорию видов для нашего контроллера
		Catalog::$app->settings = [ 'viewsPath', $this->viewsPath];
	}

	public function categories($id, $page)
	{
		echo Catalog::$app->view->render('categories', ['id'=> $id, 'page' => $page]);
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
