<!DOCTYPE html>
<html>
		<head>
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" href="../css/style.css">
				<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
				<meta name="description" content="Voucher Entry">
				<title>Voucher Prototype V1</title>
		</head>
	<body>	

<!-- TransactionNum to be edited (php) -->
			<?php
			include 'connect.php';	
			session_start();
			$transaction = $_GET['id'];
			$sqlTrans = "Select * FROM voucherentry WHERE TransactionNum = '$transaction'";
			$result = $mysqli->query($sqlTrans);
			$rows=$result->fetch_assoc();
					
			$vouchernum = $rows['VoucherNum'];
			$entrydate = $rows['EntryDate'];
			$accntname = $rows['AccountName'];
			$narration = $rows['Narration'];
			$debit = $rows['Debit'];
			$credit = $rows['Credit'];
			$isdisabled = "readonly";
			?>
<!-- Navigation -->
		<nav>		
			<ul class="navHeader">
				<li><a href="#"><h4>Voucher Entry Prototype 1</h4></a></li>
				<li><a href="#">Log out</a></li>
			</ul>
		</nav>
		<main>
				<div class="col-sm-12">
					<div class="panel panel-default">
						<div class="panel panel-heading"> Edit Transaction for:  </div>
							<div class="panel-body">
								<form name="updateTransaction" action="updateTransaction.php" method="POST">
								<label for="voucherNum">Voucher Number: </label>
								<input type="text" class="form-control" id="voucherNum"  name="voucherNum" value="<?php echo $vouchernum; ?>" <?php echo $isdisabled; ?>><br>
								<label for="transactionNum">Transaction Number: </label>
								<input type="text" class="form-control" id="transactionNum"  name="transactionNum" value="<?php echo $transaction; ?>" <?php echo $isdisabled; ?>><br>
								<label for="entryDate">Entry Date: </label>
								<input type="date" class="form-control" id="entryDate" name="entryDate" value="<?php echo $entrydate; ?>"><br>
								<label for="accountName">Account Name: </label>
								<select name="accountName" class="form-control" placeholder="Select.." id="accountName" value="<?php echo $accntname; ?>">
									<option value="account1">Account #1</option>
									<option value="account2">Account #2</option>
									<option value="account3">Account #3</option>
									<option value="account4">Account #4</option>
								</select><br>
								<label for="narration">Narration: </label>
								<input type="text" class="form-control" id="narration" name="narration" value="<?php echo $narration; ?>"><br>
								<label for="debit">Debit: </label>
								<input type="number" class="form-control" id="debit" name="debit" value="<?php echo $debit; ?>"><br>
								<label for="credit">Credit: </label>
								<input type="number" class="form-control" id="credit" name="credit" value="<?php echo $credit; ?>"><br>
								<input type="Submit" class="btn btn-success" value="Update Record">
				</form>
							
							</div>
					</div>
				</div>

	</body>
</html>

