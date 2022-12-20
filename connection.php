<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$dbname = "demo";

try{
    $conn = new PDO("mysql:host=$server_name;dbname=$dbname",$user_name,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // echo "Connected Succesfully";

}
catch(PDOException $e){
    echo "Connection Failed".$e->getMessage();
}
?>