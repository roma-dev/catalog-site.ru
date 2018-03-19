<?php

namespace Backend\controllers;

use Backend\models\Category;
use Backend\models\CategoryGood;
use Backend\models\Good;
use Engine\Catalog;

class GoodController {
	
	private $viewsPath = 'backend/views/good';

	public function __construct() 
	{
		// меняем директорию видов для нашего контроллера
		Catalog::$app->settings = [ 'viewsPath', $this->viewsPath];
	}
	
	public function goods($id, $page)
	{
		$model = new Good();
		
		$result = $model->selectGoods();
		
		return Catalog::$app->view->render('goods', ['result' => $result]);
	
	}
	
	public function view($id)
	{
		$model = new Good();
		
		$result = $model->selectGood($id);
		
		if(!$result) Catalog::$app->httpHeader->error(404,'Такого товара не существует!');
		
		$modelCategoryGood = new CategoryGood();

		$currentCategories = $modelCategoryGood->selectCategories($id);

		$modelCategory = new Category();

		$categories = $modelCategory->selectNameCategories();
		
		return Catalog::$app->view->render('view', ['currentCategories' => $currentCategories, 'good' => $result]);
	}
	
	public function update($id)
	{
		
		if(!isset($id)) Catalog::$app->httpHeader->error(404, 'Ошибка! Не был передан id товара! ');
		
		// если нет пост данных
		if(!isset($_POST['Good']))
		{
			$model = new Good();

			$good = $model->selectGood($id);

			// вернет false если не найдет записи по id
			if(!$good) Catalog::$app->httpHeader->error(404, 'Такого товара не существует! ');

			// все это правильнее сделать черех join но пока так
			$modelCategoryGood = new CategoryGood();

			$currentCategories = $modelCategoryGood->selectCategories($id);

			$modelCategory = new Category();

			$categories = $modelCategory->selectNameCategories();

			// передаем в вид категории товара, массив самого товара и список всех категорий
			return Catalog::$app->view->render('update', ['currentCategories' => $currentCategories, 'good' => $good, 'categories' => $categories]);
		}
		
		$modelGood = new Good();
		
		$result = $modelGood->updateGood($_POST['Good']);
		
		// пока обновление списка категорий товара не реализовано
		//$category_good = new CategoryGood();
		//$category_good->createCategoryId( $id, $_POST['Good']['category_id'] );
		
		// редиректим на страницу вида товара
		Catalog::$app->httpHeader->redirect('/admin/good/view?id='.$id, 302);
	
	}
	
	public function create()
	{
		// если нет пост данных
		if(!isset($_POST['Good']))
		{ 
			$modelCategory = new Category();

			$arrCategories = $modelCategory->selectNameCategories();
			
			return Catalog::$app->view->render('create', ['categories' => $arrCategories]); 
		}

		$modelGood = new Good();
		
		$result = $modelGood->createGood($_POST['Good']);
		
		// будет равен 1 если товар был создан
		if($result == 1)
		{
			// сохраняем айди товара, а то его следующий инсерт перетрет
			$goodId = Catalog::$app->db->lastId();
			$category_good = new CategoryGood();
			
			$category_good->createCategoryId( $goodId, $_POST['Good']['category_id'] );
			
			// редиректим на страницу вида товара
			Catalog::$app->httpHeader->redirect('/admin/good/view?id='.$goodId, 302);
			
		}
		
		// если мы тут то что-то пошло не так
		return Catalog::$app->view->render('create', ['categories' => $arrCategories, 'errorMessage' => 'При создании товара что-то пошло не так!']);
	}
	
}