<?php

namespace Engine;

class HttpHeader {
	
	public function e500()
	{
		header('HTTP/1.1 500 Internal Server Error');
	}
	
	public function e404()
	{
		header('HTTP/1.1 404 Not Found');
	}
	
	public function e403()
	{
		header('HTTP/1.1 403 Forbidden');
	}
	
	public function r302($alias)
	{
		header('HTTP/1.1 302 Moved Temporarily');
		header("Location: " . $alias);
	}
	
	public function r301($alias)
	{
		header('HTTP/1.1 301 Moved Permanently');
		header("Location: " . $alias);
	}
}