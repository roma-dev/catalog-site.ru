<?php

namespace Frontend\controllers;

use Frontend\models\Category;
use Engine\Catalog;
use Frontend\models\Good;

class CategoryController {
	
	public function index($id, $page)
	{
		// если не передан айди категории
		if(!isset($id)) Catalog::$app->httpHeader->error(404, 'Такой страницы не существует! ');
		
		$categoryModel = new Category();
		
		$category = $categoryModel->selectOne($id);
		
		// если false значит что категории нет в бд
		if(!$category) Catalog::$app->httpHeader->error(404, 'Такой категории не существует! ');
		
		$model = new Good();
		
		// выдаст пустой массив если не будет товаров в категории
		$goods = $model->selectGoods($id);
		
		return Catalog::$app->view->render('category', ['category' => $category, 'goods' => $goods, 'id'=> $id, 'page' => $page]);
	}
}
