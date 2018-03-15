<?php

namespace Engine;

class HttpHeader {
	
	private $errorCodes = [
			'500' => 'Internal Server Error',
			'403' => 'Forbidden',
			'404' => 'Not Found',
			'302' => 'Moved Temporarily',
			'301' => 'Moved Permanently'
		];
	
	private $redirectCodes = [
			'302' => 'Moved Temporarily',
			'301' => 'Moved Permanently'
		];


	public function error($code, $message='')
	{
		header( $_SERVER['SERVER_PROTOCOL'] . ' ' . $code . ' ' . $this->errorCodes[$code]);
		die($message);
	}
	
	public function redirect($url, $code=301)
	{
		header( $_SERVER['SERVER_PROTOCOL'] . ' ' . $code . ' ' . $this->redirectCodes[$code]);
		header("Location: " . $url);
	}
}