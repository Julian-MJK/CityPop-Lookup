<?php
/**
 * Created by IntelliJ IDEA.
 * User: be14120001
 * Date: 13.05.2019
 * Time: 10:56
 */

require "connection.php";

$table = $_POST['table'];

$sql = "SELECT * FROM $table";

$query = $kobling->query($sql);

$headers_associative = $query->fetch_assoc();

$headers = array();

$count = 0;


foreach($headers_associative as $header => $value){
    $headers[] = $header;
    echo $headers[$count] . "<br>";
    $count++;
}




























/*if($table==="artist"){
    $firstName = $_POST['firstName'];
    if(isset($_POST['lastName'])) $lastName = $_POST['lastName'];
    if(isset($_POST['birthYear'])) $birthYear = $_POST['birthYear'];
    if(isset($_POST['birthCity'])) $birthCity = $_POST['birthCity'];

} else if ($table==="album"){

} else if ($table==="song"){

}*/







