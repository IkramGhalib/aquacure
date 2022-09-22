<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>

<?php

    include("DBConnection.php");

    $con = new DBCon();

        if($con->Open())
        {
            $fid = $_GET['pumpid'];
            $status = $_GET['status'];
            $status_out= 1;
            $totalconsumption = 0.0;
            //date_default_timezone_set("Asia/Karachi");
            $dt = date("Y-m-d H:i:s");
            $datetime = date('Y-m-d H:i:s');

            if ($status == 'Off')
            {
                $status_out=0;
                $q = "select * from transformer WHERE pump_id = '".$fid."' ";
                //echo $q;
                $result = $con->db->query($q);
                $row6 = mysqli_fetch_array($result);
                $ontime = $row6['switch_time'];
                $name = $row6['name'];                
                $phone1 = $row6['pump_operator1'];
                $phone2 = $row6['pump_operator2'];
                $phone3 = $row6['pump_operator3'];

                if (strlen($row6['switch_time'])== 19 )
                    $switchdatetime  = substr($row6['switch_time'],2);
                else
                    $switchdatetime = $row6['switch_time']; 
                $ontime = $switchdatetime;
           
                $lasttime=strtotime($switchdatetime); 
                $currenttime = date('Y-m-d H:i:s');
                if (strlen($currenttime)==19)
                    $currenttime = strtotime(substr($currenttime,2));
                else
                    $currenttime = strtotime($currenttime);
            
                $timediff = abs(ceil(($currenttime-$lasttime)/60));
                $switchdatetime = strtotime($switchdatetime);
                $pumping_capacity = $row6['pumping_capacity'];
                $year 	  = date('Y');
                $month	  = date('F');
                $day      = explode('-',date('d-m-y'));
                $gallonhr = round($timediff * $pumping_capacity/60,2);
                $insert = "INSERT INTO `tr_kwh_daily`( `trid`, `offpeak`, `peak`, `year`, `month`, `day`, `timeswitchedOn`, `timeswitchedoff`, `total`,`yield`) VALUES ('".$fid."','".$row6['yieldoffpk']."','".$row6['yieldpk']."','".$year."','".$month."','".$day[0]."','".$ontime."','".$datetime."','".($row6['yieldoffpk']+$row6['yieldpk'])."','".$gallonhr."')";
                // echo $insert;
                $result8 = $con->db->query($insert);                 
                    
            }
            $q = "Update transformer set status = '".$status."' , cause = 'Online', switch_time = '".$dt."',status_out = '".$status_out."' WHERE trid = '".$fid."' "; 
           // echo $q;
            $result = $con->db->query($q);
            if($con->db->affected_rows)
            {
                $switched = "Switched ".$status;
                if (!empty($phone1)) {
                    sendMessage($fid, $name, $switched ,$phone1,$dt);
                }
                if (!empty($phone2)) {
                    sendMessage($fid, $name, $switched ,$phone2,$dt);
                }
                if (!empty($phone3)) {
                    sendMessage($fid, $name, $switched ,$phone3,$dt);
                }
                //sendMessage("1G1PM01", "CISNR Pump 01","switched on","923149868381","12:00:00");
                echo "<script> window.location=document.referrer; </script>";
                //header("location:javascript://history.go(-1)");

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

    function sendMessage($pump_id,$pump_name,$switched,$to,$dt){
        $id = "wsscs";
        $key = "3ecb61dda411351df4e25391e75b903c";
        $mask = "WSSCS";
        $lang = "en";
        $message = "Pump: ".$pump_name." (ID: ".$pump_id.") ".$switched." at ".$dt;
        // must URL encode to safely send all characters to the API URL
        $message = urlencode($message);
        $data ="id=".$id."&key=".$key."&mask=".$mask."&to=".$to."&msg=".$message."&lang=".$lang;
        $ch = curl_init('http://www.brandedsms.pk/api/sendsms.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        echo "Message Sent.........!";
    }


?>