<?php
$data1 = array();
$data4 = array();

   require_once("db/opendb.php");
  $q = "SELECT * from water_level where branch = '1'";
  echo $q;
  $result= $conn -> query($q) or die("Query error");                          
  foreach($result as $row)
  {

    $level = $row['level'];

    array_push($data1,$level);
    array_push($data4,$row['datetime']);                                                

  }

  print_r($data1);
?>