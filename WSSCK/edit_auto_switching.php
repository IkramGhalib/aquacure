<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php 

  $pageName = "Edit Auto Switching"?>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue sidebar-mini" >
<!-- Site wrapper -->
<div class="wrapper" style="overflow: hidden;">
  
  
  <!-- Navbar -->
  <?php include_once('navbar.php') ?>
  <!-- Sidebar -->
  <?php include_once('sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper" style="margin-top: <?php echo $contentmargin?>px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <b><?php echo $pageName;?></b>
        
      </h1>
      <h4><?php echo "Pump: <b>".$_GET['name']."</b>";?></h4>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $pageName;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
  




                               <?php 
                               //echo "test1";
 
                       require("DBConnection.php");
                       //echo "test2";
                       date_default_timezone_set("Asia/Karachi");
                      // echo "test3";
                       $con = new DBCon();
                       //echo "test4";
                  $a_id = $_GET['id'];
                  //echo "test5";
                if($con->Open())
                {
                  //echo "test6";
                  
                  $q = "select * from auto_switching where id = '".$a_id."'";
                  //echo "test7";
                  $result = $con->db->query($q); 
                  //echo "test8";
                    while($row = mysqli_fetch_array($result))
                    {
                        $starttime= $row['starttime'];
                        $offtime= $row['offtime'];
                        $r= $row['repeat'];
                        $pump_id= $row['trid'];
                    }
                   echo "<form action='edit_auto_switching.php' method = 'POST'>";               
    
                    echo "<table cellspacing = '5px' cellpadding = '5px'>";

                    
                      echo "<tr>";
                    
                        echo "<tr>";
                    echo "<td>Repeat</td>";
                    echo "<td><input type='hidden' name='a_id' value='".$a_id."'>
                          <td><input type='hidden' name='pump_id' value='".$pump_id."'></td>";
                    echo "</tr>";
                  
                   if($_GET['repeat']==0)
                   { 
                    echo "<tr>";
                    echo '<td><label><input type="checkbox" id="cdaily" name="cdaily" value="0">   Daily</label></td>';
                    echo '<td id="daily">Start Time: <input type="time" value="'.(($r==0)?$starttime:"").'"  name="daily_start">End Time: <input type="time" value="'.(($r==0)?$offtime:"").'" name="daily_end"></td>';
                    echo "</tr>";
                   }

                     if($_GET['repeat']==1)
                   { 

                    echo "<tr>";
                    echo '<td><label><input type="checkbox" id="cmon" name="cmon" value="1">   Monday</label></td>';
                    echo '<td id="mon">Start Time: <input type="time" name="mon_start" value="'.(($r==1)?$starttime:"").'">End Time: <input type="time" name="mon_end" value="'.(($r==1)?$offtime:"").'"></td>';
                    echo "</tr>";

                    }

                      if($_GET['repeat']==2)
                   { 

                     echo "<tr>";
                    echo '<td><label><input type="checkbox" id="ctue"  name="ctue" value="2">  Tuesday</label></td>';
                    echo '<td id="tue">Start Time: <input type="time" value="'.(($r==2)?$starttime:"").'" name="tue_start">End Time: <input type="time" value="'.(($r==2)?$offtime:"").'" name="tue_end"></td>';
                    echo "</tr>";
                    
                    }
                    if($_GET['repeat']==3)
                   { 
                    echo "<tr>";
                    echo '<td><label><input type="checkbox" id="cwed" name="cwed" value="3">  Wednesday</label></td>';
                    echo '<td id="wed">Start Time: <input type="time" value="'.(($r==3)?$starttime:"").'"  name="wed_start">End Time: <input type="time" value="'.(($r==3)?$offtime:"").'" name="wed_end"></td>';
                    echo "</tr>";
                    }

            if($_GET['repeat']==4)
                   { 
                   echo "<tr>";
                    echo '<td><label><input type="checkbox" id="cthu" name="cthu" value="4">  Thursday</label></td>';
                    echo '<td id="thu">Start Time: <input type="time" value="'.(($r==4)?$starttime:"").'" name="thu_start">End Time: <input type="time" value="'.(($r==4)?$offtime:"").'" name="thu_end"></td>';
                    echo "</tr>";
                }

                  if($_GET['repeat']==5)
                   { 
                    
                    echo "<tr>";
                    echo '<td><label><input type="checkbox" id="cfri" name="cfri" value="5">  Friday</label></td>';
                    echo '<td id="fri">Start Time: <input type="time" value="'.(($r==5)?$starttime:"").'" name="fri_start">End Time: <input type="time" value="'.(($r==5)?$offtime:"").'" name="fri_end"></td>';
                    echo "</tr>";

                }
                    

                    if($_GET['repeat']==6)
                   { 

                    echo "<tr>";
                    echo '<td><label><input type="checkbox" id="csat" name="csat" value="6">  Saturday</label></td>';
                    echo '<td id="sat">Start Time: <input type="time" value="'.(($r==6)?$starttime:"").'" name="sat_start">End Time: <input type="time" value="'.(($r==6)?$offtime:"").'" name="sat_end"></td>';
                    echo "</tr>";
                    
                    }

                      if($_GET['repeat']==7)
                   { 
                   echo "<tr>";
                    echo '<td><label><input type="checkbox" id="csun" name="csun" value="7">  Sunday</label></td>';
                    echo '<td id="sun">Start Time: <input type="time" value="'.(($r==7)?$starttime:"").'" name="sun_start">End Time: <input type="time" value="'.(($r==7)?$offtime:"").'" name="sun_end"></td>';
                    echo "</tr>";

                    }

                    echo "<tr>";

                        echo "<td></td>";
                        echo "<td><input type = 'submit' value = 'Go' name = 'ok' class = 'btn btn-primary' /></td>";

                    echo "</tr>";



                    echo "</table>";

                    echo "</form>";     
                }

            $con->db->close();
        ?>
                


    </section>

    <!-- /.content -->
   
  </div>
  <!-- /.content-wrapper -->
  
  <?php include_once('footer.php') ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include_once('script.php') ?>
</body>
</html>

 <script>
    $(function () {
    $('#example1').DataTable(
    {"order": [[ 16, "desc" ]]})
    $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
    })
    });


        <script>
        document.querySelector("#today").valueAsDate = new Date();
    
        </script> 
        <script>
        $('#timeformat').timepicker({ 'timeFormat': 'H:i:s' });
    
        </script> 
   <script>
