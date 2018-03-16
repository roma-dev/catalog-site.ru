<?php

namespace Engine;

class Mysql extends MysqlConnect{
	
	private $sqlBuilder;
	
	public function __construct($config) {
		parent::__construct($config);
		
		$this->sqlBuilder = sqlBuilder::init();
	}
	
	public function sqlBuilder()
	{
		return $this->sqlBuilder;
	}
}
