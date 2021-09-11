

<?php 
$title = 'Add Users';
require_once "header.php";

$data = $user->fetchRole();

if (isset($_POST['btnSave'])){ 
  $err = [];

  if(isset($_POST['name']) && !empty($_POST['name'])){
    $user->set('name',$_POST['name']);
  } else{
    $err['name'] = 'Enter name';
  }
  if(isset($_POST['email']) && !empty($_POST['email'])){

  if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
      $user->set('email',$_POST['email']);
    } else{
      $err['email'] = 'Enter valid email';
    }
  } else{
    $err['email'] = 'Enter email';
  }
  if(isset($_POST['username']) && !empty($_POST['username'])){
    $user->set('username',$_POST['username']);
  } else{
    $err['username'] = 'Enter username';
  }

if(isset($_POST['password']) && !empty($_POST['password'])){
    $user->set('password',$_POST['password']);
  } else{
    $err['password'] = 'Enter password';
  }

  
  
  $user->set('status',$_POST['status']);
  $user->set('role',$_POST['role']);

  if(count($err) == 0){
    $status = $user->add();
  }
}
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">User Management</h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Add user
           <a href="list_user.php" class="btn btn-primary"><i class="fas fa-list"></i> List</a>
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
            <label for="name">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email....">
          </div>

          <div class="form-group">
            <label for="name">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Enter username....">
          </div>
          <div class="form-group">
            <label for="name">Password</label>
            <input type="text" name="password" class="form-control" id="password" placeholder="Enter password....">
          </div>
           <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role">
              <option value="">Select a role</option>
              <?php foreach ($data as $d) { ?>
               <option value="<?php echo $d->id ?>">
                 <?php echo $d->name ?>
               </option>
              <?php } ?>
              
            </select>
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
    name: "required",
    username: "required",
    password: "required",
    // compound rule
    email: {
      required: true,
      email: true
    }
}
});
});
</script>
