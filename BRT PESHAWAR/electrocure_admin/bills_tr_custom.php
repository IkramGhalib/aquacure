<?php
  include_once('check.php');
  authenticate("bills");
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Transformers Bills Custom";?>



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
    <div  id="overflow" style="overflow-x:auto;">
        <table  id="example1" class="table table-responsive table-bordered table-striped">
        <thead class="bg-primary">
        <tr>     
          <th scope="col">Transformer ID</th>
          <th scope="col">Name</th>
          <th scope="col">From Date</th>
          <th scope="col">To Date</th>
          <th scope="col">Actions</th>
        </tr>
        </thead>
          
          
        <tbody bgcolor="#FFFFFF">
          
          <?php
          include("opendb.php"); 
          $query= "select tr_billing_postpaid.*, transformer.name from tr_billing_postpaid, transformer where bill_id in (select max(bill_id) from tr_billing_postpaid group by tr_billing_postpaid.trid) and tr_billing_postpaid.trid = transformer.trid order by tr_billing_postpaid.trid asc";
          // echo $query;
          $result = $conn -> query($query) or die("Query error");
          foreach ($result as $row) {
            # code...
          $bill_id = $row ['bill_id']; 
                  
          ?>
          
        <tr>
          
          <td><?php echo $row ['trid'];  ?></td>
          <td><?php echo $row ['name'];  ?></td>

          <form method='post' name="<?php echo $row['trid'];?>"  action="transformer_custom_bill_cal.php?id=<?php echo $row['trid'];?>" >
              <td><input type="date" class="form-control" min="<?php echo date("Y-m-01");?>" max="<?php echo date("Y-m-t");?>" required="required" name="start"></td>
              <td><input type="date" class="form-control" min="<?php echo date("Y-m-01");?>" max="<?php echo date("Y-m-t");?>" required="required" name="end"></td>
              <td><button type="submit" value="submit" class="btn btn-primary">Generate</button></td>
          </form>
 
        
          
        </tr>
          
          <?php
          }
        ?>
        
              </tbody>
              
        
        </table>
        </div>
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


      
</html>
