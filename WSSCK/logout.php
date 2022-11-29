<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['role']);
session_destroy();

header("Location: login.php");
exit;
?>