<?php

namespace Backend\models;

use Engine\Catalog;

class Category {
	
	private $tableName = 'category';
	
	private $searchColumns =  [ 'name', 'short_description', 'active' ];
			
	
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
		
		return $result;
	}
	
	public function __get($name) {
		return $this->$name;
	}
}
