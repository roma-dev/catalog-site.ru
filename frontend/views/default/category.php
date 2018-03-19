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

<?php for($i = 0, $j = 1; $i < count($goods); $i++, $j++): ?>
	<?php if($j == 1) echo '<div class="row">'; ?>
	<div class="col-md-4"><h2><?=$goods[$i]['name']?></h2>
	  <p><?=$goods[$i]['short_description']?></p>
	  <?php
	  if($goods[$i]['count'] == 0)
	  {
		  echo "<p class=\"text-danger\">Нет в наличии</p>";
		  if( $goods[$i]['is_available'] ) echo '<p>Доступен по предзаказу</p>';
	  }else
	  {
		  echo "<p>Количество на скаде: " . $goods[$i]['count'] . " шт.</p>";
	  }
	  ?>
	  <p><a class="btn btn-success" href="/good?id=<?=$goods[$i]['id']?>">Подробнее</a></p>
	</div>

	<?php if($j == 3) {
		echo '</div>'; 
		$j=0;
	}
	?>
<?php endfor; ?>

<?php if($goods === []):?>
	<h3>В категории нет товаров!</h3>
<?php endif;?>