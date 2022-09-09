<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Inner Page - BizLand Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

    <?php   include("includes/head.php");  ?>
     <?php  $pageName = "Contact";  ?>
  <!-- =======================================================
  * Template Name: BizLand - v3.1.0
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+92</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
 <?php   include("includes/navbar.php");  ?>

  <main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><?php  echo $pageName ?></h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><?php  echo $pageName ?></li>
          </ol>
        </div>

      </div>
      <?php
require("db/opendb.php");
$sql="Select * from device";
 $result = $conn->query($sql);
foreach ($result as $value){
  // Add to XML document node
  // echo '<marker >';
  // echo 'device_id="' . $value['device_id'] . '" ';
  // echo 'name="' . $value['name'] . '" ';
  // echo 'latitude="' . $value['latitude'] . '" ';
  // echo 'longitude="' . $value['longitude'] . '" ';
  //  echo 'river_level="' . $value['river_level'] . '" ';
  //  $ind = $ind + 1;
}
?>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="col-lg-12 ">
            <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!!1m18!1m12!1m3!1d14143117.941545919!2d60.32337114882688!3d30.068124090484673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38db52d2f8fd751f%3A0x46b7a1f7e614925c!2sPakistan!5e0!3m2!1sen!2s!4v1622022344935!5m2!1sen!2s" frameborder="0" style="border:0; width: 100%; height: 500px;" allowfullscreen=""></iframe>

          </div>
    </section><!-- End Contact Section -->
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
 <script>
                  var customLabel = {
                      restaurant: {
                          label: 'R'
                      },
                      bar: {
                          label: 'B'
                      }
                  };

                  function initMap() {
                      var map = new google.maps.Map(document.getElementById('map'), {
                          center: new google.maps.LatLng(34.1348, 71.6913),
                          zoom: 12
                      });


                      // Change this depending on the name of your PHP or XML file
                      downloadUrl('markers.php', function(data) {
                          var xml = data.responseXML;
                          var markers = xml.documentElement.getElementsByTagName('marker');
                          Array.prototype.forEach.call(markers, function(markerElem)) {
                              var id = markerElem.getAttribute('device_id');
                             
                              var name = markerElem.getAttribute('name');
                              var latitude = markerElem.getAttribute('latitude');
                              var longitude = markerElem.getAttribute('longitude');
                              var tittleText="Smart Flood Management System";
                                

                              var point = new google.maps.LatLng(
                                  parseFloat(markerElem.getAttribute('latitude')),
                                  parseFloat(markerElem.getAttribute('longitude')));

                              var infowincontent = document.createElement('div');
                              var strong = document.createElement('strong');
                              strong.textContent = "name="+name
                              infowincontent.appendChild(strong);
                              infowincontent.appendChild(document.createElement('br'));

                              var text = document.createElement('text');
                              text.textContent = "name="+name
                              infowincontent.appendChild(text);

                              var marker = new google.maps.Marker({
                                  map: map,
                                  position: point,
                                   icon: {
                                  path: google.maps.SymbolPath.CIRCLE,
                                  scale: 12.5,
                                  fillColor: "#009AFF",
                                  fillOpacity: 0.8,
                                  strokeWeight: 0.4
                                      },
                                  //icon:'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                                  // title: tittleText+'\n\n'+'latitude='+latitude+'\n'+'Longitude='+longitude+'\n'+'Mangnitude='+magnitude+'\n'+'Depth='+depth
                                  title:name

                              });

                            var contentString =
                            '<div id="content">' +
                            '<div id="siteNotice">' +
                            "</div>" +
                            '<h3 id="firstHeading" class="firstHeading"></h3>' +
                            '<div id="bodyContent">' +
                            
                            '<h6> ' +name+'</h6>'+


                               
                            "</div>" +
                          "</div>";

                           var infowindow = new google.maps.InfoWindow({
                              content: contentString
                            });
                                         
                              marker.addListener('mouseover',function()
                              {
                                  infowindow.open(map, marker);
                              });
                               marker.addListener('mouseout',function()
                              {
                                  infowindow.close(map, marker);
                              });

                              marker.addListener('click', function() {
                                  //alert(name);
                                 
                                  var urlData =  id;

                                     
                                  window.location.href = "dashboard.php?id="+urlData+"&name="+name;
                                  //document.writeln(encoded);
                               //   document.writeln(decoded);
                                  infoWindow.setContent(infowincontent);
                                  infoWindow.open(map, marker);
                              });


                          });
                      });
                  }





                  function downloadUrl(url, callback) {
                      var request = window.ActiveXObject ?
                          new ActiveXObject('Microsoft.XMLHTTP') :
                          new XMLHttpRequest;

                      request.onreadystatechange = function() {
                          if (request.readyState == 4) {
                              request.onreadystatechange = doNothing;
                              callback(request, request.status);
                          }
                      };

                      request.open('GET', url, true);
                      request.send(null);
                  }

                  function doNothing() {}
              </script>
              <script async defer
                      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGdcSfLwqmDVg_HLbYAJo0qkbElSM5_fc&callback=initMap">
              </script>