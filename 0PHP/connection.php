<?php


$server_servant = "localhost";
$server_username = "root";
$server_password = "";
$server_database = "CityPop_Database";

$kobling = new mysqli($server_servant, $server_username, $server_password, $server_database);

if($kobling->connect_error){
    die("Connection failed: ".$kobling->connect_error);
} else {
    echo "<script> alert('Connection successful!')</script>";
}

$kobling->set_charset("utf8");



?>