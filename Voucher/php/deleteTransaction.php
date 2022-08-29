<?php 
session_start();
include 'connect.php';

$transaction = $_GET['id'];
$voucherNum = $_GET['voucher'];
$sql = "DELETE FROM voucherentry WHERE TransactionNum = '$transaction'";
if ($mysqli->query($sql) === TRUE) {
	$_SESSION['activeVoucherNumber'] = $voucherNum;
	header("location: ../index.php");
}

mysqli_close($mysqli);
?>