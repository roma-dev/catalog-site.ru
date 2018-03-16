<?php

namespace Engine;

class AccessControl {
	
	public function faceControl()
	{
		$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		
		if(!self::isAdmin() && $path != '/admin/login' )
		{ 
			Catalog::$app->httpHeader->redirect('/admin/login', 302); 	
		}
	}


	public static function isAdmin()
	{
		if( isset($_SESSION['admin']) ) { return true; }
		return false;
	}
	
	public static function loginAdmin()
	{
		if( !isset($_SESSION['admin']) ) { $_SESSION['admin'] = true; }
	}
	
	public static function logoutAdmin()
	{
		if (!isset($_SESSION['admin'])) { return; }
		unset($_SESSION['admin']);
		Catalog::$app->httpHeader->redirect('/admin/login', 302);
	}
	
}
