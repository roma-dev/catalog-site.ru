<?php 
$title = 'Создание товара'; 
$pagination = false;
?>
<?php if(isset($errorMessage)): ?>
<div class="row">
	<div class="alert alert-danger alert-dismissable col-lg-10">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  <span><?=$errorMessage?></span>
	</div>
</div>
<?php endif;?>

<form class="form-horizontal" action="/admin/good/create" method="post">
	<div class="row">
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Название товара</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<input name="Good[name]" type="text" class="form-control" id="name" placeholder="Введите название категории" required>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Краткое описание</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<textarea name="Good[short_description]" class="form-control" rows="3" placeholder="Введите краткое описание" required></textarea>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Полное описание</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<textarea name="Good[full_description]" class="form-control" rows="6" placeholder="Введите полное описание" required></textarea>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Статус</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<select name="Good[active]" id="active" type="text" class="form-control" required>
				<option></option>
				<option value="1">Активная</option>
				<option value="0">Неактивная</option>d
			  </select>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Количество на складе</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<input name="Good[count]" type="text" class="form-control" id="name" placeholder="Введите количество товара на складе" required>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Возможность предзаказа</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<select name="Good[is_available]" id="active" type="text" class="form-control" required>
				<option></option>
				<option value="1">Доступен</option>
				<option value="0">Не доступен</option>
			  </select>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col">
				<h4>Категория товара</h4>
			</div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<div class="row">
					<div id="select-category-container" class="col-lg-8 select-category__item">
						<select name="Good[category_id][]" type="text" class="form-control first-category-item select-category-item" required>
							<option></option>
							<?php if(isset($categories) && is_array($categories)):?>
								<?php foreach ($categories as $category): ?>
								<option value="<?=$category['id']?>"><?=$category['name']?></option>
								<?php endforeach;?>
							
							
							<?php endif;?>
						</select>
						
					</div>
				
					<div class="col-lg-3 text-right">
						<button id="add-category-button" class="btn btn-success" type="button">Добавить категорию</button>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row form-horizontal__item-row" style="text-align: right; ">
			<div class="col-lg-10">
				<button class="btn btn-success btn-lg" type="submit">Создать товар</button>
			</div>
		</div>
	</div>
</form>