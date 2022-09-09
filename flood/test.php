<?php

   require_once("db/opendb.php");
  $q = "SELECT * FROM `device`";
  echo $q;
  $result= $conn -> query($q) or die("Query error");                          
  foreach($result as $row)
  {
    
  echo $row['device_id'] ;            

                                                 

  }
  ?>
