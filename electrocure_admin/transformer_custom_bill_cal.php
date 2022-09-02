<?php

	// $trid = $_GET['id'];
	// $date = $_POST[$trid];
	
	
	// echo $trid;
	// echo $date
	
if (isset($_GET['id']) and isset($_POST['start']) and isset($_POST['end'])) {

	$trid = $_GET['id'];
	$start = $_POST['start'];
	$end = $_POST['end'];

	require_once("opendb.php");

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
	    echo  $e->getMessage();
	    }

	// $query_check = "insert into tr_billing_postpaid (trid) SELECT trid from transformer where billing_method = 'postpaid' and trid not in (select DISTINCT trid from tr_billing_postpaid )";

	// echo $query_check;

	// echo "<br><br><br>";

	// $result = $conn -> query($query_check) or die(error);

	$query = "SELECT max(peak_dev+offpeak_dev) as end, min(peak_dev+offpeak_dev) as start FROM `tr_kwh_logs` WHERE trid = 'I1F1TR07' and Datetime BETWEEN '".$start."' and '".$end."'";

	$result = $conn -> query($query) or die(error);

	$unit_start = 0;
	$unit_end = 0;
	foreach ($result as $row) {
		$unit_start = round($row['start']);
		$unit_end = round($row['end']);
	}

	$units_consumed = $unit_end - $unit_start;

	$query2 = "select * from tariff order by datetime desc limit 1";
	$result2 = $conn -> query($query2) or die(error);

	$tariff = 0;
	$gst = 0;
	foreach ($result2 as $row) {
		$tariff =  $row['postpaid_unit'];
		$gst = $row['gst'];		
	}

	$bill = $units_consumed*$tariff;
	
	$total_gst = $bill * $gst / 100;
	$total_bill = $bill + $total_gst;

	echo $bill."<br>";
	echo $total_gst."<br>";
	echo $total_bill."<br>";


	$employee = 'Admin';

	$insert = "INSERT INTO `tr_billing_custom`(`trid`, `units_from`, `units_to`,`date_from`,`date_to`, `total_units`, `tariff`, `gst`, `gstamount`, `total_bill`, `generated_by`) VALUES ('$trid', $unit_start,$unit_end,'$start', '$end', $units_consumed,$tariff,$gst,$total_gst,$total_bill,'$employee')";

	echo $insert;
	
	try {
    $stmt = $conn -> prepare($insert);
    $stmt->execute();
	  
    if ($stmt -> rowCount()>0) {
      echo "<script>window.location.href = 'bills_tr_custom_list.php?id=$trid'</script>";
    }else
	  echo "Error!";
	} catch (Exception $e) {
	  echo "Error encountred: ".$e;
	}

}else{
	echo "Input data error!";
}

 ?>

