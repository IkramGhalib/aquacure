<?php
require_once("opendb.php");
$q = $_GET['q'];

$sql="SELECT trid,twid, zone, name, location FROM transformer WHERE zone = '".$q."'";
$result = $conn -> query($sql) or die(error);


foreach($result as $row){
?>
  <option value="<?php echo $row['trid'];?>"><?php echo $row['twid']." - ".$row['name']." - ".$row['location'];?></option>
<?php
}
$conn = NULL;
?>
</body>
</html>