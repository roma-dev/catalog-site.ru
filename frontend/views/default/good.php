<?php 

$title = isset($good)? $good['name'] : 'Товар';
$seotext = '';
$pagination = false;
?>

<div class="row">
	<div class="col-lg-6">
		<p><?=$good['full_description']?></p>	
	</div>
	
	<div class="col-lg-6">
		<dl>
			<dt>Наличие на складе:</dt><dd><?= $good['count']? $good['count'] . ' шт.' : 'Нет в наличии'?></dd>
			<?php if(!$good['count']):?>
			<dt>Доступность по предзаказу:</dt><dd class="text-danger"><?= $good['is_available']? 'Доступен' : 'Не доступен'?></dd>
			<?php endif;?>
		</dl>
		<div class="row">
			<a class="btn btn-success btn-lg" href="#">Заказать</a>
		</div>
	</div>
	
</div>

<div class="row">
	<h3>Посмотреть похожие товары:</h3>
	<ul>
		<?php foreach($categories as $category):?>
		<li><a href="/category?id=<?=$category['id']?>"><?=$category['name']?></a></li>
		<?php endforeach;?>
	</ul>
</div>