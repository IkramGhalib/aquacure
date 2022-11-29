<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Reports Contact Management"?>



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

      <?php
include ('opendb.php');
    if(isset($_POST['submit'])){
    $name =$_POST["name"];
    $email =$_POST["email"];
    $designation =$_POST["designation"];
    $phone =$_POST["phone"];
   
    $sql ="";
    $sql="INSERT INTO `alert_contacts`(`name`, `designation`, `email`, `phone`) VALUES ('$name','$designation','$email','$phone')";
    
      echo " <script>window.location.href='alert_contact.php'</script>";
    $result = $conn -> query($sql) or die ("query error");
    echo "<p>the data is inserted sucssfully</p>";
    $conn=NULL;
  }
$sql = "SELECT *FROM alert_contacts ";
$result=$conn -> query($sql) or die ("query error");
?>
  <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-addemployee">Add New Contact</button> <br><br> 

                    <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Alert contacts Master</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">

                                    <thead >
                                        <tr >
                                        
                                            <th width="5%">ID</th>
                                            <th width="20%">Name</th>
                                            <th width="15%">Email</th>
                                            <th width="10%">Designation</th>
                                            <th width="15%">Phone</th>
                                            <th width="10%">DateTime</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                       
                                        $statment = "";
                                        while($row= $result->fetch())
                                        {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id']?>
                                            </td>
                                            <td><?php echo $row['name']?></td>
                                            <td><?php echo $row['email']?></td>
                                            <td><?php echo $row['designation']?></td>
                                            <td><?php echo $row['phone']?></td>
                                            
                                            <td><?php echo $row['datetime']?></td>
                                            <td>
                                                <button class="btn btn-danger "
                                                    onclick="window.location.href='delete.php?id=<?php echo $row['id'];?>&type=delete'">
                                                    Delete</button>
                                            </td>
                                        </tr>
                                        <!--  -->
                                        <?php
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-----col---->
                </div>
                <!-- /.row -->
            </section>
            <form method="POST">
                <?php  
       $query = "select *from alert_contacts";
       $contacts = $conn->query($query);

  ?>
                <div class="modal modal-primary fade" id="modal-addemployee">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Add New Contacts!</h4>
                            </div>
                            <div class="modal-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="name">Enter Name:</label>
                                        <input type="text" name="name" placeholder="Enter Name"
                                            class="form-control " required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Enter Designation:</label>
                                        <input type="text" name="designation" placeholder="Enter Designation"
                                            class="form-control " required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Enter Email</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Enter Email Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Enter Mobile Number </label>
                                        <input type="text" class="form-control" name="phone"
                                            placeholder="Enter Mobile Number">
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="submit" class="btn btn-success" value="submit" name="submit">
                            </div>
                        </div>
                    </div> <!-- /.modal-dialog -->
                </div>
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