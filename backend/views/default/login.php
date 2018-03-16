<?php 
$title = 'Страница авторизации'; 
$pagination = false;
?>

<script>
<?php if(isset($error)){ echo "alert('$error');";}?>	
</script>

<form class="form-signin" role="form" action="/admin/login" method="post">
	<h2 class="form-signin-heading">Авторизация</h2>
	<input name="name" type="text" class="form-control" placeholder="Введите ваше имя" required autofocus>
	<input name="password" type="password" class="form-control" placeholder="Введите ваш пароль" required>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
</form>