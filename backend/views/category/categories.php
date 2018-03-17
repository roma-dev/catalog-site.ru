<?php 
use Engine\Catalog;

$title = 'Категории'; 
$pagination = true;

$search_name =  isset($_GET['name']) ? trim($_GET['name'], '[]' ) : '' ;
$short_description =  isset($_GET['short_description']) ? trim($_GET['short_description'], '[]' ) : '' ;
$active =  isset($_GET['active']) ? $_GET['active'] : null ;
?>

		<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="col-lg-2">Название</th>
                  <th class="col-lg-7">Краткое описание</th>
                  <th class="col-lg-2">Статус</th>
                  <th class="col-lg-1"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
					<td><input value="<?= $search_name ? $search_name:'';?>" id="search-name" name="name" type="text" class="form-control search-form"></td>
                  <td><input value="<?= $short_description ? $short_description:'';?>" id="search-short_description" name="short_description" type="text" class="form-control search-form"></td>
                  <td><select id="search-active" name="active" type="text" class="form-control search-form">
						<option></option>
						<option value="1" <?= ($active == '1')? 'selected':'';?>>Активные</option>
						<option value="0" <?= ($active == '0')? 'selected':'';?>>Неактивные</option>
					  </select>
				  </td>
                  <td></td>
                </tr>
				<?php foreach($result as $row):?>
                <tr>
                  <td><span><?=$row['name']?></span></td>
                  <td><span><?=$row['short_description']?></span></td>
                  <td><span><?=$row['active'] ? "Активная" : "Неактивная";?></span></td>
                  <td class="table-td-icons-block">
					  <a href="/admin/category/view?id=<?=$row['id']?>"><span class="glyphicon glyphicon-eye-open"></span></a>
					  <a href="/admin/category/update?id=<?=$row['id']?>"><span class="glyphicon glyphicon-pencil"></span></a>
					  
				  </td>
                </tr>
				<?php endforeach; ?>
              </tbody>
            </table>
          </div>