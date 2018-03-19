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
	
	// $counts - количество всех записей бд по условию последней выборки (без учета конструкции LIMIT)
	// $page_id - id текущей страницы
	// $p_limit - количество записей отображаемых на одной странице
	// $p_points - количество точек пагинации которое мы хотим видеть на странице (должно быть нечетным)
	//
	// пагинацию будем строить с центральной текущей странице, если количество точек достаточно для этого
	
	// Данные для пагинации будут браться из следующих переменных
	// Catalog::$app->settings['counts']; 
	// Catalog::$app->request->page;
	// Catalog::$app->settings['pagination_limit'];
	// Catalog::$app->settings['pagination_points'];
	
	public function pagination($pagination=true,$counts=null, $page_id=null, $p_limit=null, $p_points=null)
	{
		if(!$pagination) return '';
		// если какая либо переменная не установлена
		if( !isset($counts) && !isset($page_id) && !isset($p_limit) && !isset($p_points) ) return false;
		
		// формируем начало ссылок пагинации
		$url = Catalog::$app->request->path . '?' . Catalog::$app->request->queryParams;
		// вставляем начальные теги 
		$returnString = '<div class="row text-right"><ul class="pagination">';
		
		// узнаем какой по счету должна отображаться центральная точка
		$p_center_points = (int) ceil( $p_points / 2);

		// нужно узнать количество возможных точек пагинаций
		// делим общее количество постов на количество постов одной страницы. и округляем в большую сторону
		$p_all_points = (int) ceil( $counts / $p_limit); 

		// ЕСЛИ возможное количество точек пагинаций меньше или равно количеству точек пагинаций заданных в конфиге
		// ИЛИ
		// ЕСЛИ возможное количество больше достаточного И текущая страница меньше или равна позиции центральной точки
		// то реализуем пагинацию по простому принципу
		// перебираем все возможные точки пагинации с поиском текущей точки пагинации
		if($p_all_points <= $p_points || $p_all_points > $p_points && $p_center_points >= $page_id)
		{
			// перебираем
			for($i = 1; $i <= $p_points; $i++)
			{
				if($i == $page_id) // ищем текущую страницу
				{
					$returnString .= '<li class="active"><a href="'.$url.'page='.$i.'">'.$i.'<span class="sr-only"></span></a></li>';
					continue;
				}
				$returnString .= '<li><a href="'.$url.'page='.$i.'">'.$i.'<span class="sr-only"></span></a></li>';
			}
			$returnString .= '</ul></div>';
			// выводим полученную пагинацию
			// проверял вывод в макете echo $this->pagination(65, 4, 15, 5); создает пагинацию из 5 точек с текущей 4
			return $returnString;
		}
		
		// если возможное количество точек пагинации больше той что ограниченно переменной указаной в кофиге
		// то нам нужно будет узнать
		// 1. сколько возможных точек справа от центральной точки мы можем отобразить
		// 2. узнать конечную точку на основе которой мы будем строить пагинацию
		 
		// нам понадобиться узнать сколько точек от центральной находятся с каждой стороны необходимы для полной пагинации
		// минус один от центральной точки получает точки необходимые с правой стороны для полной пагинации
		$p_right_points = $p_center_points - 1;
 
		// узнаем сколько точек справа от текущей позиции доступны. вычитаем из кол. возможных точек текущую позицию
		$p_all_right_points = $p_all_points - $page_id;
	
		// если возможных точек справа достаточно, то пагинация будет формироваться с текущей центральной точкой
		if($p_all_right_points >= $p_right_points) { $p_final_right_points = $p_right_points; }
		// иначе финальным количеством точек справа будет взято все что имеется из возможных
		else{$p_final_right_points = $p_all_right_points;}
		
		// мы узнали сдвиг справа, теперь нам нужно найти точку конечной пагинации
		// id текущей страницы суммируем с сдвигом = получаем конечную точку пагинации
		$p_end_point = $page_id + $p_final_right_points;

		// реализуем построение пагинации с центральной текущей страницей или крайней с права на некое количество точек
		for($id = $p_end_point-$p_points+1; $id <= $p_end_point; $id++)
		{
			if($page_id == $id)
			{
				$returnString .= '<li class="active"><a href="'.$url.'page='.$id.'">'.$id.'<span class="sr-only"></span></a></li>';
				continue;
			}
			$returnString .= '<li><a href="'.$url.'page='.$id.'">'.$id.'<span class="sr-only"></span></a></li>';
		}
		// закрываем теги
		$returnString .= '</ul></div>';
		// и выводим результат
		return $returnString;
		
	}

	
}
