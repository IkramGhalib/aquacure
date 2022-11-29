<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>


<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Email IDs for Notifications"?>



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
    <?php 
      require_once("opendb.php");
      $id = 1;
      $query = "select * from noti_emails";
      $result = $conn -> query($query) or die(error);
      $email1 = "";
      $email2 = "";
      $email3 = "";

      foreach ($result as $row) {
        $email1 = $row['email1'];
        $email2 = $row['email2'];
        $email3 = $row['email3'];
      }
    ?>
    <!-- Main content -->
    <section class="content">
    <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email 1</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email1" value="<?php echo $email1; ?>" placeholder="Enter Email Preference No. 1" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email 2</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email2" value="<?php echo $email2; ?>" placeholder="Enter Email Preference No. 2" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email 3</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email3" value="<?php echo $email3; ?>" placeholder="Enter Email Preference No. 3" required="required">
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" name="submit" class="btn btn-primary pull-right">Update Emails</button>
              </div>
              <!-- /.box-footer -->
            </form>
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
    })
</script>

<?php
  require_once("opendb.php");
  if (isset($_POST['submit'])) {
    $email1 = $_POST['email1'];
    $email2 = $_POST['email2'];
    $email3 = $_POST['email3'];
    
    $query = "update noti_emails set email1 = '$email1', email2='$email2', email3='$email3' where id = $id";

    $stmt = $conn->prepare($query);
    $result = $stmt->execute();
    $rcount = $stmt->rowCount();

    if ($rcount>0) {
      echo "<script type='text/javascript'> alert('Emails updated successfully!'); </script>";
      echo "<script type='text/javascript'> window.location.href = 'email_list.php'; </script>";
    }else{
      echo "<script type='text/javascript'> alert('Sorry! There was error in adding Emails..!'); </script>"; 
    }

  }
?>