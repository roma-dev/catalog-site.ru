<?php 
$title = 'Категории'; 
$pagination = true;
?>

		<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="text" class="form-control" placeholder="Text input"></td>
                  <td><input type="text" class="form-control" placeholder="Text input"></td>
                  <td><input type="text" class="form-control" placeholder="Text input"></td>
                  <td><input type="text" class="form-control" placeholder="Text input"></td>
                  <td></td>
                </tr>
				<?php foreach($model as $row):?>
                <tr>
                  <td><?=$row['id']?></td>
                  <td><?=$row['name']?></td>
                  <td><?=$row['short_description']?></td>
                  <td><?=$row['active']?></td>
                  <td class="table-td-icons-block">
					  <a href="/admin/category/view?id=<?=$row['id']?>"><span class="glyphicon glyphicon-eye-open"></span></a>
					  <a href="/admin/category/update?id=<?=$row['id']?>"><span class="glyphicon glyphicon-pencil"></span></a>
					  
				  </td>
                </tr>
				<?php endforeach; ?>
              </tbody>
            </table>
          </div>