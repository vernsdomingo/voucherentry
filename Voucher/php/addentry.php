<?php

session_start();
include 'connect.php';

$voucherNum = mysqli_real_escape_string($mysqli, $_REQUEST['voucherNum']);
$entryDate = mysqli_real_escape_string($mysqli, $_REQUEST['entryDate']);
$accountName = mysqli_real_escape_string($mysqli, $_REQUEST['accountName']);
$narration = mysqli_real_escape_string($mysqli, $_REQUEST['narration']);
$debit = mysqli_real_escape_string($mysqli, $_REQUEST['debit']);
$credit = mysqli_real_escape_string($mysqli, $_REQUEST['credit']);

$sql = "INSERT INTO voucherentry (VoucherNum, EntryDate, AccountName, Narration, Debit, Credit) Values ('$voucherNum', '$entryDate', '$accountName', '$narration', '$debit', '$credit')";

if(mysqli_query($mysqli, $sql)){

	echo "Records added succesfully";
	$_SESSION['activeVoucherNumber'] = $voucherNum;
	header("location: ../index.php");

} else {
	echo "Error $sql. " . mysqli_error($mysqli);
}

mysqli_close($mysqli);

?>