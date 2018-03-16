<?php

namespace Backend\controllers;

use Backend\models\User;
use Engine\Catalog;

class DefaultController {

	public function dashboard($id, $page)
	{
		return Catalog::$app->view->render('dashboard', ['id'=> $id, 'page' => $page]);
	}

	public function login($id, $page)
	{
		$user = new User();
		// если пользователя не нашлось в таблице user
		if( !$user->selectUser('administrator') ) 
		{
			return Catalog::$app->view->render('login', ['id'=> $id, 'page' => $page]);
		}
		
		var_dump($user->name); die;
		
	}

	public function logout($id, $page)
	{
		return Catalog::$app->view->render('logout', ['id'=> $id, 'page' => $page]);
	}
			
}
