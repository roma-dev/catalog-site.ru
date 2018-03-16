<?php

namespace Frontend\controllers;

use Engine\Catalog;

class CategoryController {
	
	public function index($id, $page)
	{
		return Catalog::$app->view->render('category', ['id'=> $id, 'page' => $page]);
	}
}
