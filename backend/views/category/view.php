<?php 
$title = 'Категория: '.$category['name']; 
$pagination = false;
?>
<div class="row">
	<div class="col-lg-9">
		<dl class="dl-horizontal">
			<dt class="view-dt-dd">ID Категории:</dt>		<dd class="view-dt-dd"><?=$category['id']?></dd>
			<dt class="view-dt-dd">Название категории:</dt>	<dd class="view-dt-dd"><?=$category['name']?></dd>
			<dt class="view-dt-dd">Краткое описание:</dt>	<dd class="view-dt-dd"><?=$category['short_description']?></dd>
			<dt class="view-dt-dd">Полное описание:</dt>	<dd class="view-dt-dd"><?=$category['full_description']?></dd>
			<dt class="view-dt-dd">Статус:</dt>				<dd class="view-dt-dd"><?= $category['active'] ? 'Активный': 'Неактивный'?></dd>
		</dl>

		<div class="row text-right">
			<a href="/admin/category/update?id=<?=$category['id']?>" class="btn btn-success  btn-lg">Редактировать</a>
		</div>
	</div>
</div>