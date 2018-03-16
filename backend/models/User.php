<?php

namespace Backend\models;

use Engine\Catalog;

class User {
	
	private $tableName = 'user';

	private $name;
	private $password;
	private $role;
	
	public function selectUser($args = [])
	{
		Catalog::$app->db->sqlBuilder()
			->select('*')
			->from($this->tableName)
			->where("`".$args[0]."`='$args[1]'")
			->forSelect();
		
		$result = Catalog::$app->db->selectOne();
		
		if(!is_array($result) && empty($result)) return false;
		
		$this->name = $result['name'];
		$this->role = $result['role'];
		$this->password = $result['password'];
		
		return true;
	}
	
	public function checkPassword()
	{
		
	}
	
	public function __get($name) {
		return $this->$name;
	}
}
