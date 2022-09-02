<?php
  include_once('check.php');
  authenticate("can_view");
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Tariff";?>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>
  
 <?php include_once('head.php');
 
 if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
 }else{
  $filter = "0G0";
 }
 
 ?> 
 
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
<!-- Left side column. contains the logo and sidebar -->
  <!-- =============================================== -->

<aside class="main-sidebar" style="margin-top: <?php echo $sidebarmargin;?>px;">
        <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="overflow-x: scroll;">
          <!-- sidebar menu: : style can be found in sidebar.less -->
         
      <ul class="sidebar-menu">
            <form id="sidebarform" method="post">
        <li class="header">Select Specific Transformer</li>
   

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
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
     



 <!-- DO NOT REMOVE THIS TABLE TAG -->
      <table width="100%" border="0"></table>
    <div  id="overflow" >
        <table  id="example1" class="table table-responsive table-bordered table-striped">
        <thead class="bg-blue">
        <tr>     
          <th scope="col">Tariff ID</th>
          <th scope="col">Prepaid Unit</th>
          <th scope="col">Postpaid Unit</th>
          <th scope="col">GST %</th>
          <th scope="col">Surcharge %</th>

          <th scope="col">Implemeted on</th>
        </tr>
        </thead>
          
          
        <tbody bgcolor="#FFFFFF">
          
          <?php
          include("opendb.php");
         
          $query= "select * from tariff order by datetime desc limit 1";
          $result = $conn -> query($query) or die("Query error");
          foreach ($result as $row) {
          ?>
          
        <tr>    
          <td><?php echo $row ['tid'];  ?></td>
          <td><?php echo $row ['prepaid_unit'];  ?></td>
          <td><?php echo $row ['postpaid_unit'];  ?></td>
          <td><?php echo $row ['gst'];  ?></td>
          <td><?php echo $row ['surcharge'];  ?></td>
          <td><?php echo $row ['datetime'];  ?></td>

 
        
          
        </tr>
          
          <?php
          }
        ?>
              </tbody>
        
          
        </table>
        </div>

         <button type="button" class="btn btn-primary" onclick="window.location.href = 'change_tariff.php'">Change Tariff</button><br><br>
      </section>
        
      
  <?php $conn= NULL; ?>
  
    
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

   <script>
    $(function () {
    $('#example1').DataTable(
        {'order': [[ 0, "asc" ]]})
    $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
    })
    })
</script>

      
</html>
