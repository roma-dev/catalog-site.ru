<?php

namespace Backend\models;

use Backend\models\Category;
use Engine\Catalog;

class CategoryGood {
	
	private $tableName = 'category_goods';
	
	public function createCategoryId($id_good, $arr_category_id)
	{
		// INSERT INTO `category_goods` (`category_id`, `goods_id`) VALUES ('14', '1'), ('3', '1');
		$values = '';
		
		foreach ($arr_category_id as $category_id)
		{
			$values .= "('$category_id', '$id_good'), ";
		}
		
		$values = rtrim($values, ', ');
		
		$sql = 'INSERT INTO `' . $this->tableName . '` (`category_id`, `goods_id`) VALUES ' . $values;
		
		$result = Catalog::$app->db->insert($sql);
		
		return $result;
	}
	
	
	// передается id товара
	// возвращаться должен массив категория имя = айди
	public function selectCategories($id){
		
		$sql = Catalog::$app->db->sqlBuilder()
			->select('category_id')
			->from($this->tableName)
			->where('goods_id='.$id)
			->orderBy('category_id ASC')
			->forSelect();
		
		
		$result = Catalog::$app->db->select();
		
		if(!$result) return false;
		
		//$result = Array ( [0] => Array ( [category_id] => 1 ) [1] => Array ( [category_id] => 9 ) )

		$resultArr = [];
		
		foreach ($result as $res)
		{
			$sql = 'SELECT `name` FROM category WHERE id = '.$res['category_id'];
			$resultCategory = Catalog::$app->db->selectOne($sql);
			$resultArr[] = [ 'id' => $res['category_id'], 'name' => $resultCategory['name'] ];
		}
		
		return $resultArr;
	}
}
