<?php

$mysqli = new mysqli("localhost", "root", "", "voucher");

if($mysqli == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Print host information
// echo "Connect Successfully. Host info: ";

?>