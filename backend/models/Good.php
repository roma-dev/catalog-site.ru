<?php
namespace Backend\models;

use Engine\Catalog;

class Good {
	
	private $tableName = 'goods';
	
	private $searchColumns =  [ 'name', 'short_description', 'active', 'count', 'is_available' ];
			
	private $counts;
	
	public function counts()
	{
		return $this->counts;
	}
	
	public function selectGoods()
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
		
		// для пагинации
		$counts = Catalog::$app->db->selectOne(Catalog::$app->db->sqlBuilder()->sqlForCount());
		// сохраняем количество строк в свойство
		Catalog::$app->settings = ['counts', $counts['rows'] ];
		
		return $result;
	}

	public function createGood($post)
	{
		$columns = "id, name, short_description, full_description, active, count, is_available";
		$values = "null, ".$post['name'].", ".$post['short_description'].", ".$post['full_description'].", ".$post['active'].", ".$post['count'].", ".$post['is_available'];
		
		$sql = Catalog::$app->db->sqlBuilder()
			->tableName($this->tableName)
			->columns($columns)
			->values($values)
			->forInsert();
		
		$result = Catalog::$app->db->insertOne();
		
		// при успешной операции вернет 1, при ошибке выбросит ошибку
		return $result;
	}
	
	public function selectGood($id)
	{
		Catalog::$app->db->sqlBuilder()
			->select('*')
			->from($this->tableName)
			->where('id='.$id)
			->orderBy('id ASC')
			->forSelect();
		
		$result = Catalog::$app->db->selectOne();
		
		return $result;
		
	}
	
	public function updateGood($post)	
	{
		Catalog::$app->db->sqlBuilder()
			->tableName($this->tableName)
			->set(
				[
					'name'					=> [ $post['name'],					true  ], 
					'short_description'		=> [ $post['short_description'],	true  ], 
					'full_description'		=> [ $post['full_description'],		true  ], 
					'active'				=> [ $post['active'],				false ],
					'count'					=> [ $post['count'],				false ],
					'is_available'			=> [ $post['is_available'],			false ]
				])
			->where("id = ".$post['id'])
			->forUpdate();
		
		$result = Catalog::$app->db->update();
		
		// при успешной операции вернет 1, при ошибке выбросит ошибку
		return $result;
	}
	
}
