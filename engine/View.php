<?php

namespace Engine;

class View {

	public function render($viewName, $arg=[])
	{
		// строим путь до файла вида
		$viewPath = ROOT_DIR . Catalog::$app->settings['viewsPath'] . '/' . $viewName . '.php';
		// проверяем есть ли такой файл
		if(!is_file($viewPath)){ Catalog::$app->httpHeader->error(500, 'Отсутствует файл вида!'); }
		
		extract($arg);
		
		ob_start();
		ob_implicit_flush(0);
		
		try{
			
			require $viewPath;
			
		} catch (Exception $ex) {

			\ob_end_clean();
			throw $ex;
		}
		
		echo ob_get_clean();
		
	}
	
}
