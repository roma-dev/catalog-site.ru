<?php 
$title = 'Создание категории'; 
$pagination = false;
?>
<?php if($error): ?>
<div class="row">
	<div class="alert alert-danger alert-dismissable col-lg-10">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  <span><?=$errorMessage?></span>
	</div>
</div>
<?php endif;?>

<form class="form-horizontal" action="/admin/category/create" method="post">
	<div class="row">
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Название категории</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<input name="Category[name]" type="text" class="form-control" id="name" placeholder="Введите название категории" required>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Краткое описание</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<textarea name="Category[short_description]" class="form-control" rows="3" placeholder="Введите краткое описание" required></textarea>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Полное описание</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<textarea name="Category[full_description]" class="form-control" rows="6" placeholder="Введите полное описание" required></textarea>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Статус</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<select name="Category[active]" id="active" type="text" class="form-control" required>
				<option></option>
				<option value="1">Активная</option>
				<option value="0">Неактивная</option>
			  </select>
			</div>
		</div>
		<div class="row form-horizontal__item-row" style="text-align: right; ">
			<div class="col-lg-10">
				<button class="btn btn-success btn-lg" type="submit">Создать категорию</button>
			</div>
		</div>
	</div>
</form>