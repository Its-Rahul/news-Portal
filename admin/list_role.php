<?php 
$title = 'List Category';
require_once "header.php"; 

$data = $role->lists();
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Role Management</h1>
          <div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">List Role
				<a href="add_role.php" class="btn btn-success"><i class="fas fa-plus"></i> Add</a>
			</h6>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>SN</th>
							<th>Name</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($data as $sn => $d){ ?>
						<tr>
							<td><?php echo $sn+1; ?></td>
							<td><?php echo $d->name ?></td>
							<td>
								<?php if($d->status){ ?>
									<label class="text text-success">Active</label>
								<?php } else{ ?>
									<label class="text text-danger">De Active</label>
								<?php } ?>
							</td>
							<td>
								<a href="view_role.php?id=<?php echo $d->id ?>" class="btn btn-info"><i class="fas fa-eye"></i> View</a>
								<a href="edit_role.php?id=<?php echo $d->id ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
								<a href="delete_role.php?id=<?php echo $d->id ?>" class="btn btn-danger" onclick="return confirm('are you sure to delete?')"><i class="fas fa-trash"></i> Delete</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php require_once "footer.php"; ?>