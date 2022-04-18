<?php 
   require APPROOT . '/Views/includes/header.php';
?>
<?php
    require APPROOT . '/Views/includes/navigation.php';
?>
<style>
	
</style>
<link rel="stylesheet" href="/App/Views/dist/css/crud.css">

<script src="/App/Views/dist/js/pages/department.js"></script>

<div class="container-fluid">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage <b>Departments</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addDepartmentModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Department</span></a>
						<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>								
					</div>
				</div>
			</div>

			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>Name</th>
						<th>CreateAt</th>
						<th>UpdateAt</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<!-- In kết quả -->
			<?php foreach ($data['show'] as $row) {
				?>
				<tr id="<?php echo $row["departmentId"] ?>">
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["departmentId"]; ?>" >
								<label for="checkbox1"></label>
							</span>
						</td>
						<td><?php echo $row["departmentname"]?> </td>
						<td><?php echo $row["createAt"]?></td>
						<td><?php echo $row["updateAt"]?></td>
						<td>
							<a href="#editDepartmentModal" class="edit" data-toggle="modal">
								<i class="material-icons update" data-toggle="tooltip" data-id="<?php echo $row["departmentId"]; ?>" data-name="<?php echo $row["departmentname"]; ?>" title="Edit" >&#xE254;</i></a>

							<a href="#deleteDepartmentModal" data-id="<?php echo $row["departmentId"]; ?>" class="delete" data-toggle="modal">
								<i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
						</td>
					</tr> 
			<?php }?>
				</tbody>
			</table>
			<div class="clearfix">
			
				<ul class="pagination">
  <?php if($data['curpage'] != $data['startpage']){ ?>
    <li class="page-item">
      <a class="page-link" href="/department/index/<?php echo $data['startpage'] ?>" tabindex="-1" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">First</span>
      </a>
    </li>
    <?php } ?>
    <?php if($data['curpage'] >= 2){ ?>
    <li class="page-item"><a class="page-link" href="/department/index/<?php echo $data['previouspage'] ?>"><?php echo $data['previouspage'] ?></a></li>
    <?php } ?>
    <li class="page-item active"><a class="page-link" href="/department/index/<?php echo $data['curpage'] ?>"><?php echo $data['curpage'] ?></a></li>
    <?php if($data['curpage'] != $data['endpage']){ ?>
    <li class="page-item"><a class="page-link" href="/department/index/<?php echo $data['nextpage'] ?>"><?php echo $data['nextpage'] ?></a></li>
    <li class="page-item">
      <a class="page-link" href="/department/index/<?php echo $data['endpage'] ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Last</span>
      </a>
    </li>
    <?php } ?>
  </ul>
			</div>
		</div>
	</div>        
</div>
<!-- Add Modal HTML -->
<div id="addDepartmentModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Add Department</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Name</label>
						<input type="text" id="name_a" name="name" class="form-control" required>
					</div>			
				</div>
				<div class="modal-footer">
	
					<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
					<button type="button" class="btn btn-success" id="btn-add">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editDepartmentModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Edit Department</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div id="alert-e"></div>
				<div class="modal-body">
					<input type="hidden" id="id_u" name="id" class="form-control" required>					
					<div class="form-group">
						<label>Name</label>
						<input type="text" id="name_u" name="name" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
					<button type="button" class="btn btn-info" id="update">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteDepartmentModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Delete Department</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_d" name="id" class="form-control">					
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
					<button type="button" class="btn btn-danger" id="delete">Delete</button>
				</div>
			</form>
		</div>
	</div>
   </div>

