<?php
require_once "common.class.php";
class role extends common{
	protected $id,$name,$status;

	function add(){
		$sql = "insert into tbl_roles (name,status) values('$this->name','$this->status')";
		return $this->insert($sql);
	}

	function lists(){
		$sql = "select * from tbl_roles";
		return $this->select($sql);
	}

	function edit(){
		$sql = "update tbl_roles set name='$this->name',status='$this->status' where id='$this->id'";
		return $this-> update($sql);
	}

	function remove(){
		$sql = "delete from tbl_roles where id='$this->id'";
		return $this->delete($sql);
	}

	function getRoleById(){
		$sql = "select * from tbl_roles where id='$this->id'";
		return $this->select($sql);	
	}
}
?>