<?php

require "connection.php";

// $qry ="Select * from auto_switching";
// $exe = $conn->prepare($qry);
// $exe->execute();
// $result= $exe->fetchAll(PDO::FETCH_ASSOC);
// if($result){
//     foreach($result as $row){
//         echo '<br>'.'<h5>ID</h5>'.$row['trid'].'<br>'.'<h5>StartTime</h5>'.$row['starttime'].'<br>'.'<h5>Offtime</h5>'.$row['offtime'].'<br>';
//     }

// }
$week_days = 7;
echo "Schedule:";
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $qry ="SELECT * from auto_switching where trid='$id'";
    $exe = $conn->prepare($qry);
    $exe->execute();
    $result= $exe->fetchAll(PDO::FETCH_ASSOC);
    if($result){
    foreach($result as $row){
       
        
        if($row['repeat']==0){
       
        for($i=0;$i<$week_days;$i++){
            // $demo_string = str_replace(':', '',$row['starttime']);
            // echo $demo_string
            // echo $row['starttime'].','.$row['offtime'];
           
            $rmove_sec_1=substr($row['starttime'],0,-3);
            $rmove_sec_2=substr($row['offtime'],0,-3);
            $frmt_1 = str_replace(':', '', $rmove_sec_1);
            $frmt_2 = str_replace(':', '', $rmove_sec_2);
            echo $frmt_1.",".$frmt_2.";";
        }
        

    }
    
    if($row['repeat']==3){
        // echo $row['trid']."<br>";
        // echo "Schedule:";
        for($i=0;$i<$week_days;$i++){
            $rmove_sec_1=substr($row['starttime'],0,-3);
            $rmove_sec_2=substr($row['offtime'],0,-3);
            $frmt_1 = str_replace(':', '', $rmove_sec_1);
            $frmt_2 = str_replace(':', '', $rmove_sec_2);
            echo $frmt_1.",".$frmt_2.";";

        }
    }
    
    if($row['repeat']==2){
        // echo $row['trid']."<br>";
        echo "Schedule:";
        for($i=0;$i<$week_days;$i++){
            $rmove_sec_1=substr($row['starttime'],0,-3);
            $rmove_sec_2=substr($row['offtime'],0,-3);
            $frmt_1 = str_replace(':', '', $rmove_sec_1);
            $frmt_2 = str_replace(':', '', $rmove_sec_2);
            echo $frmt_1.",".$frmt_2.";";

        }
    }
    if($row['repeat']==5){
        // echo $row['trid']."<br>";
        
        for($i=0;$i<$week_days;$i++){
            $rmove_sec_1=substr($row['starttime'],0,-3);
            $rmove_sec_2=substr($row['offtime'],0,-3);
            $frmt_1 = str_replace(':', '', $rmove_sec_1);
            $frmt_2 = str_replace(':', '', $rmove_sec_2);
            echo $frmt_1.",".$frmt_2.";";

        }
    }

    // echo  "<br>";
 
    }
    echo "END";

    }
   
}

?>