<?php
require_once 'opendb.php';
$device_id=$_POST['device_id'];
$query = "SELECT envocure.name as device_name,envocure.*,devices_logs.* from devices_logs, envocure where id in (SELECT max(id) from devices_logs group by eid) and envocure.eid = devices_logs.eid and envocure.eid='$device_id' ORDER by devices_logs.datetime desc";


//   $query="select trid,name,longitude,latitude from transformer where trid='$device_id'";
  $result=mysqli_query($conn,$query);
  $response=array();
  if($result){
    foreach($result as $row){
        $response=$row;
        $data=array('data'=>$response);
  }
}
  else{
    $response['error']="400";
    $response['message']="Data does not exist";

  }
  echo json_encode($response);
  
 

?>