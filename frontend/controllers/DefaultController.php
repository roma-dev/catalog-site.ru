<?php

namespace Frontend\controllers;

use Engine\Catalog;

class DefaultController {

	public function index($id, $page)
	{
		echo Catalog::$app->view->render('index', ['id'=> $id, 'page' => $page]);
	}
			
}
