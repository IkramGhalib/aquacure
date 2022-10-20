<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css.map">
  <title>Dashboard </title>
  
  <meta content="" name="description">
  <meta content="" name="keywords">

    <?php   include("includes/head.php");  ?>
     <?php  $pageName = "Dashboard";  ?>
     
</head>

<body>
 <?php   include("includes/navbar.php");  ?>
  
    <section class="inner-page">
      <div class="container">
          <div>
            <?php
              include_once("db/opendb.php");
              $query = "SELECT moduleid FROM raw_data GROUP BY moduleid ORDER BY moduleid";
              // echo $query;
              $res = $conn1->query($query) or die($conn1->error);
              // $devices = $res -> fetch_all();
              // print_r($devices);

            ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
              <label class="bg-warning p-2" style="color:#fff; font-weight: bold;">Select Device</label>
              <select class="p-2" name="deviceId" id="deviceId">
                <?php
                  while($row = $res->fetch_assoc())
                  {
                    ?>
                      <option value="<?php echo $row['moduleid'] ?>">
                    <?php
                    echo $row['moduleid'];
                    ?>
                      </option>
                    <?php
                  }
                ?>
              </select>
              <label class="bg-warning p-2" style="color:#fff; font-weight: bold;">From</label>
              <input class="p-2" type="datetime-local" name="fdate" id="fdate" required />
              <label class="bg-warning p-2" style="color:#fff; font-weight: bold;">To</label>
              <input class="p-2" type="datetime-local" name="tdate" id="tdate" required />
              <button type="submit" name='submit' id='submit' class="btn btn-primary font-weight-bolder">Locate</button>
            </form>
            <br>
          </div>
          <div id="dinfo" class="container font-weight-bolder"></div>
          <div id="map-canvas"></div>
    <?php if(isset($_POST['submit']))
    {
      include_once("db/opendb.php");

      $fdate = $_POST['fdate'];
      $tdate = $_POST['tdate'];
      $deviceid = $_POST['deviceId'];
      
      $query = "select moduleid,latitude,longitude from raw_data where longitude !=0 and latitude !=0 and moduleid = '".$deviceid."' AND serverdatetime BETWEEN '".$fdate."' AND '".$tdate."' ORDER BY serverdatetime ASC";

      $result = $conn1 -> query($query) or die($conn1->error);
      // $result2 = $conn -> query($query) or die("Query error");
      $lat_long_arr = array();

      while($row = $result->fetch_assoc())
      {
        array_push($lat_long_arr, array($row['latitude'], $row['longitude']));
      }
      
      ?>
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGdcSfLwqmDVg_HLbYAJo0qkbElSM5_fc&callback=initMap"></script>
    <script>
      var d = document.getElementById("dinfo");
      d.innerHTML = "<p>Device :: " + "<?php echo $deviceid." Location A = (Latitude:".$lat_long_arr[0][0].", Longitude:".$lat_long_arr[0][1].")"." Location B = (Latitude:".end($lat_long_arr)[0].", Longitude:".end($lat_long_arr)[1].")</p>" ?>"  ;
      console.log("map");
      console.log("<?php echo $query ?>");

      var tmpArray = <?php echo json_encode($lat_long_arr) ?>;

      function initMap()
      {
        // var select = document.getElementById("deviceId");
        // var value = select.options[select.selectedIndex].value; 
        // alert(value);

        var directionsService = new google.maps.DirectionsService();
        var directionsDisplay = new google.maps.DirectionsRenderer();


        // var loc_1 = {lat: 34.0100, lng: 71.4889};
        

        var map = new google.maps.Map(document.getElementById('map-canvas'),
        {
          zoom: 12,
          center: {lat: parseFloat(tmpArray[0][0]), lng: parseFloat(tmpArray[0][1])}
        });
        directionsDisplay.setMap(map);

        for(i=0; i < tmpArray.length-1; i++)
        {
            // console.log(tmpArray[i]);
            var loc = {lat: parseFloat(tmpArray[i][0]), lng: parseFloat(tmpArray[i][1])};
            
            directionsService.route({
              origin: {lat: parseFloat(tmpArray[i][0]), lng: parseFloat(tmpArray[i][1])},
              destination: {lat: parseFloat(tmpArray[i + 1][0]), lng: parseFloat(tmpArray[i + 1][1])},
              travelMode: 'DRIVING'
            }, function(response, status) {
              console.log(response);

              if(status === 'OK')
              {
                directionsDisplay.setDirections(response);
              } else {
                window.alert('Directions request failed due to ' + status);
              }
            });
            // console.log(loc);
            // path.push(new google.maps.LatLng(parseFloat(tmpArray[i][0]), parseFloat(tmpArray[i][1])));
            
            // var marker = new google.maps.Marker({
            //     position: loc,
            //     map: map,
            //     title: "Loc"
            // });
        }
      }
      // initMap();
  </script>
  <?php
    } ?>
          <br><br><br><br>

          <style>
            #map-canvas{
              width: 100%;
              height: 450px;
              border: 1px solid blue;
            }
          </style>
      </div>

    </section>


  </main>

     <?php  include("includes/footer.php");  ?>
    


</body>

</html>