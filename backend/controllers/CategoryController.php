<?php

namespace Backend\controllers;

use Backend\models\Category;
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
		$model = new Category();
		
		$result = $model->selectCategories();
		
		return Catalog::$app->view->render('categories', ['result' => $result]);
	}
	
	public function view($id, $page)
	{
		return Catalog::$app->view->render('view', ['id'=> $id, 'page' => $page]);
	}
	
	public function update($id, $page)
	{
		return Catalog::$app->view->render('update', ['id'=> $id, 'page' => $page]);
	}
	
	public function create($id, $page)
	{
		return Catalog::$app->view->render('create', ['id'=> $id, 'page' => $page]);
	}
	
}
