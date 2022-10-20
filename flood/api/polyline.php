<?php
require_once 'opendb.php';

$fdate = $_POST['fdate'];
$tdate = $_POST['tdate'];
$deviceid = $_POST['deviceId'];

$query = "select moduleid,latitude,longitude from raw_data where longitude !=0 and latitude !=0 and moduleid = '".$deviceid."' AND serverdatetime BETWEEN '".$fdate."' AND '".$tdate."' ORDER BY serverdatetime ASC";
//   $query="select trid,name,longitude,latitude from transformer where trid='$device_id'";
  $result=mysqli_query($conn,$query);
  $response=array();
  if($result){
    foreach($result as $row){
        $response[]=$row;
        $data=array('data'=>$response);
  }
}
  else{
    $response['error']="400";
    $response['message']="Data does not exist";

  }
  echo json_encode($response);
 

?>