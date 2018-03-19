<?php

namespace Frontend\models;

use Engine\Catalog;


class Good {
	
	private $tableName = 'goods';
	
	public function selectGoods($id_category)
	{
		$modelCatGood = new CategoryGood();
		
		$result = $modelCatGood->selectIdGoods($id_category);
		
		// если false то выдаем пустой массив
		if(!$result) return [];
	
		// строка для конструкции IN ( ... )
		$in = implode(", ", $result);
		
		Catalog::$app->db->sqlBuilder()
			->select('*')
			->from($this->tableName)
			->where('id IN ('.$in.')')
			->limitPagination()
			->forSelect();
		
		$arrGoods = Catalog::$app->db->select();
		
		return $arrGoods;
		
		//print_r($arrGoods); die;
	}
	
	
	
}
