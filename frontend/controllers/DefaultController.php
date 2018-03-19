<?php

namespace Frontend\controllers;

use Engine\Catalog;
use Frontend\models\Category;

class DefaultController {

	public function index($page)
	{
		$model = new Category();
		
		$result = $model->selectAll();
		
		return Catalog::$app->view->render('index', ['categories' => $result, 'page' => $page]);
	}
			
}
