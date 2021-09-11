<?php 
$title = 'Add Advertisement';
require_once "header.php";
if (isset($_POST['btnSave'])){ 
  $err = [];
  if(isset($_POST['category_id']) && !empty($_POST['category_id'])){
    $add->set('category_id',$_POST['category_id']);
  } else{
    $err['category_id'] = 'Enter Category';
  }

  if(isset($_POST['title']) && !empty($_POST['title'])){
    $add->set('title',$_POST['title']);
  } else{
    $err['title'] = 'Enter title';
  }

 if(isset($_POST['link']) && !empty($_POST['link'])){

  if(filter_var($_POST['link'],FILTER_VALIDATE_URL)){
      $add->set('link',$_POST['link']);
    } else{
      $err['link'] = 'Enter valid link';
    }
  } else{
    $err['link'] = 'Enter link';
  }
  /* upload feature image */
  if (isset($_FILES['feature_image']['error']) && $_FILES['feature_image']['error'] == 0) {
    $types = ['image/png','image/jpeg','image/gif'];
    if (isset($_FILES['feature_image']['type']) && in_array($_FILES['feature_image']['type'], $types)) {
      if (isset($_FILES['feature_image']['size']) && $_FILES['feature_image']['size'] < 10000000) {
        $name = uniqid() . '_' .  $_FILES['feature_image']['name'];
        $add->set('feature_image',$name);
        if (move_uploaded_file($_FILES['feature_image']['tmp_name'], 'images/' . $name)) {
          } else {
          $err['feature_image'] = 'File upload failed';
        }
      } else {
        $err['feature_image'] = 'File size too large';
      }
    } else {
      $err['feature_image'] = 'Invalid file type';
    }
  } else {
    $err['feature_image'] = 'Please select file';
  }
  /* end of feature image upload */


  $add->set('status',$_POST['status']);
  $add->set('created_at',date('Y-m-d H:i:s'));
  $add->set('created_by',$_SESSION['id']);

  if(count($err) == 0){
    $status = $add->add();
  }
}
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Advertisement Management</h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Add Advertisement
          <a href="list_advertisement.php" class="btn btn-primary"><i class="fas fa-list"></i> List</a>
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
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Enter title....">
          </div>
          <div class="form-group">
            <label for="link">Link</label>
            <input type="url" name="link" class="form-control" id="link" placeholder="Enter link....">
          </div>
          <div class="form-group">
            <label for="expire_date">Expire Date</label>
            <input type="date" name="expire_date" class="form-control" id="expire_date">
          </div>
					<div class="form-group">
            <label for="feature_image">Image</label>
            <input type="file" name="feature_image" class="form-control" id="feature_image">
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
    title: "required",
    link: "required",

    // compound rule
    expire_date: {
    	required: true,
    	date: true
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