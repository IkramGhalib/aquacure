<?php
  require_once("subdivid.php");

$servername = "10.13.144.6";
//$servername = "localhost";
$username = "user_".$subdivid;
$password = "Adm1n@".$subdivid; // set this field "" (empty quotes) if you have not set any password in mysql
$dbname = $dbtype."_".$subdivid;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//echo "Connection Successfull";
}
catch(PDOException $e)
    {
    echo  $e->getMessage();
    }

?>
