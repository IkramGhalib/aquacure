<?php
	$id = $_GET['id'];
	require_once("opendb.php");

	$query = "delete from login_info where id = '$id'";
	$result = $conn -> query($query) or die(error);

	echo "<script> window.location.href = 'users.php?success'</script>";

?>

