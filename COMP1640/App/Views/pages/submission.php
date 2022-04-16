<?php
require APPROOT . '/Views/includes/header.php';
?>
<?php
require APPROOT . '/Views/includes/navigation.php';
?>
<link rel="stylesheet" href="/App/Views/dist/css/crud.css">

<script src="/App/Views/dist/js/pages/submission.js"></script>

<div class="container-fluid">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage <b>Submissions</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addSubmissionModal" class="btn btn-success" data-toggle="modal"><i
								class="material-icons">&#xE147;</i> <span>Add New Submission</span></a>
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
						<th>Name</th>
						<th>Content</th>
						<th>Closure Date</th>
						<th>Final Closure Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<!-- In kết quả -->
					<?php foreach ($data['show'] as $row) {
    ?>
					<tr id="<?php echo $row["submissionId"] ?>">
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" class="user_checkbox"
									data-user-id="<?php echo $row["submissionId"]; ?>">
								<label for="checkbox1"></label>
							</span>
						</td>
						<td><?php echo $row["submissionname"] ?> </td>
						<td><?php echo $row["content"] ?> </td>
						<td><?php echo $row["closure_date"] ?></td>
						<td><?php echo $row["final_closure_date"] ?></td>
						<td>
							<a href="#editSubmissionModal" class="edit" data-toggle="modal">
								<i class="material-icons update" data-toggle="tooltip"
									data-id="<?php echo $row["submissionId"]; ?>"
									data-name="<?php echo $row["submissionname"]; ?>"
									data-content="<?php echo $row["content"]; ?>" title="Edit">&#xE254;</i></a>

							<a href="#deleteSubmissionModal" data-id="<?php echo $row["submissionId"]; ?>"
								class="delete" data-toggle="modal">
								<i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
						</td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
				<ul class="pagination">
  <?php if($data['curpage'] != $data['startpage']){ ?>
    <li class="page-item">
      <a class="page-link" href="/submission/index/<?php echo $data['startpage'] ?>" tabindex="-1" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">First</span>
      </a>
    </li>
    <?php } ?>
    <?php if($data['curpage'] >= 2){ ?>
    <li class="page-item"><a class="page-link" href="/submission/index/<?php echo $data['previouspage'] ?>"><?php echo $data['previouspage'] ?></a></li>
    <?php } ?>
    <li class="page-item active"><a class="page-link" href="/submission/index/<?php echo $data['curpage'] ?>"><?php echo $data['curpage'] ?></a></li>
    <?php if($data['curpage'] != $data['endpage']){ ?>
    <li class="page-item"><a class="page-link" href="/submission/index/<?php echo $data['nextpage'] ?>"><?php echo $data['nextpage'] ?></a></li>
    <li class="page-item">
      <a class="page-link" href="/submission/index/<?php echo $data['endpage'] ?>" aria-label="Next">
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
<div id="addSubmissionModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Add Submission</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Name</label>
						<input type="text" id="name_a" name="name" class="form-control" required>
						<label>Content</label>
						<input type="text" id="content_a" name="content" class="form-control" required>
						<label>Closure Date</label>
						<input type="datetime-local" id="closuredate_a" name="closuredate" class="form-control"
							required>
						<label>Final Closure Date</label>
						<input type="datetime-local" id="finalclosuredate_a" name="finalclosuredate"
							class="form-control" required>
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
<div id="editSubmissionModal" class="modal fade">
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
						<label>Name</label>
						<input type="text" id="name_u" name="name" class="form-control" required>
						<label>Content</label>
						<input type="text" id="content_u" name="content" class="form-control" required>
						<label>Closure Date</label>
						<input type="datetime-local" id="closuredate_u" name="closuredate" class="form-control" required>
						<label>Final Closure Date</label>
						<input type="datetime-local" id="finalclosuredate_u" name="finalclosuredate" class="form-control" required>
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
<div id="deleteSubmissionModal" class="modal fade">
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
