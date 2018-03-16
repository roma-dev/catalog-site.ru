<?php

namespace Engine;

use PDO;
use PDOException;

class MysqlConnect {
	
	// объект класса PDO
    protected static $connection;

//    public static function connection()
//    {
//        return static::$connection;
//    }
	
	public function __get($name) {
		return static::$connection;
	}


	public function __construct($config)
	{
		$user = $config['user'];
		
		$password = $config['password'];
		
		$dsn =  $config['driver'] . ':'
				. 'host='	 . $config['host'] . ';'
				. 'dbname='	 . $config['dbname'] . ';'
				. 'charset=' . $config['charset'];
				
		$options    = [
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
        ];
		//'mysql:host=localhost;dbname=test;charset=utf8', $user, $pass
		try 
		{
			// коннектимся к бд
            $connection = new PDO($dsn, $user, $password, $options);
        } 
		catch (PDOException $error) 
		{
            
			//throw new Exception($error->getMessage());
			Catalog::$app->httpHeader->error(500, 'Не удалось подключиться к базе данных.');
        }
		
		// сохраняем объект соединение в приватную переменную
		self::$connection = $connection;
		
	}

	public static function destroyConnect()
	{
		static::$connection = null;
	}

}
