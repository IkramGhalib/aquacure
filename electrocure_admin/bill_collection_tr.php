<?php
  include_once('check.php');
  authenticate("can_view");
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "TRANSFORMER BILL COLLECTION" ?>



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
	<aside class="main-sidebar" style="margin-top: <?php echo $sidebarmargin;?>px;">
        <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="overflow-x: scroll;">
          <!-- sidebar menu: : style can be found in sidebar.less -->
         
      <ul class="sidebar-menu">
            
        <li class="header">Bill Collection Detail</li>
         <br>
       

        
           <form id="sidebarform" method="post">

             
          <datalist id="dbs">
          
            
          </datalist>

          <br>
          
          <div style="color: #FFFFFF"><b>Select Date:</b></div>
          <input type="date" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d"); ?>"  id="txtdate" name="txtdate" class="form-control" placeholder="Logs From">
          

          
         
          <button style="float: right; margin-right:5px; " class="btn-primary btn" name="btnsubmit"> submit </button>

        </form>
     
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

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
   
    



<br>
 <div id="overflow">
        <table id="example1"  class="table table-responsive table-bordered table-striped">
              <thead class="bg-blue">
                <tr>

                 
   <th scope="col"> Bill Id</th>

    <th scope="col"> Amount Collected</th>
    <th scope="col">Collected on</th>
    <th scope="col">Collected By</th>
    
             
    </tr>
        </thead>
   <?php  
    include("opendb.php");
   
      //echo "Today";
    if(isset($_POST['btnsubmit'])){
      // $query="SELECT sum(paid_amount) as paid_amount, sum(total_bill),collected_by from billing_postpaid WHERE status=1 GROUP BY collected_by";
      $dateslot=$_POST['txtdate'];
      //echo $dateslot;
      // $query="SELECT * FROM billing_postpaid WHERE YEAR(paid_on) = YEAR(NOW()) AND MONTH(paid_on) = MONTH(NOW()) AND DAY(paid_on) = DAY($dateslot)";

      $query="select bill_id,paid_amount,paid_on,collected_by,DATE_FORMAT(paid_on, '%Y-%m-%d') from tr_billing_postpaid
    where date(paid_on) = '".$dateslot."' AND status=1";

      $result=$conn->query($query);
      //print_r($result);
      
        ?>

        
           
        <?php foreach ($result as $row) {
          
        ?>
     <tr>
      <td> <?php echo $row['bill_id'];  ?></td>
    <td>Rs. <?php echo $row['paid_amount'];  ?></td>
      <td><?php echo date( 'M d Y g:i A ', strtotime($row['paid_on'])); ?></td>
    <td><?php echo $row ['collected_by'];  ?></td>

   <!--  <td> <button class="btn btn-primary" onClick="window.location.href='bill_collection_detail.php?collected_by=<?php //echo $row ['collected_by'];  ?>'">View Details</button></td> -->
   
         
    </tr>
<?php  } 
}
?>


        

   

    



</table>
      </div>



      
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



<script>
    $(function () {
    $('#example1').DataTable()
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
