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
			$returnString .= $quotes . $param . $quotes . ',';
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