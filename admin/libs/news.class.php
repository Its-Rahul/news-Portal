<?php
require_once "common.class.php";
class news extends common{
	protected $id,$category_id,$title,$slug,$feature_image,$short_description,$description,$feature_key,$breaking_key,$slider_key,$status,$created_by,$updated_by,$created_at,$updated_at;

	function add(){
		 $sql = "insert into tbl_news (category_id,title,slug,feature_image,short_description,description,feature_key,breaking_key,slider_key,status,created_by,created_at) values('$this->category_id','$this->title','$this->slug','$this->feature_image','$this->short_description','$this->description','$this->feature_key','$this->breaking_key','$this->slider_key','$this->status','$this->created_by','$this->created_at')";
		return $this->insert($sql);
	}

	function lists(){
		$sql = "select * from tbl_news";
		return $this->select($sql);
	}

	function edit(){
		if (!empty($this->feature_image)){
			$sql = "update tbl_news set category_id='$this->category_id',title='$this->title',slug='$this->slug',feature_image='$this->feature_image',short_description='$this->short_description',description='$this->description',feature_key='$this->feature_key',breaking_key='$this->breaking_key',slider_key='$this->slider_key',status='$this->status',updated_at='$this->updated_at',updated_by='$this->updated_by' where id='$this->id'";
		} else {
			 $sql = "update tbl_news set category_id='$this->category_id',title='$this->title',slug='$this->slug',short_description='$this->short_description',description='$this->description',feature_key='$this->feature_key',breaking_key='$this->breaking_key',slider_key='$this->slider_key',status='$this->status',updated_at='$this->updated_at',updated_by='$this->updated_by' where id='$this->id'";
		} 
		return $this-> update($sql);

	}

	function remove(){
		$sql = "delete from tbl_news where id='$this->id'";
		return $this->delete($sql);
	}
	function getNewsById(){
		$sql = "select * from tbl_news where id='$this->id'";
		return $this->select($sql);	
	}
	function getCategoryNameAndId(){
        $sql = "select id,name from tbl_categories order by name asc";
		return $this->select($sql);	
	}
	
	function changeStatus(){
		$sql = "update tbl_news set status='$this->status' where id='$this->id'";	
		return $this->update($sql);	
	}

	function getCurrentMonthNewsCount(){
		$sql = "select count(*) as news_count from tbl_news where created_at > DATE_SUB(NOW(),INTERVAL 1 MONTH)";
		return $this->select($sql);
	}
		function getTrendingNews(){
		$sql = "select id,title,slug from tbl_news where status='1' and trending_key=1 order by created_at desc";
		return $this->select($sql);
	}
	function getNewsForSlide(){
			$sql = "select c.name n.id,n.title,n.slug,n.feature_image,n.short_description,n.created_at from tbl_news n join tbl_categories c on n.category_id=c.id where n.status='1' and n.slider_key=1 order by n.created_at desc";
		return $this->select($sql);
	}
}

?>