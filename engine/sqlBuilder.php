<?php

namespace Engine;

class sqlBuilder {
	
	private static $builder = null;
	
	private $sql;

	private $select = '*';
	private $from;
	private $where;
	private $orderBy;
	private $limit;
	
	private $tableName;
	private $columns;
	private $values;
	
	private $set;


	// singleton
	public static function init() 
	{
		if (null === self::$builder)
		{
			self::$builder = new self();
		}
		return self::$builder;
	}
	
	public function sql($param='')
	{	
		if($param === null) { $this->sql = null; }
		return $this->sql;
	}
		
//------------------------------------------------	
	public function select($string = '*')
	{
		$this->select = $string ? $string : '*';
		return self::$builder;
	}
	
	public function from($string = '')
	{
		$this->from = $string ? $string : '';
		return self::$builder;
	}
	public function where($string = '')
	{
		$this->where = $string ? $string : '';
		return self::$builder;
	}
	public function orderBy($string = '')
	{
		$this->orderBy = $string ? $string : '';
		return self::$builder;
	}
	public function limit($string = '')
	{
		$this->limit = $string ? $string : '';
		return self::$builder;
	}

// получает ассоциативный массив, может распознать числовые и строковые значения
// 
//	Catalog::$app->db->sqlBuilder()
//		->select('name')
//		->from('category')
//		->orWhereParams(['id' => 5, 'name' => '%string%'])
//		->orderBy('name DESC')
//		->forSelect();
//	
//	создаст строку вида 
//	SELECT name FROM category WHERE `id` = 5 OR `name` LIKE "%string%" ORDER BY name DESC
			
	public function orWhereParams( $args = [])
	{
		$returnString = '';
		
		foreach ($args as $column => $value)
		{
			// если переменная не числовая, то экранируем кавычками
			if(!is_numeric($value)){ 
				$returnString .= $value = '`'.$column . '`' . ' LIKE "'. $value . '" OR '; 
				continue;
			}
			
			$returnString .= '`'.$column . '` = ' . $value . ' OR ' ;
		}
		
		$returnString = rtrim($returnString, ' OR');
		
		$this->where = $returnString ? $returnString : '';
		
		return self::$builder;
		
	}


//	пример строителя запросов для выборки
//	
//	Catalog::$app->db->sqlBuilder()
//			->select('name')
//			->from('category')
//			->where('name="категория"')
//			->orderBy('name DESC')
//			->forSelect();
//	
//	формирует запрос вида 
//	SELECT name FROM category WHERE name="категория" ORDER BY name DESC
	
	// строитель запроса для чтения из бд
	public function forSelect()
	{
		if( !$this->select )	{ return false; }
		if( !$this->from )		{ return false; }
		
		$sql  =	'SELECT ' . $this->select . ' ';
		$sql .=	'FROM ' . $this->from . ' ';
		$sql .= $this->where ? 'WHERE ' . $this->where . ' ' : '';
		$sql .= $this->orderBy ? 'ORDER BY ' . $this->orderBy . ' ' : '' ;
		$sql .= $this->limit ? 'LIMIT ' . $this->limit : '';
		
		// обнуление переменных
		$this->select = '*';
		$this->orderBy = 'DESC';
		$this->from = $this->where = $this->limit = null;
		
		$this->sql = $sql;
		return $sql;
	}

//---------------------------------------------------------
	
	public function tableName($table)
	{
		$this->tableName = $table;
		return self::$builder;
	}
	
	public function columns($columns)
	{
		$this->columns = $columns;
		return self::$builder;
	}
	
	public function values($values)
	{
		$this->values = $values;
		return self::$builder;
	}

//	пример построения запроса для вставки
//	
//	Catalog::$app->db->sqlBuilder()
//		->tableName('category')
//		->columns('id, name, active')
//		->values('33, категория, 1')
//		->forInsert();
//	
//	или
//	
//	Catalog::$app->db->sqlBuilder()
//		->tableName('category')
//		->forInsert(
//			[
//				'id'		=> '33',
//				'name'		=> '',
//				'active'	=> '1'
//			]);	
// 
//	эти конструкции формируют следующий sql запрос
//	INSERT INTO category (`id`,`name`,`active`) VALUES ("33","категория","1")
	

	public function forInsert($args = null)
	{
		if( !$this->tableName ) { return false; }
		if( is_array($args) )	 { $this->parseParamsArray($args); }
		if( !$this->columns )	 { return false; }
		if( !$this->values )	 { return false; }
		
		$sql  = 'INSERT INTO ' . $this->tableName . ' ';
		$sql .= '('. $this->parseParamsString($this->columns) . ') ';
		$sql .= 'VALUES ('. $this->parseParamsString($this->values,'"') . ')';

		$this->tableName = $this->columns = $this->values = null;
		
		$this->sql = $sql;
		return $sql;

	}
	
	// парсит строку и добавляет нужные кавычки
	private function parseParamsString($stringParams, $quotes='`')
	{
		$arrayParams = explode(',', $stringParams);
		
		$returnString = '';
		
		foreach ($arrayParams as $param)
		{
			$returnString .= $quotes . trim($param) . $quotes . ',';
		}
		
		return rtrim($returnString, ',');
	}

	// парсит асс. массив колонок и значений и добавляет переменные в свои свойства класса
	private function parseParamsArray($args)
	{
		foreach ($args as $column => $value)
		{
			$this->columns	.= $column	. ',';
			$this->values	.= $value	. ',';
		}
		$this->columns = rtrim($this->columns, ',');
		$this->values  = rtrim($this->values, ',');
		
	}

// ----------------------------------------------	

	public function set($args = [])
	{
		foreach ($args as $column => $value)
		{
			$this->set .= '`' . $column . '` = "' . $value . '", ';
		}
		
		$this->set = rtrim($this->set, ', ');
		
		return self::$builder;
	}

//	пример строителя запроса для обновления строк
//	
//	Catalog::$app->db->sqlBuilder()
//			->tableName('category')
//			->set(['name' => 'Другое название категории', 'active' => '5'])
//			->where('name="Категория"')
//			->forUpdate();
//	
//	формирует следующий запрос:
//	UPDATE category SET `name` = "Другое название категории", `active` = "5" WHERE name="Категория"

	public function forUpdate()
	{
		if( !$this->tableName ) { return false; }
		if( !$this->set )		{ return false; }
		
		$sql  = 'UPDATE ' . $this->tableName . ' ';
		$sql .= 'SET ' . $this->set . ' ';
		$sql .= $this->where ? 'WHERE ' . $this->where . ' ' : '';

		$this->tableName = $this->set = $this->where = null;
		
		$this->sql = $sql;		
		return $sql;
	}

// ----------------------------------------------

//	пример построения запроса для удаления
//	
//	Catalog::$app->db->sqlBuilder()
//			->from('category')
//			->where('name="hedldsdvlo"')
//			->forDelete();
//	
//	формирует строку:
//	DELETE FROM category WHERE name="hedldsdvlo"	
	
	public function forDelete()
	{
		if( !$this->from )		{ return false; }
		
		$sql  = 'DELETE FROM ' . $this->from . ' ';
		$sql .= $this->where ? 'WHERE ' . $this->where . ' ' : '';

		$this->from = $this->where = null;

		$this->sql = $sql;		
		return $sql;
	}
	
// ----------------------------------------------	
	private function __construct(){}
	private function __clone(){}
}