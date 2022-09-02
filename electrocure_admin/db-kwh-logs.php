<?php
  include_once('check.php');
  authenticate("can_view");
?>

<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Distribution Box Consumption Logs"?>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>
  
 <?php include_once('head.php') ?> 
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
  var ifdid = "";
  var ofdid = "";
  var trid = "";
  var dbid = "";
    $(document).ready(function(){
      $("#infeeder").change(function(){
        ifdid = $("#infeeder").val();
        $.ajax({
          url: 'data.php',
          method: 'post',
          data: 'ifdid=' + ifdid
        }).done(function(outfeeders){
          console.log(outfeeders);
          outfeeders = JSON.parse(outfeeders);
          $('#outfeeder').empty();
          $('#outfeeder').append('<option>---SELECT OUT FEEDER---</option>');
           outfeeders.forEach(function(outfeeder){
            $('#outfeeder').append('<option value = '+outfeeder.id+'> '+ outfeeder.name +' </option>')
           })
        })
      })
    });

    $(document).ready(function(){
      $("#outfeeder").change(function(){
        ofdid = $("#outfeeder").val();
        $.ajax({
          url: 'data2.php',
          method: 'post',
          data: 'ofdid=' + ofdid
        }).done(function(transformers){
          console.log(transformers);
          transformers = JSON.parse(transformers);
          $('#transformer').empty();
          $('#transformer').append('<option>---SELECT TRANSFORMER---</option>');
           transformers.forEach(function(transformer){
            $('#transformer').append('<option value = '+ transformer.id +'> '+ transformer.id +' </option>')
           })
        })
      })
    });

    $(document).ready(function(){
      $("#transformer").change(function(){
        trid = $("#transformer").val();
        $.ajax({
          url: 'data3.php',
          method: 'post',
          data: 'trid=' + trid
        }).done(function(dbs){
          console.log(dbs);
          dbs = JSON.parse(dbs);
          $('#db').empty();
          $('#db').append('<option>---SELECT DISTRIBUTION BOX---</option>');
           dbs.forEach(function(db){
            $('#db').append('<option value = db-kwh-logs.php?filter='+ db.id +'> '+ db.name +' </option>')
           })
        })
      })
    });

  </script>


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
            
        <li class="header">Select Specific Distribution Boxes</li>
        <br>
          <?php
          require_once("opendb.php");
          $query = "select fdid, name from feeder";
          $result = $conn -> query($query) or die("Query error");
          ?>
          <select id="infeeder" name="infeeder" class="form-control">
            <option selected="" disabled="">---SELECT IN-FEEDER---</option>
            <?php
            foreach ($result as $row) {
              if($filter != "0G0" && $row['fdid'] == substr(string, start))
              ?>
              <option value="<?php echo $row['fdid']; ?>"><?php echo $row['name']; ?></option>
              <?php
            }
            ?>
          </select>
          <br>
          <br>
          <select id="outfeeder" name="outfeeder" class="form-control">
            <option selected="" disabled="">---SELECT OUT-FEEDER---</option>
          </select>
          <br>
          <br>
          <select id="transformer" name="transformer" class="form-control">
            <option selected="" disabled="">---SELECT TRANSFORMER---</option>
          </select>
          <br>
          <br>

          <select id="db" name="db" class="form-control" onchange="location = this.value">
            <option selected="" disabled="">---SELECT DISTRIBUTION BOX---</option>
          </select>
          <br>
          <br>


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
       
       <?php
        require_once("opendb.php"); 
        $filter = $_GET['filter'];
        if ($filter == '0G0')
        $query= "select * from db_kwh_logs WHERE db_kwh_logs.Datetime > DATE_SUB(CURDATE(), INTERVAL 1 DAY) ORDER BY db_kwh_logs.Datetime DESC";
                else
                $query= "select * from db_kwh_logs WHERE db_kwh_logs.trid = '".$filter."'db_kwh_logs.Datetime > DATE_SUB(CURDATE(), INTERVAL 1 DAY) ORDER BY db_kwh_logs.Datetime DESC";
        $result = $conn -> query($query) or die("Query error");
      ?>
      
    <div  id="overflow" style="overflow-x:auto;">
        <table  id="example1" class="table table-responsive table-bordered table-striped" >
        <thead class="bg-blue">
        <tr>
          <th scope="col">Distribution Box ID</th>
          <th scope="col">Off Peak</th>
          <th scope="col">Peak</th>
          <th scope="col">pkunits</th>
          <th scope="col">Date & Time</th>
          
        </tr>
        </thead>
          
          
        <tbody bgcolor="#FFFFFF">
          
          <?php
          foreach($result as $row){
          ?>
          
          
        <tr>
            <td><?php echo $row ['trid'];  ?></td>
          <td><?php echo $row ['offpeak'];  ?></td>
          <td><?php echo $row ['peak'];  ?></td>
          <td><?php echo $row ['pkunits'];  ?></td>
          <td><?php echo $row ['Datetime'];  ?></td>
        </tr>
          
          <?php
          }
        ?>
        
          
        </tbody>
        <tfoot class="bg-blue">
        <tr>
          <th scope="col">Distribution Box ID</th>
          <th scope="col">Off Peak</th>
          <th scope="col">Peak</th>
          <th scope="col">pkunits</th>
          <th scope="col">Date & Time</th>
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
    $('#example1').DataTable(
    {"order": [[ 3, "desc" ]]})
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
