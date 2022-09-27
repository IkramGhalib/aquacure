<?php
    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $database = "smartenv_uet";

    $servername = "10.13.144.6";
    $username = "user_26217";
    $password = "Adm1n@26217";
    $database = "smartenv_uetpswr";


    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


?>