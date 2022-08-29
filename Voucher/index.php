<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<meta name="description" content="Voucher Entry">
		<title>Voucher Prototype V1</title>
	</head>
	<body>	
		<?php 
			include('php/connect.php');
		?>
		<nav>		
			<ul class="navHeader">
				<li><a href="#"><h4>Voucher Entry Prototype 1</h4></a></li>
				<li><a href="#">Log out</a></li>
			</ul>
		</nav>
		<main>
<!---------- Form for New Voucher -------------------------------->
			<div class="col-sm-6">
			<div class="panel panel-default">
				<div class ="panel-heading">Add Voucher here</div>
				<div class="panel-body">
				<form name="entryForm" action="php/addentry.php" method="POST">
					<?php session_start(); 
						if(isset($_SESSION['activeVoucherNumber'])) {
						$voucherNum = $_SESSION['activeVoucherNumber'];	
						$isdisabled = "readonly";
						}else {
							$voucherNum = "";
							$isdisabled = "";
						}
					?>
					<label for="voucherNum">Voucher Number: </label>
					<input type="text" class="form-control" id="voucherNum"  name="voucherNum" value="<?php echo $voucherNum; ?>" <?php echo $isdisabled; ?>><br>
					<label for="entryDate">Entry Date: </label>
					<input type="date" class="form-control" id="entryDate" name="entryDate"><br>
					<label for="accountName">Account Name: </label>
					<select name="accountName" class="form-control" placeholder="Select.." id="accountName">
						<option value="account1">Account #1</option>
						<option value="account2">Account #2</option>
						<option value="account3">Account #3</option>
						<option value="account4">Account #4</option>
					</select><br>
					<label for="narration">Narration: </label>
					<input type="text" class="form-control" id="narration" name="narration"><br>
					<label for="debit">Debit: </label>
					<input type="number" class="form-control" id="debit" name="debit"><br>
					<label for="credit">Credit: </label>
					<input type="number" class="form-control" id="credit" name="credit"><br>
					<input type="Submit" class="btn btn-success" value="Add">
					<input type="button"  class="btn btn-success" value="New Voucher" onclick="location='php/clearvoucher.php';">
				</form>
			</div>
			</div>
			</div>
<!----------- Display table as per VoucherNumber ------------------------------------>	
			<div class="col-sm-6">
				<?php 
				$sql = "SELECT * FROM voucherentry WHERE VoucherNum = '$voucherNum'";
				$result = $mysqli->query($sql);
				?>
				<table class="table">
					<tr>
						<th>Transaction Number</th>
						<th>Account Name</th>
						<th>Narration</th>
						<th>Debit</th>
						<th>Credit</th>
						<th colspan=2>Action</th>
					</tr>
					<?php
					while($rows=$result->fetch_assoc())
					{
					?>
					<tr>
						<td><?php echo $rows['TransactionNum']; ?></td>
						<td><?php echo $rows['AccountName']; ?></td>
						<td><?php echo $rows['Narration']; ?></td>
						<td><?php echo $rows['Debit']; ?></td>
						<td><?php echo $rows['Credit']; ?></td>
<!------------------------Edit and Delete Action on Table --------------------------->
						<td><button type="button" class="btn btn-info" onclick="location='php/editTransaction.php?id=<?php echo $rows['TransactionNum'];?>';"><span class="glyphicon glyphicon-pencil"></span></button></td>
						<td><button type="button" class="btn btn-danger" onclick="location='php/deleteTransaction.php?id=<?php echo $rows['TransactionNum'];?>&voucher=<?php echo $rows['VoucherNum'];?>';"><span class="glyphicon glyphicon-trash"></span></button></td>
						</tr> <?php } ?>
				</table>
<!------------- Get the sum for DEBIT in table--------------------------------------->
				<?php
				if(isset($voucherNum)) {
				$sqldebit = "SELECT SUM(Debit) as sum_debit FROM voucherentry WHERE VoucherNum = '$voucherNum'";
				$sumDebit = $mysqli->query($sqldebit);
				$row = mysqli_fetch_array($sumDebit); 
				}
				else {
				$sumDebit ="";
				}
				?>
				<div class="form-group row">
					<div class="col-xs-3	">
						<label for="totalDebit">Debit: </label>
						<input type="number" class="form-control" id="totalDebit" name="totalDebit" value="<?php echo $row['sum_debit']; ?>" disabled>
					</div>
				<!-- Get the sum for Credit in table-->
				<?php
				if(isset($voucherNum)) {
				$sqlcredit = "SELECT SUM(Credit) as sum_credit FROM voucherentry WHERE VoucherNum = '$voucherNum'";
				$sumCredit = $mysqli->query($sqlcredit);
				$row = mysqli_fetch_array($sumCredit);
				$mysqli->close(); 
				}
				else{
				$sumDebit ="";
				}
				?>
				<!-- Display total Credit and Debit-->
					<div class="col-xs-3">
						<label for="totalCredit">Credit: </label>
						<input type="number" class="form-control" id="totalCredit" name="totalCredit" value="<?php echo $row['sum_credit']; ?>" disabled>
					</div>
				</div>
			</div>
		</main>
	</body>
</html>