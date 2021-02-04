<?php
session_start();
include("mysqli.php");
include("user.php");

$mysqli = new mysqli("localhost", "root", "S(*DIOTkelsdf90", "driving");
$mysqli_si = new SimpleMySQLi("localhost", "root", "S(*DIOTkelsdf90", "driving", "utf8mb4", "assoc");

$user = new User($mysqli_si);
?>