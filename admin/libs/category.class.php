<?php
require_once "common.class.php";
class category extends common{
	protected $id,$name,$slug,$rank,$status,$created_by,$updated_by,$created_at,$updated_at;

	function add(){
		$sql = "insert into tbl_categories (name,slug,rank,status,created_by,created_at) values('$this->name','$this->slug','$this->rank','$this->status','$this->created_by','$this->created_at')";
		return $this->insert($sql);
	}

	function lists(){
		$sql = "select c.id,c.name,c.rank,c.status,c.created_by,c.created_at,u.name as uname from tbl_categories as c join tbl_users as u on c.created_by=u.id";
		return $this->select($sql);
	}

	function edit(){
		$sql = "update tbl_categories set name='$this->name',slug='$this->slug',rank='$this->rank',status='$this->status',updated_at='$this->updated_at',updated_by='$this->updated_by' where id='$this->id'";
		return $this-> update($sql);
	}

	function remove(){
		$sql = "delete from tbl_categories where id='$this->id'";
		return $this->delete($sql);
	}
	function getCategoryById(){
		$sql = "select c.* ,u.name as uname from tbl_categories as c join tbl_users as u on c.created_by=u.id where c.id='$this->id'";
		return $this->select($sql);	
	}
	function getCategoryNameAndId(){
        $sql = "select id,name from tbl_categories order by name asc";
		return $this->select($sql);	
	}
	function getCategoryCount(){
		$sql = "select count(*) as category_count from tbl_categories";
		return $this->select($sql);
	}

	function getCategoryForMenu(){
		$sql = "select id,name,slug from tbl_categories where status=1 order by rank";
		return $this->select($sql);
	}
}
?>