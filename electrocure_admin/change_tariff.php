<?php
  include_once('check.php');
  authenticate("bills");
?>
<!DOCTYPE html>
<html>
<head>


  <?php $pageName = "Change Tariff"?>



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
		<div class="panel-heading"> Change Tariff </div>
		<div class="panel-body">



	<form method = "POST">

<form method = "POST">
        <div class = "form-group row">
			<label class="col-sm-2 col-form-label">Prepaid</label>
			<div class="col-sm-6">                                        
					<input type="text" class="form-control" name = "prepaid" placeholder = "Price of prepaid unit" required = "required" />                                  
			</div>
		</div>

		<div class = "form-group row">
				<label class="col-sm-2 col-form-label">Postpaid</label>
				<div class="col-sm-6">                                        
						<input type="text" class="form-control" name = "postpaid" placeholder = "Price of postpaid unit" required = "required" />                                  
				</div>
		</div>


			 <div class = "form-group row">
			<label class="col-sm-2 col-form-label">Gst</label>
			<div class="col-sm-6">                                        
					<input type="text" class="form-control" name = "gst" placeholder = "GST" required = "required" />                                  
			</div>
		</div>

		<div class = "form-group row">
			<label class="col-sm-2 col-form-label">Surcharge</label>
			<div class="col-sm-6">                                        
					<input type="text" class="form-control" name = "surcharge" placeholder = "surcharge" required = "required" />                                  
			</div>
		</div>
				
		<span style="display: inline;"  >                                      
			<input type="submit" class="btn btn-primary" name = "add" value = "Add New Tariff" />
		</span>								
									
								
										
									</div>                                   
							</div>
							
					</form>
	
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
					
	<script>
	document.querySelector("#today").valueAsDate = new Date();

	</script> 
	<script>
	$('#timeformat').timepicker({ 'timeFormat': 'H:i:s' });

</script> 

</body>
</html>

<?php
	require_once("opendb.php");
	if(isset($_POST['add'])){
	$prepaid = $_POST['prepaid'];
	$postpaid = $_POST['postpaid'];
	$gst=$_POST['gst'];
	$surcharge=$_POST['surcharge'];

	$q = "insert into tariff (prepaid_unit,postpaid_unit,gst,surcharge) values('$prepaid','$postpaid','$gst','$surcharge')";
	echo $q;
	$stmt = $conn->prepare($q);
	try{
	$result = $stmt->execute();
	$count = $stmt->rowCount();
	echo "<script>window.location.href = 'tariff.php'</script>";
	}
	catch(PDOException $e){
	echo "<script> alert('There was an error adding new tariff :".str_replace("'", "\'", $q1)."'); </script>";
	}

	}
	$conn= NULL;
	?>


