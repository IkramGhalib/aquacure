<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Water Storage Level</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

    <?php   include("includes/head.php");  ?>
    <?php  $pageName = "Rainfall and River Level";  ?>
  <!-- =======================================================
  * Template Name: BizLand - v3.1.0
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
      <script src="js/fusioncharts.js"></script>
</head>

<body onload="javascript:doFocus()">

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+92***</span></i>
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
          <h2><?php  echo $pageName; ?></h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><?php  echo $pageName; ?> </li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="" style="margin-left: 3%;margin-right: 3%">
       <div class="row mb-2">
          
          <div class="col-sm-12">
             <div  id="map" style="height:700px;"></div>
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
                          zoom: 8
                      });


                      // Change this depending on the name of your PHP or XML file
                      downloadUrl('markers.php', function(data) {
                          var xml = data.responseXML;
                          var markers = xml.documentElement.getElementsByTagName('marker');
                          Array.prototype.forEach.call(markers, function(markerElem) {
                              var id = markerElem.getAttribute('id');
                             
                              var name = markerElem.getAttribute('name');
                              var latitude = markerElem.getAttribute('lat');
                              var longitude = markerElem.getAttribute('lng');
                                var tittleText="Smart Flood Management System";
                                

                              var point = new google.maps.LatLng(
                                  parseFloat(markerElem.getAttribute('lat')),
                                  parseFloat(markerElem.getAttribute('lng')));

                              var infowincontent = document.createElement('div');
                              var strong = document.createElement('strong');
                              strong.textContent = "name="+name
                              infowincontent.appendChild(strong);
                              infowincontent.appendChild(document.createElement('br'));

                              var text = document.createElement('text');
                              text.textContent = "name="+name
                              infowincontent.appendChild(text);
                              var image = {
                                     url: "assets/img/marker3.gif", // url
                                     scaledSize: new google.maps.Size(70,70), // size

                                    // anchor: new google.maps.Point(anchor_left, anchor_top) // anchor 
                                 };
                              var marker = new google.maps.Marker({
                                  map: map,
                                  position: point,
                                  // icon: {
                                  // path: google.maps.SymbolPath.CIRCLE,
                                  // scale: 12.5,
                                  // fillColor: "#009AFF",
                                  // fillOpacity: 0.8,
                                  // strokeWeight: 0.4
                                  //     },

                                  icon: image,
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

                                     
                                  window.location.href = "rainfall_riverLevel.php?id="+urlData+"&name="+name;
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
          </div><!-- /.col -->
        </div><!-- /.row -->
        <?php  if(isset($_GET['id']) && isset($_GET['name'])){  ?>

          <div class="alert text-white bg-success">
  <strong>Success!</strong> Showing Details of <b><?php  echo $_GET['name'] ?></b>
</div>
      <div class="row highlighted" id="focus">
        <div class="col-md-4">
              <div class="card text-white bg-primary" style="width: 100%;">
                <img class="card-img-top" src="assets/img/dummy.png" alt="Card image cap">
                <div class="card-body" style="text-align: center">
                  <h4 class="card-title">Rainfall</h4>
                <!--   <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                
                 </div>
               </div>
        </div>

         <div class="col-md-4">
                <div class="card bg-success" style="width: 100%;">
                <img class="card-img-top" src="assets/img/dummy.png" alt="Card image cap">
                <div class="card-body" style="color: white;text-align: center">
                  <h4 class="card-title" >River Level</h4>
                 <!--  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                </div>
                  </div>
        </div>

        <div class="col-md-4">
                     <div class="card bg-secondary" style="width: 100%;">
                    <img class="card-img-top" src="assets/img/dummy.png" alt="Card image cap">
                    <div class="card-body" style="color: white;text-align: center">
                      <h4 class="card-title">Flow</h4>
                     <!--  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                      <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                  </div>
        </div>

      </div>
      <div class="row">&nbsp;</div>
      <div class="row">&nbsp;</div>
    <div id="chart-container"></div>
    <div class="row">&nbsp;</div>

      <table class="table table-sm table-dark">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">First</th>
              <th scope="col">Last</th>
              <th scope="col">Handle</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td colspan="2">Larry the Bird</td>
              <td>@twitter</td>
            </tr>
          </tbody>
</table>

      <?php  } ?>

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

<script type="text/javascript">
  
const dataSource = {
  chart: {
    caption: "Cummulative Rainfall(mm)",
    yaxisname: "Values",
   // subcaption: "2007-2016",
    legendposition: "Right",
    drawanchors: "0",
    showvalues: "0",
    //plottooltext: "<b>$dataValue</b> iPhones sold in $label",
     palettecolors: "#166FC4",
       bgColor: "#F4F4F4",
      bgAlpha: "50",
       baseFontSize: "20",
    baseFontColor: "#1D69C3",

    theme: "gammel"
  },
  data: [
    {
      label: "2007",
      value: "1380000"
    },
    {
      label: "2008",
      value: "1450000"
    },
    {
      label: "2009",
      value: "1610000"
    },
    {
      label: "2010",
      value: "1540000"
    },
    {
      label: "2011",
      value: "1480000"
    },
    {
      label: "2012",
      value: "1573000"
    },
    {
      label: "2013",
      value: "2232000"
    },
    {
      label: "2014",
      value: "2476000"
    },
    {
      label: "2015",
      value: "2832000"
    },
    {
      label: "2016",
      value: "3808000"
    }
  ]
};

FusionCharts.ready(function() {
  var myChart = new FusionCharts({
    type: "area2d",
    renderAt: "chart-container",
    width: "100%",
    height: "500",
    dataFormat: "json",
    dataSource
  }).render();
});
</script>
<script type="text/javascript">
  function doFocus()
  {

   document.getElementsByClassName("row highlighted")[0].scrollIntoView();

  }

</script>