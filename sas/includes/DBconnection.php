<?php



$servername='localhost';
$username='root';
$password='';
$db_name='cit';

$conn=mysqli_connect($servername,$username,$password,$db_name);

if(!$conn){
    die("Could not connect".mysql_error());
}
else{
    // echo "Sucessfully connected";
}
?>


