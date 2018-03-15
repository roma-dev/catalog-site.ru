<?php

namespace Backend\controllers;

use Engine\Catalog;

class DefaultController {

	public function dashboard($id, $page)
	{
		echo Catalog::$app->view->render('dashboard', ['id'=> $id, 'page' => $page]);
	}

	public function login($id, $page)
	{
		echo Catalog::$app->view->render('login', ['id'=> $id, 'page' => $page]);
	}

	public function logout($id, $page)
	{
		echo Catalog::$app->view->render('logout', ['id'=> $id, 'page' => $page]);
	}
			
}