$(document).ready(function(){
   <?php
   $repeat = $_GET['repeat'];
   ?>
   var repeat= <?php echo $repeat;?>;
   if(repeat==0)
   {
   $('#daily').show();
   $('#cdaily').prop('checked', true);
   }
   else
    $('#daily').hide();

   if(repeat==1)
   {
   $('#mon').show();
   $('#cmon').prop('checked', true);
    }
   else
   $('#mon').hide();
    
    if(repeat==2)
    {
   $('#tue').show();
   $('#ctue').prop('checked', true);
    }
   else
    $('#tue').hide();


   if(repeat==3)
   {
   $('#wed').show();
   $('#cwed').prop('checked', true); 
   }
   else
    $('#wed').hide();

   if(repeat==4)
   {
   $('#thu').show();
   $('#cthu').prop('checked', true); 
   }
   else
    $('#thu').hide();

   if(repeat==5)
   {
    $('#cfri').prop('checked', true);
   $('#fri').show();
   }
   else
    $('#fri').hide();

  if(repeat==6)
  {
   $('#sat').show();
   $('#csat').prop('checked', true);
   }
   else
    $('#sat').hide();

  if(repeat==7)
  {
   $('#sun').show();
   $('#csun').prop('checked', true);
   }
   else
    $('#sun').hide();
  


    $(this).on('click', '#cdaily', function () {
     $('#daily').toggle();
  })

  $(this).on('click', '#cmon', function () {
     $('#mon').toggle();
  })

  $(this).on('click', '#ctue', function () {
     $('#tue').toggle();
  })

  $(this).on('click', '#cwed', function () {
     $('#wed').toggle();
  })

  $(this).on('click', '#cthu', function () {
     $('#thu').toggle();
  })

  $(this).on('click', '#cfri', function () {
     $('#fri').toggle();
  })

  $(this).on('click', '#csat', function () {
     $('#sat').toggle();
  })

  $(this).on('click', '#csun', function () {
     $('#sun').toggle();
  })


})

</script>


