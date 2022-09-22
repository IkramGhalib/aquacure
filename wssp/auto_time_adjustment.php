<?php
	include("opendb.php");

	$id = $_GET['pumpid'];
	$status = $_GET['status'];
	if ($status == 0) {
		$newStatus = 1;	
	}else{
		$newStatus = 0;	
	}

	$query = "update auto_switching set auto_time_adjustment = '$newStatus' where id = '$id'";

	$result = $conn -> query($query) or die(error);
	echo "<script> window.location.href = 'auto_switching.php?success'</script>";
?>

<script> window.location.href = 'auto_switching.php?success'</script>