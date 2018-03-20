<?php 
$title = 'Товары'; 
$pagination = true;
		
$name				=  isset($_GET['name']) ? trim($_GET['name'], '[]' ) : '' ;
$short_description	=  isset($_GET['short_description']) ? trim($_GET['short_description'], '[]' ) : '' ;
$active				=  isset($_GET['active']) ? $_GET['active'] : null ;
$count				=  isset($_GET['count']) ? $_GET['count'] : null ;
$is_available		=  isset($_GET['is_available']) ? $_GET['is_available'] : null ;
?>

		<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="col-lg-2">Название</th>
                  <th class="col-lg-6">Краткое описание</th>
                  <th class="col-lg-1">Статус</th>
                  <th class="col-lg-1">На складе</th>
                  <th class="col-lg-1">Предзаказ</th>
                  <th class="col-lg-1"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
					<td><input value="<?= $name ? $name:'';?>" id="search-name" name="name" type="text" class="form-control search-form"></td>
                  <td><input value="<?= $short_description ? $short_description:'';?>" id="search-short_description" name="short_description" type="text" class="form-control search-form"></td>
                  <td>
					  <select id="search-active" name="active" type="text" class="form-control search-form">
						<option></option>
						<option value="1" <?= ($active == '1')? 'selected':'';?>>Активные</option>
						<option value="0" <?= ($active == '0')? 'selected':'';?>>Неактивные</option>
					  </select>
				  </td>
                  <td><input value="<?= $count ? $count:'';?>" id="search-count" name="count" type="text" class="form-control search-form"></td>
                  <td>
					  <select id="search-is_available" name="is_available" type="text" class="form-control search-form">
						<option></option>
						<option value="1" <?= ($is_available == '1')? 'selected':'';?>>Доступеные</option>
						<option value="0" <?= ($is_available == '0')? 'selected':'';?>>Недоступные</option>
					  </select>
				  </td>
                  <td></td>
                </tr>
				<?php foreach($result as $row):?>
                <tr>
                  <td><span><?=$row['name']?></span></td>
                  <td><span><?=$row['short_description']?></span></td>
                  <td><span><?=$row['active'] ? "Активная" : "Неактивная";?></span></td>
                  <td><span><?=$row['count']?></span></td>
				  <td><span><?=$row['is_available'] ? "Доступен" : "Недоступен";?></span></td>
                  <td class="table-td-icons-block">
					  <a href="/admin/good/view?id=<?=$row['id']?>"><span class="glyphicon glyphicon-eye-open"></span></a>
					  <a href="/admin/good/update?id=<?=$row['id']?>"><span class="glyphicon glyphicon-pencil"></span></a>
					  
				  </td>
                </tr>
				<?php endforeach; ?>
              </tbody>
            </table>
          </div>