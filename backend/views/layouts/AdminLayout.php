<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= isset($title) ? $title : 'Catalog-site.ru' ?></title>
	<link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/admin/css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="/admin/css/admin.css">
	<script src="/admin/js/jquery-3.3.1.min.js"></script>
	<script src="/admin/js/bootstrap.min.js"></script>
	<script src="/admin/js/admin.js"></script>
</head>
<body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Catalog-site.ru</a>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar dashboard-nav-sidebar">
			  <li><a href="/admin">Админ панель</a></li>
            <li><a  href="/admin/categories">Категории</a><a style="float: right;" href="/admin/category/create"><span class="glyphicon glyphicon-plus"></span></a></li>
            <li><a  href="/admin/goods">Товары</a><a style="float: right;" href="/admin/good/create"><span class="glyphicon glyphicon-plus"></span></a></li>
            <li><a  href="/admin/logout">Выход</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?= isset($title) ? $title : 'Catalog-site.ru' ?></h1>
          
			<?= $content ?>
		  
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
      </div>
    </div>
</body>
</html>
