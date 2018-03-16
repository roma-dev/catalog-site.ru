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
	
	
	public function insert($sql = null)
	{
		// проверка переданного значения и свойства объекта билдера
		if($sql === null) {$sql = $this->sqlBuilder->sql();}
		if(!$sql){ return false; }
		
		try 
		{
			// открытие транзакции
			$this->connection->beginTransaction();
		
			// отправляем запрос в бд	
			$countRows = $this->connection->exec($sql);
			
			// в случае успешного исхода фиксируем транзакцию
			$this->connection->commit();
			
			//обнуляем свойство
			$this->sqlBuilder->sql(null);
			
			return $countRows;
        } 
		catch (PDOException $error) 
		{
			// в случае возникновения ошибки откатываем изменения
            $this->connection->rollBack();
			
			
			Catalog::$app->httpHeader->error(500, $error->getMessage());
        }
		
	}
	
	
	
}
