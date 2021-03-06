<?php
use Engine\Catalog;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title><?= isset($title) ? $title : 'Catalog-site.ru' ?></title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<script src="/js/scripts.js"></script>
    <!-- Custom styles for this template -->

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Catalog-site.ru</a>
        </div>
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1><?= isset($title) ? $title : 'Catalog-site.ru' ?></h1>
        <p><?= isset($seotext) ? $seotext : '' ?></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
		  
		  <?=$content?>
		  
      </div>

      <hr>
	  
		<?php 
			if($pagination)
			{
				if(isset(Catalog::$app->settings['counts'])){
					echo $this->pagination(
						Catalog::$app->settings['counts'], 
						Catalog::$app->request->page, 
						Catalog::$app->settings['pagination_limit'], 
						Catalog::$app->settings['pagination_points']
						); 	
				}
			}
		?>
      <footer>
        <p>&copy; Catalog-site.ru 2018</p>
      </footer>
    </div> <!-- /container -->