<?php

namespace Backend\models;

use Engine\Catalog;

class Category {
	
	private $tableName = 'category';
	
	private $searchColumns =  [ 'name', 'short_description', 'active' ];
			
	private $counts;
	
	public function counts()
	{
		return $this->counts;
	}

	public function selectCategories()
	{
		// формирует sql для выборки
		// берутся параметры из гет запроса 
		Catalog::$app->db->sqlBuilder()
			->select('*')
			->from($this->tableName)
			->andWhereParams(Catalog::$app->request->get, $this->searchColumns)
			->orderBy('id ASC')
			->limitPagination()
			->forSelect();
		
		$result = Catalog::$app->db->select();
		
		if(!is_array($result) && empty($result)) return false;
		
		$counts = Catalog::$app->db->selectOne(Catalog::$app->db->sqlBuilder()->sqlForCount());
		
		// сохраняем количество строк в свойство
		$this->counts = $counts['rows'];
		
		return $result;
	}
	
	public function __get($name) {
		return $this->$name;
	}
}
