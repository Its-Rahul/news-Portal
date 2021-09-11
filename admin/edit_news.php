<?php 
$title = 'Edit News';
require_once "header.php"; 

if (isset($_POST['btnSave'])){ 
  $err = [];
  if(isset($_POST['category_id']) && !empty($_POST['category_id'])){
    $news->set('category_id',$_POST['category_id']);
  } else{
    $err['category_id'] = 'Enter Category';
  }

  if(isset($_POST['title']) && !empty($_POST['title'])){
    $news->set('title',$_POST['title']);
  } else{
    $err['title'] = 'Enter title';
  }

  if(isset($_POST['slug']) && !empty($_POST['slug'])){
    $news->set('slug',$_POST['slug']);
  } else{
    $err['slug'] = 'Enter slug';
  }
  /* upload feature image */
  if (isset($_FILES['feature_image']['error']) && $_FILES['feature_image']['error'] == 0) {
    $types = ['image/png','image/jpeg','image/gif'];
    if (isset($_FILES['feature_image']['type']) && in_array($_FILES['feature_image']['type'], $types)) {
      if (isset($_FILES['feature_image']['size']) && $_FILES['feature_image']['size'] < 10000000) {
        $name = uniqid() . '_' .  $_FILES['feature_image']['name'];
        $news->set('feature_image',$name);
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
  }
  /* end of feature image upload */


  $news->set('short_description',$_POST['short_description']);
  $news->set('description',$_POST['description']);
  $news->set('slider_key',$_POST['slider_key']);
  $news->set('feature_key',$_POST['feature_key']);
  $news->set('breaking_key',$_POST['breaking_key']);
  $news->set('id',$_POST['news_id']);
  $news->set('status',$_POST['status']);
  $news->set('updated_at',date('Y-m-d H:i:s'));
  $news->set('updated_by',$_SESSION['id']);
  if(count($err) == 0){
    $status = $news->edit();
  }

}
$categoryList = $news->getCategoryNameAndId();


if (isset($_GET['id'])){
	$news->set('id',$_GET['id']);
	$data = $news->getNewsById();
	if (count($data)==0){
		header('location:list_news.php');
	}
} else{
  header('location:list_news.php');
}
?>


<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">News Management</h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">edit news
          <a href="list_news.php" class="btn btn-primary"><i class="fas fa-list"></i> List</a>
        </h6>
			</div>
			<div class="card-body">
				<?php if (isset($status) && $status === true) { ?>
                  <div class="alert alert-success" >Update Success!!!</div>
                  <?php } ?>
                  <?php if (isset($status) && $status !== true) { ?>
                  <div class="alert alert-danger" >Update Failed!!! <?php echo $status; ?></div>
                  <?php } ?>  

				<form class="" action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $_GET['id'] ?>" method="post" id="insertForm" enctype="multipart/form-data">
				<input type="hidden" name="news_id" value="<?php echo $_GET['id'] ?>">

          <div class="form-group">
            <label for="name">Category Name</label>
            <select name="category_id" class="form-control" id="category_id" >
              <option value="">Select Category</option>

              <?php foreach ($categoryList as $cl){ 
                if ($cl->id==$data[0]->category_id){
                  ?>
                   <option value="<?php echo $cl->id ?>" selected="true"><?php echo $cl->name ?></option>
                  <?php } else{ ?>
                       <option value="<?php echo $cl->id ?>"><?php echo $cl->name ?></option>
                      <?php   } ?>
              <?php } ?>
            </select>
          </div> 
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" name="title" class="form-control" id="title" value="<?php echo $data[0]->title ?>">
					</div>
					<div class="form-group">
						<label for="slug">Slug</label>
						<input type="text" name="slug" class="form-control" id="slug" value="<?php echo $data[0]->slug ?>">
					</div>
          <div class="form-group">
            <label for="description">Short Description</label>
            <textarea id="short_description" name="short_description"  class="form-control">
              <?php echo $data[0]->short_description ?>
            </textarea>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control">
              <?php echo $data[0]->description ?>
            </textarea>
          </div>
					<div class="form-group">
						<label for="feature_image">Feature Image</label>
            <img src="images/<?php echo $data[0]->feature_image ?>" height="100px" width="100px">

						<input type="file" name="feature_image" class="form-control" id="feature_image" >

					</div>
          <div class="form-group">
            <label for="deactive">Display into Feature News</label>

		    <?php if ($data[0]->feature_key==1){ ?>
             <input type="radio" name="feature_key" id="active" value="1" checked="checked">Active
            <input type="radio" name="feature_key" id="deactive" value="0">De Active
            <?php } else { ?>
             <input type="radio" name="feature_key" id="active" value="1">Active
            <input type="radio" name="feature_key" id="deactive" value="0" checked="checked">De Active
             <?php } ?>
          </div>
          <div class="form-group">
            <label for="deactive">Display into Breaking News</label>
            <?php if ($data[0]->breaking_key==1){ ?>
            <input type="radio" name="breaking_key" id="active" value="1" checked="checked">Active
            <input type="radio" name="breaking_key" id="deactive" value="0">De Active
            <?php } else { ?>
            <input type="radio" name="breaking_key" id="active" value="1">Active
            <input type="radio" name="breaking_key" id="deactive" value="0" checked="checked">De Active
             <?php } ?>
          </div>
          <div class="form-group">
            <label for="deactive">Display into Slider News</label>
            <?php if ($data[0]->slider_key==1){ ?>
            <input type="radio" name="slider_key" id="active" value="1" checked="checked">Active
            <input type="radio" name="slider_key" id="deactive" value="0">De Active
            <?php } else { ?> 
            <input type="radio" name="slider_key" id="active" value="1">Active
            <input type="radio" name="slider_key" id="deactive" value="0" checked="checked">De Active
            <?php } ?>
        </div>
		<div class="form-group">
			<label for="deactive">Status</label>
			<?php if ($data[0]->status==1){ ?>
			<input type="radio" name="status" id="active" value="1" checked="checked">Active
			<input type="radio" name="status" id="deactive" value="0" >De Active
			<?php } else { ?>
			<input type="radio" name="status" id="active" value="1">Active
			<input type="radio" name="status" id="deactive" value="0" checked="checked">De Active
			<?php } ?>
		</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success" name="btnSave"> <i class="fas fa-save"></i>Update</button>
						<button type="reset" class="btn btn-danger"> <i class="fas fa-recycle"></i>Clear</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php require_once "footer.php"; ?>
<script type="text/javascript" src="js/jquery_validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="vendor/cKeditor/cKeditor.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
      //$('#loginform').validate();
      $("#insertForm").validate({
      	rules: {
    // simple rule, converted to {required:true}
    title: "required",
    slug: "required",
  
    category_id: "required",
}
});
      $("#title").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug").val(Text);        
});
});
  ClassicEditor
    .create( document.querySelector( '#description' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
</script>
 