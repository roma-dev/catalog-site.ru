<?php

namespace Backend\controllers;

use Backend\models\User;
use Engine\Catalog;

class DefaultController {

	public function dashboard($id, $page)
	{
		return Catalog::$app->view->render('dashboard', ['id'=> $id, 'page' => $page]);
	}

	public function login()
	{
		// переназначаем макет для рендеринга страницы логин
		Catalog::$app->settings = ['layoutView', 'LoginLayout' ];
		
		// если нет пост данных рендерим страницу
		if(!isset($_POST['name']) && !isset($_POST['password'])) 
		{
			return Catalog::$app->view->render('login');
		}
		
		$user = new User();
		
		// если пользователя не нашлось в таблице user. рендерим. и выводим сообщение об ошибке.
		if( !$user->selectUser(['name', $_POST['name']]) ) 
		{
			return Catalog::$app->view->render('login', ['error' => 'Пользователя с таким именем не найдено!']);
		}
		
		// Проверяем на правильность введеный пароль, если неверный то выводим сообщение
		if($user->password != $_POST['password'])
		{
			return Catalog::$app->view->render('login', ['error' => 'Введен неверный пароль!']);
		}
		
		// проверяем роль посетителя, если у него права админа то логиним его
		if($user->role == 'admin')
		{
			echo 'Данные верны! Вы попали в админку'; die;
		}
		
		// если у пользователя нет прав админа то рендерим с выводом ошибки
		return Catalog::$app->view->render('login', ['error' => 'У вас нет достаточно прав для входа в админку!']);
	}

	public function logout()
	{
		return Catalog::$app->view->render('logout', ['id'=> $id, 'page' => $page]);
	}
			
}
