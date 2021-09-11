<?php 
$title = 'Add Category';
require_once "header.php";
if (isset($_POST['btnSave'])){ 
  $err = [];

  if(isset($_POST['name']) && !empty($_POST['name'])){
    $category->set('name',$_POST['name']);
  } else{
    $err['name'] = 'Enter name';
  }

  if(isset($_POST['slug']) && !empty($_POST['slug'])){
    $category->set('slug',$_POST['slug']);
  } else{
    $err['slug'] = 'Enter slug';
  }

  if(isset($_POST['rank']) && !empty($_POST['rank'])){

    if(filter_var($_POST['rank'],FILTER_VALIDATE_INT)){
      $category->set('rank',$_POST['rank']);
    } else{
      $err['rank'] = 'Enter valid rank';
    }
  } else{
    $err['rank'] = 'Enter rank';
  }
  
  $category->set('status',$_POST['status']);
  $category->set('created_at',date('Y-m-d H:i:s'));
  $category->set('created_by',$_SESSION['id']);

  if(count($err) == 0){
    $status = $category->add();
  }
}
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Category Management</h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Add category
          <a href="list_category.php" class="btn btn-primary"><i class="fas fa-list"></i> List</a>
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
						<label for="slug">Slug</label>
						<input type="text" name="slug" class="form-control" id="slug" placeholder="Enter slug....">
					</div>
					<div class="form-group">
						<label for="rank">Rank</label>
						<input type="number" name="rank" class="form-control" id="rank" placeholder="Enter rank....">
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
    slug: "required",
    // compound rule
    rank: {
    	required: true,
    	number: true
    }
}
});
      $("#name").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug").val(Text);        
});
});
</script>