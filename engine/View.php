<?php

namespace Engine;

class View {

	public function render($viewName, $arg=[])
	{
		// строим путь до файла макета
		$layoutPath = ROOT_DIR . Catalog::$app->settings['layoutsPath'] . '/' . Catalog::$app->settings['layoutView'] . '.php';
		
		// проверяем существуют ли файлы необходимые для рендеринга
		if( !is_file($layoutPath) ){ Catalog::$app->httpHeader->error(500, 'Отсутствует файл макета!'); }
 
		// включаем буферизацию
		ob_start();
		ob_implicit_flush(0);
		
		try{
			
			// строим путь до файла вида
			$viewPath = ROOT_DIR . Catalog::$app->settings['viewsPath'] . '/' . $viewName . '.php';

			// проверяем существуют ли файл вида
			if( !is_file($viewPath) ){ Catalog::$app->httpHeader->error(500, 'Отсутствует файл вида!'); }

			extract($arg);

			// включаем буферизацию
			ob_start();
			ob_implicit_flush(0);

			try{
				// встраиваем файл вида
				require $viewPath;

			} catch (Exception $ex) {

				\ob_end_clean();
				throw $ex;
			}

			// выводим содержимое вида
			$content = ob_get_clean();
			
			// выводим файл макета
			require $layoutPath;
			
		} catch (Exception $ex) {

			\ob_end_clean();
			throw $ex;
		}
		
		// отдаем содержимое макета
		echo ob_get_clean();
		
	}
	
	
	public function renderView($viewName, $arg=[])
	{
		
		// строим путь до файла вида
		$viewPath = ROOT_DIR . Catalog::$app->settings['viewsPath'] . '/' . $viewName . '.php';
		
		// проверяем существуют ли файл вида
		if( !is_file($viewPath) ){ Catalog::$app->httpHeader->error(500, 'Отсутствует файл вида!'); }
		
		extract($arg);
		
		// включаем буферизацию
		ob_start();
		ob_implicit_flush(0);
		
		try{
			// встраиваем файл вида
			require $viewPath;
			
		} catch (Exception $ex) {

			\ob_end_clean();
			throw $ex;
		}
		
		// выводим содержимое вида
		return ob_get_clean();
	}
	
}
