<?php
require APPROOT . '/Views/includes/header.php';
?>
<?php
require APPROOT . '/Views/includes/navigation.php';
?>
<link rel="stylesheet" href="/App/Views/dist/css/crud.css">

<script src="/App/Views/dist/js/pages/staff.js"></script>

<div class="container-fluid">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage <b>Staffs</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addStaffModal" class="btn btn-success" data-toggle="modal"><i
								class="material-icons">&#xE147;</i> <span>Add New Staff</span></a>
						<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i
								class="material-icons">&#xE15C;</i> <span>Delete</span></a>
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
						<th>Username</th>
						<th>Email</th>
						<th>Fullname</th>
						<th>Role</th>
						<th>Department</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<!-- In kết quả -->
					<?php foreach ($data['show'] as $row) {
    ?>
					<tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" class="user_checkbox"
									data-user-id="<?php echo $row["userId"]; ?>">
								<label for="checkbox1"></label>
							</span>
						</td>
						<td><?php echo $row["username"] ?> </td>
						<td><?php echo $row["email"] ?> </td>
						<td><?php echo $row["fullname"] ?></td>
						<td><?php echo $row["rolename"] ?></td>
						<td><?php echo $row["departmentname"] ?></td>
						<td>
							<a href="#editStaffModal" class="edit" data-toggle="modal">
								<i class="material-icons update" data-toggle="tooltip"
									data-id="<?php echo $row["userId"]; ?>"
									data-username="<?php echo $row["username"]; ?>"
									data-email="<?php echo $row["email"]; ?>" 
									data-fullname="<?php echo $row["fullname"]; ?>"
									data-role="<?php echo $row["roleId"]; ?>"
									data-department="<?php echo $row["departmentId"]; ?>" 
									title="Edit">&#xE254;</i></a>

							<a href="#deleteStaffModal" data-id="<?php echo $row["userId"]; ?>" class="delete"
								data-toggle="modal">
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
      <a class="page-link" href="/staff/index/<?php echo $data['startpage'] ?>" tabindex="-1" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">First</span>
      </a>
    </li>
    <?php } ?>
    <?php if($data['curpage'] >= 2){ ?>
    <li class="page-item"><a class="page-link" href="/staff/index/<?php echo $data['previouspage'] ?>"><?php echo $data['previouspage'] ?></a></li>
    <?php } ?>
    <li class="page-item active"><a class="page-link" href="/staff/index/<?php echo $data['curpage'] ?>"><?php echo $data['curpage'] ?></a></li>
    <?php if($data['curpage'] != $data['endpage']){ ?>
    <li class="page-item"><a class="page-link" href="/staff/index/<?php echo $data['nextpage'] ?>"><?php echo $data['nextpage'] ?></a></li>
    <li class="page-item">
      <a class="page-link" href="/staff/index/<?php echo $data['endpage'] ?>" aria-label="Next">
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
<div id="addStaffModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Add Staff</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Username</label>
						<input type="text" id="username_a" name="username" class="form-control" required>
						<label>Password</label>
						<input type="password" id="password_a" name="password" class="form-control" required>
						<label>Email</label>
						<input type="text" id="email_a" name="closuredate" class="form-control" required>
						<label>Fullname</label>
						<input type="text" id="fullname_a" name="finalclosuredate" class="form-control" required>
						</br>
						<label>Role</label>
						<select name="role" id="role_a">
							<?php foreach ($data['role'] as $row) {?>
							<option value="<?php echo $row["roleId"] ?>"><?php echo $row["rolename"] ?></option>
							<?php }?>
						</select>
						</br>
						</br>
						<label>Department</label>
						<select name="department" id="department_a">
							<?php foreach ($data['department'] as $row) {?>
							<option value="<?php echo $row["departmentId"] ?>"><?php echo $row["departmentname"] ?>
							</option>
							<?php }?>
						</select>
						</br>
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
<div id="editStaffModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Edit User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div id="alert-e"></div>
				<div class="modal-body">
					<input type="hidden" id="id_u" name="id" class="form-control" required>
					<div class="form-group">
						<label>Username</label>
						<input type="text" id="username_u" name="username" class="form-control" required>
						<label>Password</label>
						<input type="password" id="password_u" name="password" class="form-control" required>
						<label>Email</label>
						<input type="text" id="email_u" name="closuredate" class="form-control" required>
						<label>Fullname</label>
						<input type="text" id="fullname_u" name="finalclosuredate" class="form-control" required>
						</br>
						<label>Role</label>
						<select name="role" id="role_u">
							<?php foreach ($data['role'] as $row) {?>
							<option value="<?php echo $row["roleId"] ?>"><?php echo $row["rolename"] ?></option>
							<?php }?>
						</select>
						</br>
						</br>
						<label>Department</label>
						<select name="department" id="department_u">
							<?php foreach ($data['department'] as $row) {?>
							<option value="<?php echo $row["departmentId"] ?>"><?php echo $row["departmentname"] ?>
							</option>
							<?php }?>
						</select>
						</br>
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
<div id="deleteStaffModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Delete User</h4>
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
