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
		Catalog::$app->settings = ['counts', $counts['rows'] ];
		
		return $result;
	}
	
	public function selectCategory($id)
	{
		Catalog::$app->db->sqlBuilder()
				->select('*')
				->from($this->tableName)
				->where('id='.$id.'')
				->forSelect();
		
		$result = Catalog::$app->db->selectOne();
		
		return $result;
		
	}
	
	
	public function createCategory($post)
	{
		$columns = "id, name, short_description, full_description, active";
		$values = "null, ".$post['name'].", ".$post['short_description'].", ".$post['full_description'].", ".$post['active'];
		
		Catalog::$app->db->sqlBuilder()
			->tableName($this->tableName)
			->columns($columns)
			->values($values)
			->forInsert();
		
		$result = Catalog::$app->db->insertOne();
		
		// при успешной операции вернет 1, при ошибке выбросит ошибку
		return $result;
		
	}
	
	
	public function updateCategory($post)
	{
		Catalog::$app->db->sqlBuilder()
			->tableName($this->tableName)
			->set(
				[
					'name'				=> [ $post['name'],					true  ], 
					'short_description' => [ $post['short_description'],	true  ], 
					'full_description'	=> [ $post['full_description'],		true  ], 
					'active'			=> [ $post['active'],				false ]
				])
			->where("id = ".$post['id'])
			->forUpdate();
		
		$result = Catalog::$app->db->update();
		
		// при успешной операции вернет 1, при ошибке выбросит ошибку
		return $result;
	}

	
	public function selectNameCategories()
	{
		$sql = Catalog::$app->db->sqlBuilder()
			->select('id, name')
			->from($this->tableName)
			->orderBy('id ASC')
			->forSelect();
		
		$result = Catalog::$app->db->select();
		
		return $result;
	}


	public function __get($name) {
		return $this->$name;
	}
}
