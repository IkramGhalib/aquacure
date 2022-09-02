<?php
  include_once('check.php');
  authenticate("can_view");
?>
<!DOCTYPE html>
<html>
<head>


  <?php $pageName = "Distribution Box List"?>



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
            $subdivid = "mes05c1";
            $dbtype = "electrocure";
        require_once("opendb.php");
            $filter = $_GET['filter'];


      //if($page_type == "Feeder"){

      //}

      if ($filter =='0G0')
            {
               echo " <li class=' treeview'>
                <a href='#'>
                  <i class='fa fa-dashboard'></i> <span>Out Feeders</span>
                </a>";

                $query = "select dbid, name from db order by dbid";
                $result = $conn -> query($query) or die("Query error");
               echo   "<ul class='treeview'>";

        foreach($result as $row){
         if($filter == $row['dbid'])
            {
       ?>
              
      <li class= 'treeview'>
                <a href="db-list.php?filter=0G0">
                  <i class="fa fa-square"></i> <span><?php echo($row['name'])?> <u>clear</u></span> 
                </a>
        </li>



    <?php
            }
            else
            {
                ?>
              
      <li class= 'treeview'>
                <a href="db-list.php?filter=<?php echo $row['dbid']?>">
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
          <button id="add-new-button" class="btn btn-primary" onClick="window.location.href='add-new-db.php'"><b>+ Add New DB</b></button>
          <br>
          <br>
        <?php                        
        }
      ?>

    <div id="overflow" style="overflow-x:auto;">
    <table id="example1"  class="table table-responsive table-bordered table-striped">
    <thead class="bg-blue">
    <tr>
    <th scope="col">DB Id</th>
    <th scope="col">DB Name</th>
    <th scope="col">Description</th>
    <th scope="col">Connection Date</th>
    <?php
      if($_SESSION['employee']['can_edit'] == 1){
      ?>
        <th scope="col">Actions</th>
      <?php                        
      }
    ?>
    </tr>
    </thead>
    <tbody>

    <?php
  //  require_once("db/opendb.php");
        if($filter == '0G0')
    $query= "select * from db order by dbid ";

        else
        $query = "select * from db where dbid='".$filter."'";
        //echo $query;
    $result = $conn -> query($query) or die("Query error");
    foreach($result as $row){
    ?>

    <tr>
    <td><?php echo $row ['dbid'];  ?></td>
    <td><?php echo $row ['name'];  ?></td>
    <td><?php echo $row ['description'];  ?></td>
    <td><?php echo $row ['connectiondate'];  ?></td>
    <?php
      if($_SESSION['employee']['can_edit'] == 1){
      ?>
      <td>
        <button class="btn btn-primary" onClick="window.location.href='edit-db.php?id=<?php echo $row ['dbid'];  ?>'">Edit</button>
        <button class="btn btn-primary" onClick="window.location.href='delete-db.php?id=<?php echo $row ['dbid'];  ?>'">Delete</button>
      </td>
      <?php                        
      }
    ?>
    
    </tr>

    <?php } ?>

    </tbody>
    <tfoot class="bg-blue">
      <tr>
    <th scope="col">DB Id</th>
    <th scope="col">DB Name</th>
    <th scope="col">Description</th>
    <th scope="col">Connection Date</th>
    <?php
      if($_SESSION['employee']['can_edit'] == 1){
      ?>
        <th scope="col">Actions</th>
      <?php                        
      }
    ?>
    </tr>
    </tfoot>
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
