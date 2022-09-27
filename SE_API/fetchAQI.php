<?php  
require_once 'dbconnection.php';


$device_id=$_POST['device_id'];
  
function Linear($AQIhigh, $AQIlow, $Conchigh, $Conclow, $Concentration)
{
  $linear;
  $Conc=$Concentration;
  $a;
  $a=(($Conc-$Conclow)/($Conchigh-$Conclow))*($AQIhigh-$AQIlow)+$AQIlow;
  $linear=round($a);
  return $linear;
}

function AQIPM25($Concentration)
{
    $Conc=$Concentration;
    $c;
    $AQI;
    $c=(10*$Conc)/10;
    if ($c>=0 && $c<12.1)
    {
      $AQI=Linear(50,0,12,0,$c);
    }
    else if ($c>=12.1 && $c<35.5)
    {
      $AQI=Linear(100,51,35.4,12.1,$c);
    }
    else if ($c>=35.5 && $c<55.5)
    {
      $AQI=Linear(150,101,55.4,35.5,$c);
    }
    else if ($c>=55.5 && $c<150.5)
    {
     $AQI=Linear(200,151,150.4,55.5,$c);
    }
    else if ($c>=150.5 && $c<250.5)
    {
     $AQI=Linear(300,201,250.4,150.5,$c);
    }
    else if ($c>=250.5 && $c<350.5)
    {
      $AQI=Linear(400,301,350.4,250.5,$c);
    }
    else if ($c>=350.5 && $c<500.5)
    {
      $AQI=Linear(500,401,500.4,350.5,$c);
    }
    else
    {
     $AQI="Out of Range";
    }
    return $AQI;
}

    // $query="SELECT device.name as device_name,device.*,devices_logs.* from devices_logs, device where id in (SELECT max(id) from devices_logs group by device_id) and device.device_id = devices_logs.device_id and device.device_id='$device_id' ORDER by device.device_id asc";
    $query = "SELECT device.device_id, AVG(devices_logs.Dust_sensor_2p5) AS avg1, date(datetime) dt FROM device JOIN devices_logs ON device.device_id = devices_logs.device_id and devices_logs.device_id='".$device_id."' GROUP BY date(datetime), device_id order by date(datetime) DESC LIMIT 7";

    // $query = "SELECT datentime,Dust_sensor_2p5 FROM device WHERE device_id='$device_id'";
    $result = $conn->query($query) or die("Query error");
            
                           
  if(mysqli_num_rows($result)>0){ 
    $data = array(); 
    while($row=$result->fetch_assoc()){
      $temp1= $row;
      // array_push($data, "val1"=>AQIPM25($temp1['Dust_sensor_2p5']));
      // array_push($data, "dt"=>$temp1['datentime']);

      $data = array("aqi"=>AQIPM25($temp1['avg1']), "dt"=>$temp1['dt']);
      $res[]=$data;
    }
  }
  else{
    $response['error']="400";
    $response['message']="Wrong ";

  }
  echo json_encode($res) ;
      

?>