<?php 
	if(isset($category))
	{
		$title = $category['name'];
		$seotext = $category['full_description'];
	}else
	{
		$title = 'Catalog-site.ru';
		$seotext = '';
	}
	$pagination = true;
?>	
<?php if($goods !== []):?>
	<?php foreach ($goods as $good):?>
	<div class="col-md-4">
	  <h2><?=$good['name']?></h2>
	  <p><?=$good['short_description']?></p>
	  <?php
	  if($good['count'] == 0)
	  {
		  echo "<p class=\"text-danger\">Нет в наличии</p>";
		  if( $good['is_available'] ) echo '<p>Доступен по предзаказу</p>';
	  }else
	  {
		  echo "<p>Количество на скаде: " . $good['count'] . " шт.</p>";
	  }
	  ?>
	  <p><a class="btn btn-success" href="/good?id=<?=$good['id']?>">Подробнее</a></p>
	</div>
	<?php endforeach;?>
<?php else:?>
	<h3>В категории нет товаров!</h3>
<?php endif;?>