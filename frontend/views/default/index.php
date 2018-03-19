
<?php 
$title = 'Catalog-site.ru';
$seotext = "Добро пожаловать на наш сайт! <br>У нас вы можете <strong>купить товары в Смоленске по доступной цене</strong> с доставкой на дом.";
$pagination = true;

for($i = 0, $j = 1; $i < count($categories); $i++, $j++)
{
	if($j == 1 ) echo '<div class="row">';
	
	echo '<div class="col-md-4"><h2>'.$categories[$i]['name'].'</h2>';
	echo '<p>'.$categories[$i]['short_description'].'</p>';
	echo '<p><a class="btn btn-success" href="/category?id='.$categories[$i]['id'].'">Подробнее</a></p></div>';
	
	if($j == 3 ){
		echo '</div>';
		$j=0;
	}
}

