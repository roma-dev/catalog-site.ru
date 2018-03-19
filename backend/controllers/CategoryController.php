<?php

namespace Backend\controllers;

use Backend\models\Category;
use Engine\Catalog;

class CategoryController {
	
	private $viewsPath = 'backend/views/category';

	public function __construct() 
	{
		// меняем директорию видов для нашего контроллера
		Catalog::$app->settings = [ 'viewsPath', $this->viewsPath];
	}

	public function categories($id, $page)
	{
		$model = new Category();
		
		$result = $model->selectCategories();
		
		return Catalog::$app->view->render('categories', ['result' => $result]);
	}
	
	public function view($id)
	{
		$model = new Category();
		
		$result = $model->selectCategory($id);
		
		if(!$result) Catalog::$app->httpHeader->error(404,'Такой категории не существует!');
		
		return Catalog::$app->view->render('view', ['id'=> $id, 'category' => $result]);
	}
	
	public function update($id)
	{
		$model = new Category();
		
		$result = $model->selectCategory($id);
		
		// если запрашивается айди не существующей категории
		if(!$result) Catalog::$app->httpHeader->error(404, 'Такой категории не существует!');
 
		// если нет пост данных то рендерим страницу
		if(!isset($_POST['Category'])) { return Catalog::$app->view->render('update',[ 'result' => $result]); }
				
		$updateResult = $model->updateCategory($_POST['Category']);
 
		// вернет количество измененых строк в бд. вставляем одну запись значит при успехе $result будет равен 1
		if($updateResult == 1)
		{
			// редиректим на страницу просмотра категории
			Catalog::$app->httpHeader->redirect('/admin/category/view?id='.$result['id'], 302);
		}
		
		// если вернет 0 значит данные не были изменены
		if($updateResult == 0)
		{
			return Catalog::$app->view->render('update', [ 'result' => $result, 'errorMessage' => 'Вы не изменили данные в полях формы!']);
		}
		// если мы тут значит что-то пошло не так
		return Catalog::$app->view->render('update', [ 'result' => $result, 'errorMessage' => 'При обновлении данных что-то пошло не так!']);
	}
	
	public function create()
	{
		// если нет пост данных то рендерим страницу
		if(!isset($_POST['Category'])) { return Catalog::$app->view->render('create'); }
		
		$model = new Category();
		
		$result = $model->createCategory($_POST['Category']);
		
		// вернет количество измененых строк в бд. вставляем одну запись значит при успехе $result будет равен 1
		if($result == 1)
		{
			// редиректим на страницу просмотра категории
			Catalog::$app->httpHeader->redirect('/admin/category/view?id='.Catalog::$app->db->lastId(), 302);
		}

		return Catalog::$app->view->render('create', [ 'errorMessage' => 'При вставки данных что-то пошло не так!']);
	}
	
}
