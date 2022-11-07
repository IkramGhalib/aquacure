<?php session_start();
	require_once("opendb.php"); 
    $id="";
	if (isset($_GET['id'])==TRUE){
	$id= $_GET['id'];
	}
	
	$query="delete from connections where cid='". $id ."'";
	$conn->query($query)or die("deleting error");
	echo "<script language = \"javascript\" type = \"text/javascript\"> window.location.href=\"connection-list.php?filter=0G0\"; </script>";	
?>