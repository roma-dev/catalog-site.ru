<?php

namespace Frontend\models;

use Engine\Catalog;

class Category {
	
	private $tableName = 'category';
	
	public function selectAll()
	{
		// формирует sql для выборки
		// берутся параметры из гет запроса 
		Catalog::$app->db->sqlBuilder()
			->select('*')
			->from($this->tableName)
			->where('active = 1')
			->orderBy('id DESC')
			->limitPagination()
			->forSelect();
		
		$result = Catalog::$app->db->select();
		
		// если пустой массив значит нет категорий для текущей страницы пагинации
		if($result == []) Catalog::$app->httpHeader->error(404, 'Такой страницы не существует! ');
		
		// необходимо для пагинации
		$counts = Catalog::$app->db->selectOne(Catalog::$app->db->sqlBuilder()->sqlForCount());
		// сохраняем количество строк в свойство
		Catalog::$app->settings = ['counts', $counts['rows'] ];
		
		return $result;
	}
	
	public function selectOne($id)
	{
		Catalog::$app->db->sqlBuilder()
			->select('*')
			->from($this->tableName)
			->where('id = '.$id)
			->forSelect();
		
		$result = Catalog::$app->db->selectOne();
		
		if($result === []) return false;
		
		return $result;
	}
	
	// выдает все
	public function selectCategories($id_good)
	{
		// нам нужно найти все категории товара
		$modelCatGood = new CategoryGood();
		
		$result = $modelCatGood->selectIdCategories($id_good);
		
		// если false то выдаем пустой массив
		if(!$result) return [];
	
		// строка для конструкции IN ( ... )
		$in = implode(", ", $result);
		
		Catalog::$app->db->sqlBuilder()
			->select('id, name')
			->from($this->tableName)
			->where('id IN ('.$in.')')
			->limitPagination()
			->forSelect();
		
		$categories = Catalog::$app->db->select();
		
		return $categories;
	}
	
}
