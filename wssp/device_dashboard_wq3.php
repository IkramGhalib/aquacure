<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  

  <?php
  // if (isset($_GET['id'])) {
  //   $id = $_GET['id'];

  // }
  $pageName = " Detailed Satistics"?>



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
  <?php  include_once('sidebar.php') ?>

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
      <div class="row">
        <div class="col col-sm-12 col-lg-4"> 
          <div class="row">
        <div class="col-lg-12 col-xs-6" onclick="clickedFunction('Temprature');">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo "8.3" ?></h3>

              <p><b>Temperature (<sup>o</sup>C)</b></p>
            </div>
            

          </div>
        </div>

        <div class="col-lg-12 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo "25" ?></h3>

              <p><b>Turbidity (NTU)</b></p>
            </div>
            

          </div>
        </div>

        <div class="col-lg-12 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo "2" ?></h3>

              <p><b>TDS (mg/L)</b></p>
            </div>
            

          </div>
        </div>
        <div class="col-lg-12 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo "1" ?></h3>

              <p><b>TSS (mg/L)</b></p>
            </div>
            

          </div>
        </div>

        <div class="col-lg-12 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo "7.7" ?></h3>

              <p><b>pH</b></p>
            </div>
            

          </div>
        </div>

        <div class="col-lg-12 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo "0.01" ?></h3>

              <p><b>Resistivity (ohm.cm)</b></p>
            </div>
            

          </div>
        </div>

        <div class="col-lg-12 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo "44" ?></h3>

              <p><b>Disolved Oxygen (mg/L)</b></p>
            </div>
            

          </div>
        </div>

        <div class="col-lg-12 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo "4.6" ?></h3>

              <p><b>Electrical Conductivity (us/cm)</b></p>
            </div>
            

          </div>
        </div>
</div>

        
        </div>


        </div>     
      <div class="row" style="margin: 3px;">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Temperature</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              


            </div>
            <!-- /.box-body -->
          </div>
                <div class="col col-sm-12 col-lg-3">
  
      <div class="box">
         
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table text-center">
                <tbody>
                  <tr class="bg-primary">
                   
                    <th>Parameter</th>
                    <th>Unit</th>
                    <th>Optimal Range</th>
                </tr>
                <tr>
                  
                  <td>Temperature</td>
                  <td><sup>o</sup>C</td>
                  <td>18-60</td>
                </tr>

                <tr>
                 
                  <td>Turbidity </td>
                  <td>NTU</td>
                  <td> </td>
                </tr>

                <tr>
                  
                  <td>TDS</td>
                  <td>mg/L</td>
                  <td></td>
                </tr>

                <tr>
                  
                  <td>TSS</td>
                  <td>mg/L</td>
                  <td></td>
                </tr>

                <tr>
                  
                  <td>pH</td>
                  <td>No Unit</td>
                  <td></td>
                </tr>

                <tr>
                  
                  <td>Resistivity </td>
                  <td>ohm.cm</td>
                  <td></td>
                </tr>

                <tr>
                  
                  <td>Disolved Oxygen </td>
                  <td>mg/L</td>
                  <td></td>
                </tr>

                <tr>
                  
                  <td>Electrical Conductivity</td>
                  <td>us/cm</td>
                  <td></td>
                </tr>

                
                
              </tbody></table>
            </div>
          </div>
          </div>  
      </div>





    </section>

    <!-- /.content -->


 </div>



   
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


<script type="text/javascript">
  function clickedFunction(){
    alert("Clicked");
  }
</script>