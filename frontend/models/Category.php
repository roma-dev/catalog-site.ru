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
		
		if(!is_array($result) && empty($result)) return false;
		
		$counts = Catalog::$app->db->selectOne(Catalog::$app->db->sqlBuilder()->sqlForCount());
		
		// сохраняем количество строк в свойство
		$this->counts = $counts['rows'];
		
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
	
	
}
