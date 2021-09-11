<?php
require_once "common.class.php";
class user extends common{
	protected $id,$name,$email,$password,$username,$last_login,$status,$role_id,$image;

	public function login(){
		$this->connect();
		$sql = "select * from tbl_users where email='$this->email' and password='$this->password' and status=1"; 
		$result = $this->connection->query($sql);
		if($result->num_rows == 1){
			$data = $result->fetch_object();
			session_start();
			$_SESSION['id'] = $data->id;
			$_SESSION['name'] = $data->name;
			$_SESSION['email'] = $data->email;
			$_SESSION['image'] = $data->image;
			$_SESSION['role_id'] = $data->role_id;
			header('location:dashboard.php');
		}else{
			return false;
		}
	}
	public function fetchRole(){
		$sql = "SELECT * FROM tbl_roles";
		return $this->fetch($sql);
	}
	function add(){
		$sql = "insert into tbl_users (name,email,username,password,status,role_id) values('$this->name','$this->email','$this->username','$this->password','$this->status','$this->role')";
		return $this->insert($sql);
	}

	function lists(){
		$sql = "select * from tbl_users";
		return $this->select($sql);
	}

	function edit(){
		
	}

	function remove(){
		$sql = "delete from tbl_users where id='$this->id'";
		return $this->delete($sql);
	}

	function getUserById(){
		$sql = "select * from tbl_users where id='$this->id'";
		return $this->select($sql);	
	}
}
?>