
<?php 
$title = 'Add Role';
require_once "header.php";

if (isset($_POST['btnSave'])){ 
  $err = [];

  if(isset($_POST['name']) && !empty($_POST['name'])){
    $role->set('name',$_POST['name']);
  } else{
    $err['name'] = 'Enter name';
  }

  $role->set('status',$_POST['status']);
if(count($err) == 0){
    $status = $role->add();
  }
}
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Role Management</h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Add Role
				<a href="list_role.php" class="btn btn-success"><i class="fas fa-list"></i> List</a>
			</h6>
			</div>
			<div class="card-body">
				<?php if (isset($status) && $status === true) { ?>
                  <div class="alert alert-success" >Insert Success!!!</div>
                  <?php } ?>
                  <?php if (isset($status) && $status !== true) { ?>
                  <div class="alert alert-danger" >Insert Failed!!! <?php echo $status; ?></div>
                  <?php } ?>  

				<form class="" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="insertForm">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control" id="name" placeholder="Enter name....">
					</div>
					
					<div class="form-group">
						<label for="deactive">Status</label>
						<input type="radio" name="status" id="active" value="1">Active
						<input type="radio" name="status" id="deactive" value="0" checked="checked">De Active
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success" name="btnSave"> <i class="fas fa-save"></i>Save</button>
						<button type="reset" class="btn btn-danger"> <i class="fas fa-recycle"></i>Clear</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php require_once "footer.php"; ?>
<script type="text/javascript" src="js/jquery_validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
      //$('#loginform').validate();
      $("#insertForm").validate({
      	rules: {
    // simple rule, converted to {required:true}
    name: "required"
}
});

});
</script>