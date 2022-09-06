<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Write Name Here!"?>



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
      <div class="container">
        <div class="row">
          <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
              </div>


              <form role="form" method="POST" enctype="multipart/form-data">
              <div class="box-body">
              
              <div class="form-group">
              <label for="exampleInputPassword1">Product name</label>
              <input type="text" name="pro_name" class="form-control" id="exampleInputPassword1" placeholder="Product name">
              </div>
              <!-- dropdownn  -->

              <label for="">Sub Category</label>
        <input type="text" name="sub_category">
        <select name="categ" id="">
            <?php
            include("includes/DBconnection.php");
            $q="Select * from category";
            $res1=mysqli_query($conn,$q);
            while($row=mysqli_fetch_array($res1))
            foreach($res1 as $new_var)
            {            ?>
            <option value="<?php echo $new_var['categories']?>">
            <?php echo $new_var['categories']?></option>
            <?php
            }
        ?>  
        </select>
        <label for="exampleInputPassword1">Price</label>
              <input type="text" name="price" class="form-control" id="exampleInputPassword1" placeholder="Price">
              </div>
              <div class="form-group">
              <label for="exampleInputFile">Image Upload</label>
              <!-- <input type="file" name="image" id="exampleInputFile"> -->
              <input type="file" name="image" id="filep">
              
              </div>
            
              </div>

              <div class="box-footer">
              <button type="submit" name="upload" class="btn btn-primary">Submit</button>
              </div>
              </form>
              </div>

          </div>
          
        </div>
      </div>
    
</section>
   
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
<?php
include('includes/DBconnection.php');
if(isset($_POST['upload'])){
  $product=$_POST['pro_name'];
  $sub_cat=$_POST['sub_category'];
    $categ=$_POST['categ'];
    $price=$_POST['price'];

  // image upload start
  // $image2=$_FILES['image']['name'];
  // $temp_image=$_FILES['image']['tmp_name'];
  // $folder="uploads/". basename($_FILES['image']['name']);
  // move_uploaded_file($_FILES['image']['tmp_name'],$folder);
  // image upload end code

  $image=$_FILES['image']['name'];// file actual name
	$img_tmp_name=$_FILES['image']['tmp_name'];// temporary name
    $folder = "uploads/".basename($_FILES['image']['name']);
    move_uploaded_file($img_tmp_name,$folder);


  $sql="INSERT INTO `product`(`product_name`,`category`, `sub_category`, `price`, `image`)values('$product','$sub_cat','$categ','$price','$image')";
  echo $sql;
  $res=mysqli_query($conn,$sql);

  if($res){
    echo '<script>alert("Data sucesssfully ")</script>';
  }



}
?>
