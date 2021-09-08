<?php
session_start();
if(!isset($_SESSION["Theme"])) {
    $_SESSION["Theme"] = "Ambrosia.css";
    }
	include("Scripts/Script_Connection.php");
	$ClassID = $_REQUEST["Classes"];

	if (!isset($ClassID)) { //? Redirects if someone tries to access the Payment page directly
		header("Location: Main_Class Browse.php");
	}
	
	if (isset($_SESSION["UserID"])) {
		$UserID = $_SESSION["UserID"];
		$sqlUser = "SELECT FullName, CardNumber, Password from user_account WHERE UserID = '$UserID'";
		$result = mysqli_query($con, $sqlUser);
		$row = mysqli_fetch_assoc($result);
		$Name = $row["FullName"];
		$CardNum = $row["CardNumber"];
		$Password = $row["Password"];
		
		//? Loads the ClassID from the table based on the ClassID sent from the previous page
		$sqlClass = "SELECT ClassID, Title from classes WHERE ClassID = '$ClassID'";
		$resultC = mysqli_query($con, $sqlClass);
		$rowC = mysqli_fetch_assoc($resultC);
		$ClassID = $rowC["ClassID"];
		$ClassName = $rowC["Title"];
	}
	else {
		echo '<script>window.location.href="Login.php"; 
		alert("Please login to purchase this class!");</script>';
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Style-->
	<link href="<?php echo $_SESSION['Theme']; ?>" rel="stylesheet" type="text/css">
	<script src="Ambrosia.js"></script>
	<!-- Font Awesome-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
	
	<!-- Google Fonts-->
	<link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet">
	
	<!-- Icon -->
	<link rel="icon" href="Images/Logo/Ambrosia Logo.ico">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Payment</title>
	
</head>
<body class="PostBody">
	<?php include("Header.php"); ?>
	<!-- Content -->
	<div id="PayContent" class="payment-content clearfix">
	
		<!-- Main Content Articles  -->
			<div class="payment-wrapper">
				<div id="PayHead">
					<h2 class="PayHeader">Payment</h2>

<form action="Payment.php" method="POST">

					<!-- Hidden input to store ClassID -->
					<input type="hidden" name="Classes" value="<?php echo $ClassID; ?>">

						<h3>Payment Information</h3>
						<label for="PayMethodV">
							<input type="radio" id="PayMethodV" name="Paymethod" required>Visa 
							<i class="fab fa-cc-visa">
						</i></label>						
						<label for="PayMethodM">
							<input type="radio" id="PayMethodM" name="Paymethod">Master 
							<i class="fab fa-cc-mastercard">
							</i></label>
				</div>

					<div id="PayDetails">
						<label for="CardNum" class="PayLbl">Credit Card Number:
						<input type="text" class="PayBox" id="CardNum" name="CardNum"
						placeholder="Credit Card Number" required value="<?php echo $CardNum;?>"></label>

<br><br>				<label class="PayLbl">Card Expiration Date and Security Code
						<input type="month" id="CardExpiry" placeholder="MM/YY" required>
						<input type="number" id="CVV" placeholder="CVV" required>
							<i class="fas fa-question-circle">
						</i></label>
<br><br>
						<label for="CardName" class="PayLbl">Name on card:
						<input type="text" class="PayBox" id="CardName"
						 placeholder="Name on Card" value="<?php echo $Name; ?>" required></label>
<br><br>	
					</div>

				<div id="ConfirmPay">
						<!-- Authentication via account Password -->
					<h4 class="PayHeader"><?php echo 'Class: '. $ClassName; ?></h4>
					<label for="ConfirmPass" class="PayLbl"
					>Please enter your password to confirm your purchase:</label>
<br>
						<input type="password" id="ConfirmPass" name="ConfirmPass">
<br>
					<label for="SaveCard" class="PayLbl">
					<input type="checkbox" id="SaveCard" name="SaveCard" value="Checked">
					Would you like to save your card number?</label>
					
				</div>	
				
<br>
					<label for="PayTotal">Total:
					<input type="text" id="PayTotal" value="RM 20" disabled></label>
<br><br>
				<div id="ConfirmDiv"> <!-- Div for the Buttons -->
					<button type="button" id="CancelBtn" name="CancelBtn" class="btn btn-big"
					onclick="PayConfirm('Cancel')">Cancel</button>
					<button type="submit" id="ConfirmBtn" name="ConfirmBtn" class="btn btn-big"
					>Confirm</button>
				</div>			

</form>
				<button type="button" id="PayBtn" name="PayBtn" class="btn btn-big"
				onclick="PayConfirm('Confirm')">Pay</button>
			</div>
		</div>
	
					

	<!-- //Content -->
	
	<!-- Footer -->
	<?php include("Footer.php"); ?>
	<!-- //Footer -->
	<!-- JQuery-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
	
	<!-- Slick Carousel-->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
		
	<!-- Custom Script -->
	<script src="External JS.js"></script>
	
</body>
</html>

<?php
	if(isset($_POST["ConfirmBtn"])) {
		$CardNumber = $_POST["CardNum"];
		$SaveCard = $_POST["SaveCard"];
		$ConfirmPass = $_POST["ConfirmPass"];
		if ($ConfirmPass == $Password) {
			 $sqlBuy = "INSERT INTO subscription (UserID, ClassID) VALUES ('$UserID','$ClassID')";
			 mysqli_query($con, $sqlBuy);

			// TODO Redirect to User - Class page
			echo '<script>alert("Thank you for your support!"); 
			window.location.href="User - Classes.php";</script>';
			if ($SaveCard == "Checked") {
				$sqlUpdate = "UPDATE user_account SET CardNumber = '$CardNumber' WHERE UserID = '$UserID'"; 
				mysqli_query($con, $sqlUpdate);		
				echo '<script>alert("Credit card number has been saved!");</script>';
			}
		} else if ($ConfirmPass !== $Password) {
			echo '<script>alert("Your password is incorrect! Payment cancelled.");
			window.location.href="Main_\Class Browse.php";</script>';
			}

	}
?>