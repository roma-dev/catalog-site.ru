<?php

namespace Engine;

class AccessControl {
	
	public function faceControl()
	{
		$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		
		if(!$this->isAdmin() && $path != '/admin/login' )
		{ 
			Catalog::$app->httpHeader->redirect('/admin/login', 302); 	
		}
	}


	public function isAdmin()
	{
		if( isset($_SESSION['admin']) ) { return true; }
		return false;
	}
	
	public function loginAdmin()
	{
		if( !isset($_SESSION['admin']) ) { $_SESSION['admin'] = true; }
	}
	
	public function logout()
	{
		if (!isset($_SESSION['admin'])) { return; }
		unset($_SESSION['admin']);
		Catalog::$app->httpHeader->redirect('/admin/login', 302);
	}
	
}
