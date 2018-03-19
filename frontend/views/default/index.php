
<?php 
$title = 'Catalog-site.ru';
$seotext = "Добро пожаловать на наш сайт! <br>У нас вы можете <strong>купить товары в Смоленске по доступной цене</strong> с доставкой на дом.";
$pagination = true;
?>

<?php foreach ($categories as $category):?>
<div class="col-md-4">
  <h2><?=$category['name']?></h2>
  <p><?=$category['short_description']?></p>
  <p><a class="btn btn-success" href="/category?page=<?=$category['id']?>">Подробнее</a></p>
</div>
<?php endforeach;?>
