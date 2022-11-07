<?php
	require_once("opendb.php");

	$id = explode('C', $_GET['id']);
	$c_no = explode('N', $id[1]);
	

	//print_r($c_no);
	$query = "select * from db_status where dbid = '".$id[0]."'";
	$result = $conn -> query($query) or die(error);
	$status = "";
	foreach ($result as $row) {	
		$status = $row['status'];
		$status_out = $row['status_out'];
		$cause = $row['cause'];
	}

	$split_status = str_split($status, 1);
	$split_cause = str_split($cause, 1);
	$split_status_out = str_split($status_out, 1);
	
	$index = (int)$c_no[1] -1;
	//echo $index;
	if ($split_status[$index] == 0) {
		$split_status[$index] = 1; //on
		$split_cause[$index] = 0;
		$split_status_out[$index] = 1;

	}elseif ($split_status[$index] == 1){
		$split_status[$index] = 0; //off
		$split_cause[$index] = 0;
		$split_status_out[$index] = 0;
	}

	$split_cause[$index] = 0; //online change
	$combined_status = "";
	$combined_cause = "";
	$combined_status_out = "";
	for ($i=0; $i < sizeof($split_status) ; $i++) { 
		$combined_status .= $split_status[$i];		
		$combined_cause .= $split_cause[$i];	
		$combined_status_out .= $split_status_out[$i];	
	}
	

	try{

		$query = " UPDATE  db_status set status = '".$combined_status."', cause ='" .$combined_cause. "', status_out = '".$combined_status_out."' , switch_time".(int)$c_no[1]."='".date('Y-m-d H:i:s')."' where dbid = '".$id[0]."'";



		//$query = "update db_status set status = '".$combined_status."', cause = '".$combined_cause."', status_out = '".$combined_status_out."' where dbid = '".$id[0]."'";
		//echo "$query";
		$result = $conn -> query($query) or die(error);	
	}catch(Exception $e){
		echo "Error: ".$query;

	}

	//echo "Success";

	$conn = NULL;

	echo "<script> window.location.href = 'cust_dashboard.php?id=$id[0]&status=all' </script>";

?>