<?php

    include_once("DBConnection.php");

            date_default_timezone_set("Asia/Karachi");

            $con = new DBCon();

            $dt = date("Y-m-d");

                if($con->Open())
                {
                    if(isset($_POST['ok']))
                    {
                            $a_id=$_POST['a_id'];
                            $pump_id=$_POST['pump_id'];

                    
                      $datetime = date('d-m-y H:i:s');

                     if(isset($_POST['cdaily']))
                          {
                            $start_time=$_POST['daily_start'];
                            $off_time=$_POST['daily_end'];
                            $repeat = $_POST['cdaily'];
                            $q = "UPDATE auto_switching SET `starttime` = '$start_time'  , `offtime` = '$off_time',`actual_ontime` = '$start_time'  , `actual_offtime` = '$off_time'  , `repeat` = '$repeat' , `Datetime` = CURTIME()  WHERE id = '$a_id' ";
                           $result = $con->db->query($q);

                          }



                          if(isset($_POST['cmon']))
                          {
                            $start_time=$_POST['mon_start'];
                            $off_time=$_POST['mon_end'];
                            $repeat = $_POST['cmon'];
                       $q = "UPDATE auto_switching SET `starttime` = '$start_time'  , `offtime` = '$off_time',`actual_ontime` = '$start_time'  , `actual_offtime` = '$off_time' , `repeat` = '$repeat' , `Datetime` = CURTIME()  WHERE id = '$a_id' ";
                           $result = $con->db->query($q);

                          }

                        if(isset($_POST['ctue']))
                          {
                            $start_time=$_POST['tue_start'];
                            $off_time=$_POST['tue_end'];
                            $repeat = $_POST['ctue'];
                      $q = "UPDATE auto_switching SET `starttime` = '$start_time'  , `offtime` = '$off_time' ,`actual_ontime` = '$start_time'  , `actual_offtime` = '$off_time', `repeat` = '$repeat' , `Datetime` = CURTIME()  WHERE id = '$a_id' ";
                           $result = $con->db->query($q);

                          }


                     if(isset($_POST['cwed']))
                          {
                            $start_time=$_POST['wed_start'];
                            $off_time=$_POST['wed_end'];
                            $repeat = $_POST['cwed'];
                        $q = "UPDATE auto_switching SET `starttime` = '$start_time'  , `offtime` = '$off_time' ,`actual_ontime` = '$start_time'  , `actual_offtime` = '$off_time', `repeat` = '$repeat' , `Datetime` = CURTIME()  WHERE id = '$a_id' ";
                           $result = $con->db->query($q);

                          }

                            
                        if(isset($_POST['cthu']))
                          {
                            $start_time=$_POST['thu_start'];
                            $off_time=$_POST['thu_end'];
                            $repeat = $_POST['cthu'];
                        $q = "UPDATE auto_switching SET `starttime` = '$start_time'  , `offtime` = '$off_time' ,`actual_ontime` = '$start_time'  , `actual_offtime` = '$off_time' , `repeat` = '$repeat' , `Datetime` = CURTIME()  WHERE id = '$a_id' ";
                           $result = $con->db->query($q);

                          }

                        if(isset($_POST['cfri']))
                          {
                            $start_time=$_POST['fri_start'];
                            $off_time=$_POST['fri_end'];
                            $repeat = $_POST['cfri'];
             $q = "UPDATE auto_switching SET `starttime` = '$start_time'  , `offtime` = '$off_time' ,`actual_ontime` = '$start_time'  , `actual_offtime` = '$off_time', `repeat` = '$repeat' , `Datetime` = CURTIME()  WHERE id = '$a_id' ";
                           $result = $con->db->query($q);

                          }

                        if(isset($_POST['csat']))
                          {
                            $start_time=$_POST['sat_start'];
                            $off_time=$_POST['sat_end'];
                            $repeat = $_POST['csat'];
                     $q = "UPDATE auto_switching SET `starttime` = '$start_time'  , `offtime` = '$off_time' ,`actual_ontime` = '$start_time'  , `actual_offtime` = '$off_time', `repeat` = '$repeat' , `Datetime` = CURTIME()  WHERE id = '$a_id' ";
                           $result = $con->db->query($q);

                          }


                        if(isset($_POST['csun']))
                          {
                            $start_time=$_POST['sun_start'];
                            $off_time=$_POST['sun_end'];
                            $repeat = $_POST['csun'];
               $q = "UPDATE auto_switching SET `starttime` = '$start_time'  , `offtime` = '$off_time' ,`actual_ontime` = '$start_time'  , `actual_offtime` = '$off_time', `repeat` = '$repeat' , `Datetime` = CURTIME()  WHERE id = '$a_id' ";
                           $result = $con->db->query($q);

                          }




                                

                        echo "<script>window.open('auto_switching.php?filter=0G0' , '_self');</script>";
                                



                               
                    }
                }

            $con->db->close();
?>
                