<?php

require_once 'dbconnection.php';
 
  $query="SELECT * FROM devices_logs";
    $result=mysqli_query($conn,$query);
    $rowCount=mysqli_num_rows($result);

    if($rowCount>0){
        $data=array();
        while($row=mysqli_fetch_assoc($result)){
            $data[]=$row;
             $data_res=$data;

        }
    }
    else{
        $data_res=array('status'=>false,'response'=>$data_res);

    }

    echo json_encode($data_res);





?>