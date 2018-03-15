<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= isset($title) ? $title : 'Catalog-site.ru' ?></title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<script src="/js/jquery-3.3.1.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/scripts.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1><?= isset($title) ? $title : 'Catalog-site.ru' ?></h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="#">Главная</a></li>
			<li><a href="#">Библиотека</a></li>
			<li class="active">Данные</li>
		</ol>
		<div class="row">
			

		<?= $content ?>

		</div>
	<?php if($pagination): ?>	
		<div class="row text-right">
			<ul class="pagination">
				<li class="disabled"><a href="#">&laquo;</a></li>
				<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
				<li class=""><a href="#">1 <span class="sr-only">(current)</span></a></li>
				<li class=""><a href="#">1 <span class="sr-only">(current)</span></a></li>
				<li class=""><a href="#">1 <span class="sr-only">(current)</span></a></li>
				<li class="disabled"><span>&raquo;</span></li>

			</ul>
		</div>
	<?php endif; ?>	
	</div>
</body>
</html>

