<?php

namespace Frontend\controllers;

use Frontend\models\Category;
use Engine\Catalog;
use Frontend\models\Good;

class GoodController {
	
	public function index($id)
	{
		// если не передан айди категории
		if(!isset($id)) Catalog::$app->httpHeader->error(404, 'Такой страницы не существует! ');
		
		$goodModel = new Good();
		
		$good = $goodModel->selectOne($id);
		
		// если false значит что категории нет в бд
		if(!$good) Catalog::$app->httpHeader->error(404, 'Такого товара не существует! ');
		
		$modelCategory = new Category();
		
		$categories = $modelCategory->selectCategories($id);
		
		return Catalog::$app->view->render('good', ['categories' => $categories, 'good' => $good, 'id'=> $id]);
	
	}
}
