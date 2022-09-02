<?php
  include_once('check.php');
  authenticate("bills");
?>
<!DOCTYPE html>
<html>
<head>


  <?php $pageName = "Recharge Logs"?>



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

      <?php
            
        require_once("opendb.php");
            $filter = $_GET['filter'];


      //if($page_type == "Feeder"){

      //}

      if ($filter =='0G0')
            {
               echo " <li class=' treeview'>
                <a href='#'>
                  <i class='fa fa-dashboard'></i> <span> Connections </span>
                </a>";

                $query = "select cid, name from connections order by cid";
                $result = $conn -> query($query) or die("Query error");
               echo   "<ul class='treeview'>";

        foreach($result as $row){
         if($filter == $row['cid'])
            {
       ?>
              
      <li class= 'treeview'>
                <a href="connection-list.php?filter=0G0">
                  <i class="fa fa-square"></i> <span><?php echo($row['name'])?> <u>clear</u></span> 
                </a>
        </li>



    <?php
            }
            else
            {
                ?>
              
      <li class= 'treeview'>
                <a href="connection-list.php?filter=<?php echo $row['cid']?>">
                  <i class="fa fa-square"></i> <span><?php echo($row['name'])?></span> 
                </a>
        </li>



    <?php
            }
      }
                echo "</ul>";
                echo "</li>";
                
               
            }
        
    ?>        
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
    <?php
      if($_SESSION['employee']['can_edit'] == 1){
      ?>
      
        <button id="add-new-button" class="btn btn-primary" onClick="window.location.href='add-new-connections.php'"><b>+ Add New Connection</b></button>
        <br>
<br>
      <?php                        
      }
    ?>

    <div id="overflow">
    <table id="example1"  class="table table-responsive table-bordered table-striped">
    <thead class="bg-blue">
    <tr>
    <th scope="col">Transaction ID</th>
    <th scope="col">Connection ID</th>
    <th scope="col">Name</th>
    <th scope="col">Recharge Amount (PKR)</th>
    <th scope="col">Units (KWh)</th>
    <th scope="col">Tariff (PKR/KWh) (Incl. of GST)</th>
    <th scope="col">Date & Time</th>
   
    </tr>
    </thead>
    <tbody>

    <?php
    //  require_once("db/opendb.php");
    $query= "select prepaid_recharge.*, connections.name from prepaid_recharge, connections where connections.cid = prepaid_recharge.cid order by rid desc ";
    $result = $conn -> query($query) or die("Query error");
    foreach($result as $row){
    ?>

    <tr>
    <td><?php echo $row ['rid'];  ?></td>
    <td><?php echo $row ['cid'];  ?></td>
    <td><?php echo $row ['name'];  ?></td>
    <td><?php echo $row ['amount'];  ?></td>
    <td><?php echo $row ['units'];  ?></td>
    <td><?php echo $row ['tariff'];  ?></td>
    <td><?php echo $row ['datetime'];  ?></td>
    
    
    
    </tr>

    <?php } ?>

    </tbody>
  
    </table>
  </div>

  <?php $conn= NULL; ?>

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
