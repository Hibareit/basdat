<?php

$host ="localhost";
$user = "root";
$password = "";
$database = "administrasi gym";

$koneksi = mysqli_connect($host, $user, $password, $database);

if(!$koneksi){
    error_log("error".mysqli_connect_error());
    exit;
} 

?>