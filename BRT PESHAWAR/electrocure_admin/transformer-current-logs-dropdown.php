<?php 
/****************************************************************************** 
PHP script to handle ajax request for dependant dropdown in 
transformer-current-logs.php file
author: @faheem
*****************************************************************************/
       $infeeder = $_POST['infeeder'];
		require_once("opendb.php");
			date_default_timezone_set("Asia/Karachi");
		//	$infeeder = 'I1';
			$q = "select * from outfeeder where substring_index(fdid,'F',1) = '$infeeder'";
    //        echo $q;
			 $result = $conn -> query($q) or die("Query error");
			
			echo "<option value = '--'>Select Out Feeder</option>";
                $farray = array();
			foreach($result as $row) 
			{
				echo "<option value = '".$row['fdid']."'>".$row['fdid']."__(".$row['name'].", ".$row['description'].")"."</option selected>";
                array_push($farray,array($row['fdid']=>$row['name']));
                
			}
		
			
			$conn= NULL;
	?>