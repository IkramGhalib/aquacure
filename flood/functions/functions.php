<?php   
// return last updated River data data
function currentRiverLevel($id)
{
	include('db/opendb.php');
	
	$query="SELECT * from water_level where datetime=(select max(datetime) as maxtime from water_level where branch=$id) and branch=$id";
	try{
	$result = $conn->query($query) or die();
		}
		catch(PDOException $e)
		{
			echo  $e;
		}
	return $result;
}

		//Return last updated flow
// function currentFlow($id)
// {
// 	include('db/opendb.php');
// 	 $query="SELECT * from flow where date_time=(select max(date_time) as maxtime from flow where flood_info=$id) and flood_info=$id";
// 	 try{
// 	 $result = $conn->query($query) or die();
// 	}
// 	catch(PDOException $e)
// 	{
// 		echo $e;
// 	}
// 	 return $result;
	
// }
//Return last updated rainfall data
// function currentRainfall($id)
// {
// 	include('db/opendb.php');
// 	 $query="SELECT * from rainfall where date_time=(select max(date_time) as maxtime from rainfall where flood_info=$id) and flood_info=$id";
// 	 try{
// 	 $result = $conn->query($query) or die();
// 	}
// 	catch(PDOException $e)
// 	{
// 		echo $e;
// 	}
// 	 return $result;
	
// }
//Return last 24 hour hourly river level data in the table
function riverLevelCurrentHourlyData($id)
{
	include('db/opendb.php');
	$query="SELECT FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(date_time) / (60*60)) * (60*60)) AS hourlytime, level_m from river_level where flood_info=$id GROUP BY level_m, hourlytime ORDER BY hourlytime desc limit 24 ";
	try{
	 $result = $conn->query($query) or die();
	}
	catch(PDOException $e)
	{
		echo $e;
	}
	 return $result;
	
}
//Return last 24 hour hourly Rainfall data in the table

function rainfallCurrentHourlyData($id)
{
	include('db/opendb.php');
	$query="SELECT FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(date_time) / (60*60)) * (60*60)) AS hourlytime, current_rainfall,cumulative_rainfall from rainfall where flood_info=$id GROUP BY current_rainfall,cumulative_rainfall, hourlytime ORDER BY hourlytime desc limit 24 ";
	try{
	 $result = $conn->query($query) or die();
	}
	catch(PDOException $e)
	{
		echo $e;
	}
	 return $result;
	
}
//Return last 24 hour hourly flow data in the table
function flowCurrentHourlyData($id)
{
	include('db/opendb.php');
	$query="SELECT FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(date_time) / (60*60)) * (60*60)) AS hourlytime, flow_ml_day,flow_m3_sec from flow where flood_info=$id GROUP BY flow_ml_day,flow_m3_sec, hourlytime ORDER BY hourlytime desc limit 24 ";
	try{
	 $result = $conn->query($query) or die();
	}
	catch(PDOException $e)
	{
		echo $e;
	}
	 return $result;
	
}

// return yesterday river_level data

function yesterdayRiverLevelData($id)
{
	include('db/opendb.php');
	$query="SELECT * FROM water_level WHERE datetime <= NOW() - INTERVAL 1 DAY AND branch=$id";
	try{
	 $result = $conn->query($query) or die();
	}
	catch(PDOException $e)
	{
		echo $e;
	}
	 return $result;
}

//Return yesterday Flow data
function yesterdayFlowData($id)
{
	include('db/opendb.php');
	$query="SELECT * FROM water_level WHERE datetime <= NOW() - INTERVAL 1 DAY AND branch=$id";
	try{
	 $result = $conn->query($query) or die();
	}
	catch(PDOException $e)
	{
		echo $e;
	}
	 return $result;
}

?>