<?php 
$title = 'View User';
require_once "header.php"; 
if (isset($_GET['id'])){
	$user->set('id',$_GET['id']);
	$data = $user->getUserById();
	if (count($data)==0){
		header('location:list_user.php');
	}
} else{
  header('location:list_user.php');
}

?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">User Management</h1>
          <div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">View User 
				<a href="add_user.php" class="btn btn-success"><i class="fas fa-plus"></i> Add</a>
				 <a href="list_user.php" class="btn btn-primary"><i class="fas fa-list"></i> List</a>
				</h6>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<tr>
						<th>Name</th>
						<td><?php echo $data[0]->name ?></td>
					</tr>
					<tr>
						<th>Image</th>
						<td><?php echo $data[0]->image ?></td>
					</tr>
					<tr>
						<th>Email</th>
						<td><?php echo $data[0]->email ?></td>
					</tr>
					<tr>
						<th>Password</th>
						<td><?php echo $data[0]->password ?></td>
					</tr>
					<tr>
						<th>Last login</th>
						<td><?php echo $data[0]->last_login ?></td>
					</tr>
					<tr>
						<th>Status</th>
						<td>
								<?php if($data[0]->status){ ?>
									<label class="text text-success">Active</label>
								<?php } else{ ?>
									<label class="text text-danger">De Active</label>
								<?php } ?>
						</td>
					</tr>
					<tr>
						<th>Role id</th>
						<td><?php echo $data[0]->role_id ?></td>
					</tr>
					
				</table>
			</div>
		</div>
	</div>
</div>
<?php require_once "footer.php"; ?>