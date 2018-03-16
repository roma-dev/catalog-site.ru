<?php

namespace Engine;

use PDO;
use PDOException;

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
	
	
	public function select($sql = null)
	{
		// проверка переданного значения и свойства объекта билдера
		if($sql === null) {$sql = $this->sqlBuilder->sql();}
		if(!$sql){ return false; }
		
		try 
		{
			// открытие транзакции
			$this->connection->beginTransaction();
		
			// отправляем запрос в бд и получаем объект PDOStatement
			$statement = $this->connection->query($sql, PDO::FETCH_ASSOC);
			
			// получаем массив для вывода
			$retrunArray = $statement->fetchAll();
			
			// в случае успешного исхода фиксируем транзакцию
			$this->connection->commit();
			
			//обнуляем свойство
			$this->sqlBuilder->sql(null);
			
			return $retrunArray;
        } 
		catch (PDOException $error) 
		{
			// в случае возникновения ошибки откатываем изменения
            $this->connection->rollBack();
			
			Catalog::$app->httpHeader->error(500, $error->getMessage());
        }
	}

	/**
	 * 
	 * @param type $sql
	 * @return boolean false если не найдет строки
	 */
	
	
	public function selectOne($sql = null)
	{
		// проверка переданного значения и свойства объекта билдера
		if($sql === null) {$sql = $this->sqlBuilder->sql();}
		if(!$sql){ return false; }
		
		try 
		{
			// открытие транзакции
			$this->connection->beginTransaction();
		
			// отправляем запрос в бд и получаем объект PDOStatement
			$statement = $this->connection->query($sql, PDO::FETCH_ASSOC);
			
			// получаем массив для вывода
			$retrunArray = $statement->fetch();
			
			// в случае успешного исхода фиксируем транзакцию
			$this->connection->commit();
			
			//обнуляем свойство
			$this->sqlBuilder->sql(null);
			
			return $retrunArray;
        } 
		catch (PDOException $error) 
		{
			// в случае возникновения ошибки откатываем изменения
            $this->connection->rollBack();
			
			Catalog::$app->httpHeader->error(500, $error->getMessage());
        }
	}
}
