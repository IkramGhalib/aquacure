<?php
//require("phpsqlajax_dbinfo.php");
require("db/opendb.php");
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

// Opens a connection to a MySQL server



// Select all the rows in the markers table
$query = "SELECT * FROM devices";
$result= mysqli_query($conn,$query);
if($result){
  die('Invalid query :'.mysql_error());

}


 // $result = $conn->query($query);


header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while($value = @mysqli_fetch_assoc($result)){
// foreach ($result as $value){
  // Add to XML document node
  echo '<marker ';
  echo 'device_id="' . $value['device_id'] . '" ';
  echo 'name="' . parseToXML($value['name']) . '" ';
  echo 'latitude="' . $value['latitude'] . '" ';
  echo 'longitude="' . $value['longitude'] . '" ';
  // echo '<marker ';
  // echo 'id="' . $value['id'] . '" ';
  // echo 'name="' . parseToXML($value['name']) . '" ';
  // echo 'lat="' . $value['lat'] . '" ';
  // echo 'lng="' . $value['lng'] . '" ';
  
  echo '/>';
  $ind = $ind + 1;
}

// End XML file
echo '</markers>';

?>