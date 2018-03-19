<?php 
$title = 'Обновление товара'; 
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

<form class="form-horizontal" action="/admin/good/update?id=<?=$good['id']?>" method="post">
	
	<input type="hidden" name="Good[id]" value="<?=$good['id']?>">
	<div class="row">
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Название товара</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<input value="<?=$good['name']?>" name="Good[name]" type="text" class="form-control" id="name" placeholder="Введите название категории" required>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Краткое описание</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<textarea name="Good[short_description]" class="form-control" rows="3" placeholder="Введите краткое описание" required><?=$good['short_description']?></textarea>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Полное описание</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<textarea name="Good[full_description]" class="form-control" rows="6" placeholder="Введите полное описание" required><?=$good['full_description']?></textarea>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Статус</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<select name="Good[active]" id="active" type="text" class="form-control" required>
				<option></option>
				<option value="1" <?= $good['active']==1 ? 'selected': '' ?>>Активная</option>
				<option value="0" <?= $good['active']==0 ? 'selected': '' ?>>Неактивная</option>
			  </select>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Количество на складе</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<input value="<?=$good['count']?>" name="Good[count]" type="text" class="form-control" id="name" placeholder="Введите количество товара на складе" required>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col"><h4>Возможность предзаказа</h4></div>
			<div class="col-lg-7 form-horizontal__item-right-col">
				<select name="Good[is_available]" id="active" type="text" class="form-control" required>
				<option></option>
				<option value="1" <?= $good['is_available']==1 ? 'selected': '' ?>>Доступен</option>
				<option value="0" <?= $good['is_available']==0 ? 'selected': '' ?>>Не доступен</option>
			  </select>
			</div>
		</div>
		<div class="row form-horizontal__item-row">
			<div class="col-lg-3 form-horizontal__item-left-col">
				<h4>Категории товара</h4>
			</div>
			
			
			<div class="col-lg-7 form-horizontal__item-right-col">
				<div class="row">
					
					
					<div class="col-lg-8 input-category-group">
						<?php foreach ($currentCategories as $category): ?>
							<input value="<?=$category['name']?>" name="Good[category_id][<?=$category['id']?>]" type="text" class="form-control input-category__item" readonly>
						<?php endforeach;?>
					</div>
				</div>
			</div>



		</div>
		<hr>
		<div class="row form-horizontal__item-row" style="text-align: right; ">
			<div class="col-lg-10">
				<button class="btn btn-success btn-lg" type="submit">Обновить товар</button>
			</div>
		</div>
	</div>
</form>