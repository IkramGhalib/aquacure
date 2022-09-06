<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Daily Attendance"?>



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
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $pageName;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<form action="" method="POST">
    <button class="btn btn-primary" name="click" class="click">Daily Attendance</button>
    <br>
    <br>
</form>

      <div id="overflow" style="overflow-x:auto;">
      <table id="example1" class="table table-responsive table-bordered table-striped">
      <thead class="bg-blue">
              <tr>
              <th>Camera No #.</th>
              <th>Name</th>
                <th>Mood</th>
                
                <th>Date Time</th>

              </tr>
            </thead>
            <tbody>
            <?php
                require_once("opendb.php");
                // if(isset($_POST['click']))
                // {
                    $date_clicked = date('Y-m-d');
                    // $date_clicked=substring_index(now(), ' ',1 );
                    // substring_index(now(), " ",1 );
                    echo $date_clicked;
                    // $q="SELECT person.person_name,raw_data.* from raw_data,person where date_time='$date_clicked'";
                    // $q="SELECT person.person_name,raw_data.* from raw_data,person where DATE(date_time) = date('Y-m-d')";
                    // $q="SELECT raw_data.* FROM raw_data where DATE(date_time) = '$date_clicked'";
                    // echo $q;
                    $q="SELECT raw_data.*, person.* from raw_data, person WHERE person.pid = raw_data.pid and substring_index(date_time, ' ', 1) =substring_index(now(), ' ',1 )";
                    $result = $conn -> query($q) or die(error);

                    foreach ($result as $row) {
                        
                    // $pid=$row['pid'];
                    // echo $pid;
                    ?>
                    
                    <tr class="odd gradeX ">
                  <td><?php echo $row['mid']; ?> </td>
                  <td><?php echo $row['person_name']; ?> </td>

                  <td><?php echo $row['mood']; ?> </td>
                 
                  
                  <td><?php echo $row['date_time']; ?> </td>
                </tr>
               
             
                <?php
  }
  ?>
                
               
                <tfoot class="bg-blue">
              <tr>
                <th>Camera No #.</th>
                <th>Name</th>
                <th>Mood</th>
                
                <th>Date Time</th>

              </tr>

            </tfoot>
    </table>
   
    </div>
   
    
    <!-- echo "Time the button was clicked: " . $date_clicked . "<br>"; -->
    
    </section>

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
