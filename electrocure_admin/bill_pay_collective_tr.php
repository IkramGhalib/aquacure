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
    <div class="content">
    	<?php
    		require_once("opendb.php");
    		$id = $_GET['id'];
    		$query = "select bill_id, total_bill from tr_billing_postpaid, transformer where transformer.cnic = '".$id."' and tr_billing_postpaid.status = 0 and transformer.trid = tr_billing_postpaid.trid and bill_id in (select max(bill_id) from tr_billing_postpaid group by tr_billing_postpaid.trid)";
    		
    		$result = $conn -> query($query) or die(error);

    		$update = "UPDATE tr_billing_postpaid set paid_amount = total_bill, paid_on = CURDATE(), collected_by = 'ADMIN', status = 1 where ";
    		foreach ($result as $row) {
				$bill_id = $row['bill_id'];
				$total_bill = $row['total_bill'];
				$update .= "bill_id = '$bill_id' or ";
       		}
       		
       		$update = substr($update, 0, -3);       		

    		$stmt = $conn -> prepare($update);
    		try{
				 $result2 = $stmt->execute();
				 $count = $stmt->rowCount();
				if ($stmt -> rowCount() > 0) {
					echo "<h2><b>Collective Bills Paid Successfully for: ".$id." </b></h2>";
				}else{
					echo "<h2><b>Collective Bill Payment Unsuccessful for: ".$id." </b></h2>";
				}
				
			}
			catch(PDOException $e){
			echo "Error Encountered:".$e."<br>Query: ".$update;

			}  		
    	?>
    	<button class="btn btn-primary" onclick="window.location.href='bills_collective_tr.php'">GO BACK</button>
    	
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
	
	if(isset($_POST['add'])){
	$amount = $_POST['amount'];

	$q = "update tr_billing_postpaid set status = 1, paid_amount = '$amount', collected_by = 'Admin', paid_on = CURTIME() where bill_id = $id";
	echo $q;
	

	$stmt = $conn->prepare($q);
	try{
	$result = $stmt->execute();
	$count = $stmt->rowCount();
	if ($stmt -> rowCount() > 0) {
		
		echo "<script>window.location.href = 'bill_slip.php?id=$trid'</script>";
	}
	
	}
	catch(PDOException $e){
	echo "<script> alert('There was an error paying bill :".str_replace("'", "\'", $q)."'); </script>";
	}

	}
	//$conn= NULL;
	?>


