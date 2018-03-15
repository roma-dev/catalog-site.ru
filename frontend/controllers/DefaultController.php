<?php

namespace Frontend\controllers;

use Engine\Catalog;

class DefaultController {

	public function index($id, $page)
	{
		Catalog::$app->view->render('index', ['id'=> $id, 'page' => $page]);
	}
			
}
