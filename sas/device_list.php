<?php session_start();
if (!isset($_SESSION['userid'])) {
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>


  <?php $pageName = "Devices List" ?>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName; ?></title>

  <?php include_once('head.php') ?>

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->

<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper" style="overflow: hidden;">


    <!-- Navbar -->
    <?php include_once('navbar.php') ?>
    <!-- Sidebar -->
    <?php include_once('sidebar.php') ?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper" style="margin-top: <?php echo $contentmargin ?>px">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <b><?php echo $pageName; ?></b>

        </h1>
        <ol class="breadcrumb">
          <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?php echo $pageName; ?></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content"> <button id="add-new-button" class="btn btn-primary" onClick="window.location.href='add_new_device.php'"><b>+ Add Device</b></button>
        <br>
        <br>
        <div id="overflow" style="overflow-x:auto;">
          <table id="example1" class="table table-responsive table-bordered table-striped">
            <thead class="bg-blue">
              <tr>
                <th>Device ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Date & Time</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>
              <?php
              require_once("opendb.php");
              // $id = "1710177817915";
              $query = "select * from device order by device_id";
              $result = $conn->query($query) or die("Query error");

              foreach ($result as $row) {
              ?>
                <tr>
                  <td><?php echo $row['device_id']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['description']; ?></td>
                  <td><?php echo $row['longitude']; ?></td>
                  <td><?php echo $row['latitude']; ?></td>
                  <td><?php echo $row['datentime']; ?></td>
                  <td>
                    <button class="btn btn-primary" onClick="window.location.href='edit_device.php?id=<?php echo $row['device_id'];  ?>'">Edit</button>
                    <button class="btn btn-danger" onClick="window.location.href='delete_device.php?id=<?php echo $row['device_id'];  ?>'">Delete</button>
                  </td>

                </tr>

              <?php
              }
              ?>
            </tbody>
            <tfoot class="bg-blue">
              <tr>

                <th>Device ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Date & Time</th>
                <th>Action</th>
              </tr>

            </tfoot>
          </table>



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
  $(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })
  })
</script>