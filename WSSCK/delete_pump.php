<?php
    require_once("opendb.php");

    $fid = $_GET['pumpid'];
    $q = "DELETE FROM transformer WHERE trid = '$fid' ";
    $result = $conn -> query($q) or die(error);

    $conn = NULL; 

    echo '<script type="text/javascript"> window.location.href = "list.php"; </script>';
?>
