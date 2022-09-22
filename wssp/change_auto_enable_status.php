<?php

    session_start();
    include_once("check_user.php");
?>

<?php

    include("DBConnection.php");

    $con = new DBCon();

        if($con->Open())
        {
            $fid = $_GET['pumpid'];
            $status = $_GET['en_status']; 

            date_default_timezone_set("Asia/Karachi");
             $dt = date("Y-m-d H:i:s");
            $datetime = date('Y-m-d H:i:s');
            $q = "Update auto_switching set en_status = '".$status."',Datetime = '".$datetime."' WHERE id = '".$fid."' ";
            
            $result = $con->db->query($q);
            
                if($con->db->affected_rows)
                {
                    
		   
                    echo "<script> window.open('auto_switching.php?filter=0G0' , '_self'); </script>";
                }
                else
                {
                    echo "0";
                }
        }
        else
        {
            echo "Connection Failed!";
        }

$con->db->close();

?>