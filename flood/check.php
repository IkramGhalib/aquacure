<?php
require("db/opendb.php");
$sql="Select devices.*, name from devices, devicelogs where devices.device_id = devicelogs.deviceId = devices.device_id = 'D01' AND devicelogs.dateTime BETWEEN '2020-08-25' AND '2021-05-25' order by dateTime desc limit 100";
 $result = $conn->query($sql);
  $ind = 0;
foreach ($result as $value){
  // Add to XML document node
  echo '<marker >';
  echo 'device_id="' . $value['device_id'] . '" ';
  echo 'name="' . $value['name'] . '" ';
  echo 'latitude="' . $value['latitude'] . '" ';
  echo 'longitude="' . $value['longitude'] . '" ';
   echo 'river_level="' . $value['river_level'] . '" ';
   $ind = $ind + 1;
}
?>