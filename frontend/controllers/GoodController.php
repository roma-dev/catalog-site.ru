<?php

namespace Frontend\controllers;

use Engine\Catalog;

class GoodController {
	
	public function index($id, $page)
	{
		return Catalog::$app->view->render('good', ['id'=> $id, 'page' => $page]);
	}
}
