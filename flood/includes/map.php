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
                          Array.prototype.forEach.call(markers, function(markerElem) {
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