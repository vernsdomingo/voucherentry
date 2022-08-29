<?php 
session_start();
include 'connect.php';

$voucherNum = mysqli_real_escape_string($mysqli, $_REQUEST['voucherNum']);
$transaction = mysqli_real_escape_string($mysqli, $_REQUEST['transactionNum']);
$entryDate = mysqli_real_escape_string($mysqli, $_REQUEST['entryDate']);
$accountName = mysqli_real_escape_string($mysqli, $_REQUEST['accountName']);
$narration = mysqli_real_escape_string($mysqli, $_REQUEST['narration']);
$debit = mysqli_real_escape_string($mysqli, $_REQUEST['debit']);
$credit = mysqli_real_escape_string($mysqli, $_REQUEST['credit']);
$sql = "UPDATE voucherentry SET EntryDate = '$entryDate', AccountName = '$accountName', Narration = '$narration', Debit = '$debit', Credit = '$credit' WHERE TransactionNum = '$transaction'";
if(mysqli_query($mysqli, $sql)){
	echo "Record updated";
	$_SESSION['activeVoucherNumber'] = $voucherNum;
	header("location: ../index.php");
} else {
	echo "Error $sql. " . mysqli_error($mysqli);
}


mysqli_close($mysqli);
?>