<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

    <?php   include("includes/head.php");  ?>
     <?php  $pageName = "Dashboard";  ?>
  <!-- =======================================================
  * Template Name: BizLand - v3.1.0
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
 <?php   include("includes/navbar.php");  ?>
 <?php  $id=0; 

  ?>
  <?php
      include_once("db/opendb.php");
      $lat = array();
      $long = array();
      $query = "select * from device";
      $result = $conn -> query($query) or die("Query error");
      $result2 = $conn -> query($query) or die("Query error");
    ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGdcSfLwqmDVg_HLbYAJo0qkbElSM5_fc&callback=initMap">
    </script>
<script>
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(50);
        
    // Multiple markers location, latitude, and longitude
    var markers = [
        <?php
            foreach($result as $row){
                echo '["'.$row['device_id'].'","'.$row['name'].'", '.$row['latitude'].', '.$row['longitude'].'],';
            }
        ?>
    ];
                        
    // Info window content
    var infoWindowContent = [
        <?php 
            foreach($result2 as $row){ ?>
              
                ['<div class="info_content">' +
                '<h3><?php echo $row['device_id']." | ".$row['name']; ?></h3>' +
                '<p><?php echo "Latitude: ".$row['latitude']; ?><br>' +
                '<p><?php echo "Longitude: ".$row['longitude']; ?><br>' + '</div>'

                ],

        <?php 
        }
        ?>
    ];
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][2], markers[i][3]);
        var trid = markers[i][0]; 

        
        var color = "";
        color = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";    
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            icon: {
              url: color
            },
            title: markers[i][0]
        });
        

        marker.addListener('mouseover', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        marker.addListener('click', (function(marker, i) {
            return function() {
              link = "device_details.php?id=";
              window.location.href = link.concat(markers[i][0]);
              
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(9);
        google.maps.event.removeListener(boundsListener);
    });
    
}


// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);
</script>

  <main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
         
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><?php  echo $pageName ?></li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
         <div class="col-lg-12">
          <div id="mapCanvas"></div>
    </div>
   
<style type="text/css">
  #mapCanvas {
    width: 100%;
    height: 500px;
}
</style>

        

    
             
          </div>
          <br>

        </div>

 <br>

  </div>
</section>


  </main><!-- End #main -->


  <!-- ======= Footer ======= -->

     <?php  include("includes/footer.php");  ?>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php  include("includes/scripts.php");  ?>

</body>

</html>
<style type="text/css">
  #map {
    width: 100%;
    height: 650px;
}
</style>