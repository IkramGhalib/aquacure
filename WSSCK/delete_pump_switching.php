<?php
    require_once("opendb.php");
    $fid = $_GET['pumpid'];        
    $q = "DELETE FROM auto_switching WHERE id = '$fid' ";
    $result = $conn -> query($q) or die(error);
    
    echo "<script> window.open('auto_switching.php?filter=0G0' , '_self'); </script>";
    
    $conn = NULL;

?>