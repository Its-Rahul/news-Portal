<?php

function checkLoginStatus(){
	session_start();
	if (!isset($_SESSION['name'])){
    header('location:index.php?msg=1'); 
  }
}


?>