<?php
	session_start();
	if(isset($_SESSION['name']) ){
	  echo "<script language='javascript'>window.location.href='dashboard.php';</script>";
	}else{
	header("Location: login.php");
	}
?>