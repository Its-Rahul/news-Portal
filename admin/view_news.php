<?php 
$title = 'View News';
require_once "header.php"; 
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
				<h6 class="m-0 font-weight-bold text-primary">View News 
				<a href="add_news.php" class="btn btn-success"><i class="fas fa-plus"></i> Add</a>
				 <a href="list_news.php" class="btn btn-primary"><i class="fas fa-list"></i> List</a>
				</h6>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<tr>
						<th>Title</th>
						<td><?php echo $data[0]->title ?></td>
					</tr>
					<tr>
						<th>Category Id</th>
						<td><?php echo $data[0]->category_id ?></td>
					</tr>
					<tr>
						<th>Slug</th>
						<td><?php echo $data[0]->slug ?></td>
					</tr>
					<tr>
						<th>Short Description</th>
						<td><?php echo $data[0]->short_description ?></td>
					</tr>
					<tr>
						<th>Description</th>
						<td><?php echo $data[0]->description ?></td>
					</tr>
					<tr>
						<th>Feature Image</th>
						<td><?php echo $data[0]->feature_image ?></td>
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
						<th>slider_key</th>
						<td>
								<?php if($data[0]->slider_key){ ?>
									<label class="text text-success">Active</label>
								<?php } else{ ?>
									<label class="text text-danger">De Active</label>
								<?php } ?>
						</td>
					</tr>
					<tr>
						<th>feature_key</th>
						<td>
								<?php if($data[0]->feature_key){ ?>
									<label class="text text-success">Active</label>
								<?php } else{ ?>
									<label class="text text-danger">De Active</label>
								<?php } ?>
						</td>
					</tr>
					<tr>
						<th>breaking_key</th>
						<td>
								<?php if($data[0]->breaking_key){ ?>
									<label class="text text-success">Active</label>
								<?php } else{ ?>
									<label class="text text-danger">De Active</label>
								<?php } ?>
						</td>
					</tr>	

					<tr>
						<th>Created by</th>
						<td><?php echo $data[0]->created_by ?></td>
					</tr>
					<tr>
						<th>Updated by</th>
						<td><?php echo $data[0]->updated_by ?></td>
					</tr>
					<tr>
						<th>Created at</th>
						<td><?php echo $data[0]->created_at ?></td>
					</tr>
					<tr>
						<th>Updated at</th>
						<td><?php echo $data[0]->updated_at ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<?php require_once "footer.php"; ?>