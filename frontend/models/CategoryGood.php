<?php

namespace Frontend\models;

use Engine\Catalog;

class CategoryGood {
	
	private $tableName = 'category_goods';
	
	public function selectIdGoods($idCategory)
	{
		$sql = 'SELECT goods_id FROM '.$this->tableName.' WHERE category_id = '.$idCategory.' ORDER BY goods_id DESC';
		
		$result = Catalog::$app->db->select($sql);
		
		// если пустой массив выводим false
		if($result === []) return false;
		
		$returnArr = [];
		
		foreach ($result as $good)
		{
			$returnArr[] = $good['goods_id'];
		}
		
		return $returnArr;
	}
			
	public function selectIdCategories($id_good)
	{
		$sql = 'SELECT category_id FROM '.$this->tableName.' WHERE goods_id = '.$id_good.' ORDER BY goods_id DESC';
		
		$result = Catalog::$app->db->select($sql);
		
		// если пустой массив выводим false
		if($result === []) return false;
		
		$returnArr = [];
		
		foreach ($result as $good)
		{
			$returnArr[] = $good['category_id'];
		}
		
		return $returnArr;
	}
	
}
