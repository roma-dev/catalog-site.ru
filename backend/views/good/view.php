<?php 
$title = 'Товар'; 
$pagination = false;
?>

<div class="row">
	<div class="col-lg-9">
		<dl class="dl-horizontal">
			<dt class="view-dt-dd">ID товара:</dt>				<dd class="view-dt-dd"><?=$good['id']?></dd>
			<dt class="view-dt-dd">Название товара:</dt>		<dd class="view-dt-dd"><?=$good['name']?></dd>
			<dt class="view-dt-dd">Краткое описание:</dt>		<dd class="view-dt-dd"><?=$good['short_description']?></dd>
			<dt class="view-dt-dd">Полное описание:</dt>		<dd class="view-dt-dd"><?=$good['full_description']?></dd>
			<dt class="view-dt-dd">Статус:</dt>					<dd class="view-dt-dd"><?= $good['active'] ? 'Активный': 'Неактивный'?></dd>
			<dt class="view-dt-dd">Количество на складе:</dt>	<dd class="view-dt-dd"><?= $good['count']?></dd>
			<dt class="view-dt-dd">Предзаказ:</dt>				<dd class="view-dt-dd"><?= $good['is_available'] ? 'Доступен': 'Недоступен'?></dd>
		</dl>

		<div class="row text-right">
			<a href="/admin/good/update?id=<?=$good['id']?>" class="btn btn-success  btn-lg">Редактировать</a>
		</div>
	</div>
</div>