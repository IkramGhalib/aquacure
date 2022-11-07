<?php

	$trid = $_GET['id'];
	$date = $_POST[$trid];

	// echo $trid;
	// echo $date
	

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

	$query = "select tr_billing_postpaid.trid, total_bill-paid_amount as arrears, ((select max(peak_dev+offpeak_dev) from tr_kwh_logs where tr_kwh_logs.trid = tr_billing_postpaid.trid AND datetime <= '".$date."')-tr_billing_postpaid.current_reading) as units, (select max(peak_dev+offpeak_dev) from tr_kwh_logs where tr_kwh_logs.trid = tr_billing_postpaid.trid AND datetime <= '".$date."') as current_reading from tr_billing_postpaid  inner join transformer on transformer.trid = tr_billing_postpaid.trid where bill_id in (select max(bill_id) from tr_billing_postpaid where tr_billing_postpaid.trid = '".$trid."') ";
	echo $query;

	// $query = "select trid, ((peak+offpeak)-unit_limit) as units, (peak+offpeak) as current from transformer where billing_method = 'postpaid' and status != 'unassigned'";
	$result = $conn -> query($query) or die(error);

	$transformer = array();
	foreach ($result as $row) {
		array_push($transformer,$row);
	}

	//print_r($transformer);
	$query2 = "select postpaid_unit from tariff order by datetime desc limit 1";
	$result2 = $conn -> query($query2) or die(error);

	foreach ($result2 as $row) {
		$tarrif =  $row['postpaid_unit'];		
	}

	$insert = "insert into tr_billing_postpaid (trid, last_arrears, current_reading, units_consumed, tariff, total_bill) values";

	for ($i=0; $i < sizeof($transformer) ; $i++) { 
		$bill = round($transformer[$i]['arrears']+$transformer[$i]['units']*$tarrif,2);
		$insert .= "('".$transformer[$i]['trid']."', ".round($transformer[$i]['arrears'],2).", ".round($transformer[$i]['current_reading'],2).", ".round($transformer[$i]['units'],2).",$tarrif, $bill)";
		if ($i != (sizeof($transformer)-1)) {
		$insert .= ",";
		}
	}
	
	echo $insert;
	
	try {
    $stmt = $conn -> prepare($insert);
    $stmt->execute();
	  
    if ($stmt -> rowCount()>0) {
      echo "<script>window.location.href = 'bill_slip_tr.php?id=$trid'</script>";
    }else
	  echo "Error!";
	} catch (Exception $e) {
	  echo "Error encountred: ".$e;
	}

 ?>

