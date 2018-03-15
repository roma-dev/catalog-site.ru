<?php

namespace Engine;

class View {

	public function render($viewName, $arg=[])
	{
		//var_dump(Catalog::$app->settings['layoutView']); die;
		
		// строим путь до файла макета
		$layoutPath = ROOT_DIR . Catalog::$app->settings['layoutsPath'] . '/' . Catalog::$app->settings['layoutView'] . '.php';
		//var_dump($layoutPath); die;
		// строим путь до файла вида
		$viewPath = ROOT_DIR . Catalog::$app->settings['viewsPath'] . '/' . $viewName . '.php';
		// проверяем существуют ли файлы необходимые для рендеринга
		if(!is_file($viewPath) && !is_file($layoutPath) ){ Catalog::$app->httpHeader->error(500, 'Отсутствует файл вида!'); }
		
		extract($arg);
		
		ob_start();
		ob_implicit_flush(0);
		
		try{
			// файл вида с подстановкой переменых добавляем в переменную контент, которая будет подставляться в файле макета
			$content = require $viewPath;
			
			// выводим файл макета
			require $layoutPath;
			
		} catch (Exception $ex) {

			\ob_end_clean();
			throw $ex;
		}
		
		// отдаем содержимое буфера в браузер
		echo ob_get_clean();
		
	}
	
}
