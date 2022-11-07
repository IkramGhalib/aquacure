<?php
  include_once('check.php');
  authenticate("bills");
?>
<!DOCTYPE html>
<html>
<head>


  <?php $pageName = "Transformer Bill Payment"?>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>

 <?php include_once('head.php') ?>

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue sidebar-mini"  >
<!-- Site wrapper -->
<div class="wrapper">


	<!-- Navbar -->
	<?php include_once('navbar.php') ?>
	<!-- Sidebar -->
	<?php //include_once('sidebar.php') ?>

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

<div class="panel panel-primary" align="center" style="max-width: 700px">
		<div class="panel-heading"> Bill Payment</div>
		<div class="panel-body">

<?php
require_once("opendb.php");
	$id = $_GET['id'];
	$bill = 0;
	$query = "select * from tr_billing_postpaid where bill_id = '$id'";
	$result = $conn->query($query) or die(error);

	foreach ($result as $row) {
			$trid = $row['trid'];
			$bill = $row['total_bill'];
		?>

	<form method = "POST">

<form method = "POST">
        <div class = "form-group row">
			<label class="col-sm-2 col-form-label">Bill ID</label>
			<div class="col-sm-6">                                        
					<input type="text" class="form-control" value="<?php echo $row['bill_id']; ?>" name = "bill_id" disabled />                                  
			</div>
		</div>

		<div class = "form-group row">
			<label class="col-sm-2 col-form-label">Reference No.</label>
			<div class="col-sm-6">                                        
					<input type="text" class="form-control" value="<?php echo $row['trid']; ?>" disabled />                                  
			</div>
		</div>

		

		<div class = "form-group row">
				<label class="col-sm-2 col-form-label">Total Bill (PKR)</label>
				<div class="col-sm-6">                                        
						<input type="text" value="<?php echo $row['total_bill']; ?>" disabled class="form-control" name = "amount" placeholder = "Enter Amount Collected" required = "required" />                                  
				</div>
		</div>

		<div class = "form-group row">
				<label class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-6">                                        
						<input type="password" class="form-control" name = "password" placeholder = "Enter Your password" required = "required" />                                  
				</div>
		</div>

				
		<span style="display: inline;"  >                                      
			<input type="submit" class="btn btn-primary" name = "add" value = "Pay Bill" />
		</span>								
									
							
							
										
									</div>  
									</form>	                                 
							</div>
					<?php } ?>
	
	</div>
</div>
</div>
</div>


<script src="bower_components/jquery/dist/jquery.min.js"></script>

	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<script>
	$.widget.bridge('uibutton', $.ui.button);
	</script>

	<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

	<script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>


	<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

	<script src="bower_components/fastclick/lib/fastclick.js"></script>

	<script src="dist/js/app.min.js" type="text/javascript"></script>

	<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
	<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>



</body>
</html>

<?php
	$attempt = 0; 
	if(isset($_POST['add'])){
		$amount = 0;
	$amount = $_POST['amount'];
	$password = $_POST['password'];

	if ($_SESSION['employee']['password'] == $password) {
		$employee = $_SESSION['employee']['userid'];
		$q = "update tr_billing_postpaid set status = 1, paid_amount = $bill, collected_by = '".$employee."', paid_on = CURTIME() where bill_id = $id";
		echo $q;
		

		$stmt = $conn->prepare($q);
		try{
		$result = $stmt->execute();
		$count = $stmt->rowCount();
		if ($stmt -> rowCount() > 0) {
			echo "<script>window.location.href = 'ebill_tr.php?id=$trid'</script>";
		}
		
		}
		catch(PDOException $e){
		echo "<script> alert('There was an error paying bill :".str_replace("'", "\'", $q)."'); </script>";
		}
	}else{
	
		echo "<script> alert('Incorrect Password. Bill posting failed.'); </script>";


	}

	

	}
	//$conn= NULL;
	?>


