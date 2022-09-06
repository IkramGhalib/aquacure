<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Write Name Here!"?>



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
      <div class="container">
        <div class="row">
        <div class="col-sm-12">
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
<thead>
<tr>
    <th rowspan="1" colspan="1">Product Name</th>
<th rowspan="1" colspan="1">Category</th>
<th rowspan="1" colspan="1">sub category(s)</th>
<th rowspan="1" colspan="1">Price</th>
<th rowspan="1" colspan="1">Image</th></tr></thead>
<tbody>
<?php
    include("includes/DBconnection.php");
    $sql="Select * from product ORDER BY prod_id desc";
    $res=mysqli_query($conn,$sql);
    // for($i=1;$i<=$res;$i++);
    // echo $
    foreach($res as $row){
    //     // $cat_sel=$row['categories'];
    //     // echo $cat_sel;
    
    ?>
    <tr>
    <td><?php echo $row['product_name']?></td>
        <td><?php echo $row['category']?></td>
        <td><?php echo $row['sub_category']?></td>
        <td><?php echo $row['price']?></td>
        <td><img width="100" height="50" class="img-responsive" src="uploads/<?php echo $row['image']?>"></td>
        <!-- <td><button onClick="window.location.href='edit.php?id=<?php echo $row['cat_id']?>'">Edit</button></td>
        <td><button onClick="window.location.href='delete.php?id=<?php echo $row['cat_id']?>'">Delete</button></td>
        <td><button onClick="window.location.href='disable.php?id=<?php echo $row['cat_id']?>'">Disable</button></td> -->
        <!-- <td><?php echo $row['status']==1?'<button onClick="window.location.href="disable.php?id=<?php echo $row["cat_id"]?>Disable</button>':'Enable'?></td> -->
    </tr>
    <?php
    }
    ?>
<tr role="row" class="odd">
</tbody>
<tfoot>
<tr>
    <th rowspan="1" colspan="1">Product Name</th>
<th rowspan="1" colspan="1">Category</th>
<th rowspan="1" colspan="1">sub category(s)</th>
<th rowspan="1" colspan="1">Price</th>
<th rowspan="1" colspan="1">Image</th></tr>
</tfoot>
</table></div>
    
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
