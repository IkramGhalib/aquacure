<?php

	$subdivid = "brtpswr";
  	$dbtype = "electrocure";
	$servername = "10.13.144.6";
	$username = "user_".$subdivid;
	$password = "Adm1n@".$subdivid;
	$dbname = $dbtype."_".$subdivid;



	// $subdivid = "brtpswr";
 //  	$dbtype = "electrocure";
	// $servername = "localhost";
	// $username = "root";
	// $password = "";
	// $dbname = $dbtype."_".$subdivid;
	
	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connection Successfull";
	}
	catch(PDOException $e){
		echo  $e->getMessage();
	}

	$query_check = "insert into billing_postpaid (cid) SELECT cid from connections where billing_method = 'postpaid' and cid not in (select DISTINCT cid from billing_postpaid )";
	$result = $conn -> query($query_check) or die(error);

	$query = "select billing_postpaid.cid, total_bill-paid_amount as arrears, ((peak+offpeak)-billing_postpaid.current_reading) as units, (peak+offpeak) as current_reading from billing_postpaid inner join connections on connections.cid = billing_postpaid.cid where bill_id in (select max(bill_id) from billing_postpaid group by cid)";

	// $query = "select cid, ((peak+offpeak)-unit_limit) as units, (peak+offpeak) as current from connections where billing_method = 'postpaid' and status != 'unassigned'";
	$result = $conn -> query($query) or die(error);

	$connections = array();
	foreach ($result as $row) {
		array_push($connections,$row);
	}

	//print_r($connections);
	$query2 = "select postpaid_unit, fpa ,gst,surcharge from tariff_electrocure order by datetime desc limit 1";
	$result2 = $conn -> query($query2) or die(error);

	foreach ($result2 as $row) {
		$fpa = $row['fpa'];
		$priceperunit = $row['postpaid_unit']
		$tarrif =  $priceperunit+$fpa;
		$gst=$row['gst'];
		$surcharge=$row['surcharge'];		
	}

	$insert = "insert into billing_postpaid (cid, last_arrears, current_reading, units_consumed, tariff,gst,gstamount, total_bill, perunitprice, fpa) values";

	for ($i=0; $i < sizeof($connections) ; $i++) { 
		$arrears=round($connections[$i]['arrears'],2);
		$surcharge_amount=$arrears*$surcharge/100;
		$arrears=$arrears+$surcharge_amount;
		$bill = round($connections[$i]['units']*$tarrif,2);
		$gstamount=$bill*$gst/100;
		$bill=$bill+$gstamount+$arrears;

		
		
		$insert .= "('".$connections[$i]['cid']."', ".$arrears.", ".round($connections[$i]['current_reading'],2).", ".round($connections[$i]['units'],2).",$tarrif,$gst,$gstamount, $bill, $priceperunit, $fpa)";
		if ($i != (sizeof($connections)-1)) {
		$insert .= ",";
		}
	}

	//echo $insert;

	try {
    $stmt = $conn -> prepare($insert);
    $stmt->execute();
	  
    if ($stmt -> rowCount()>0) {
      echo "Electrocure Success!<br>";
    }else
	  echo "Error!";
	} catch (Exception $e) {
	  echo "Error encountred: ".$e;
	}


	$query_check = "insert into tr_billing_postpaid (trid) SELECT trid from transformer where billing_method = 'postpaid' and trid not in (select DISTINCT trid from tr_billing_postpaid )";

	//echo $query_check;

	//echo "<br><br><br>";

	$result = $conn -> query($query_check) or die(error);

	$query = "select tr_billing_postpaid.trid, total_bill-paid_amount as arrears, ((peak_dev+offpeak_dev)-tr_billing_postpaid.current_reading) as units, (peak_dev+offpeak_dev) as current_reading from tr_billing_postpaid inner join transformer on transformer.trid = tr_billing_postpaid.trid where bill_id in (select max(bill_id) from tr_billing_postpaid group by trid)";

	// $query = "select trid, ((peak+offpeak)-unit_limit) as units, (peak+offpeak) as current from transformer where billing_method = 'postpaid' and status != 'unassigned'";
	$result = $conn -> query($query) or die(error);

	$transformer = array();
	foreach ($result as $row) {
		array_push($transformer,$row);
	}

	//print_r($transformer);
	$query2 = "select postpaid_unit, gst, surcharge from tariff order by datetime desc limit 1";
	$result2 = $conn -> query($query2) or die(error);

	foreach ($result2 as $row) {
		$tarrif =  $row['postpaid_unit'];
		$gst=$row['gst'];
		$surcharge=$row['surcharge'];		
	}

	$insert = "insert into tr_billing_postpaid (trid, last_arrears, current_reading, units_consumed, tariff,gst,gstamount, total_bill) values";

	for ($i=0; $i < sizeof($transformer) ; $i++) { 

		$arrears = $transformer[$i]['arrears'];
		$surcharge_amount=$arrears*$surcharge/100;


		$arrears=$arrears+$surcharge_amount;


		$bill = $transformer[$i]['units']*$tarrif;


		$gstamount=$bill*$gst/100;

		$bill=$bill+$gstamount+$arrears;


		$insert .= "('".$transformer[$i]['trid']."', ".$arrears.", ".round($transformer[$i]['current_reading'],2).", ".round($transformer[$i]['units'],2).",$tarrif,$gst,$gstamount,$bill)";
		if ($i != (sizeof($transformer)-1)) {
		$insert .= ",";
		}
	}
	
	//echo $insert;
	
	try {
    $stmt = $conn -> prepare($insert);
    $stmt->execute();
	  
    if ($stmt -> rowCount()>0) {
      echo "Transformer Success!";
    }else
	  echo "Error!";
	} catch (Exception $e) {
	  echo "Error encountred: ".$e;
	}


?>