<?php
session_start();
if(!isset($_SESSION["Theme"])) {
    $_SESSION["Theme"] = "Ambrosia.css";
    }
 //^ If the User is logged in, the person accessing this page is redirected to the Home page
 if (isset($_SESSION["UserID"]) || isset($_SESSION["Admin"])) {
    header("Location: Main_Home Page.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link id="Theme" rel="stylesheet" type="text/css"
        href="<?php echo $_SESSION['Theme']; ?>">
            <!-- Font Awesome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">	
             <!-- Google Fonts-->
        <link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet">
            <!-- Icon -->
        <link rel="icon" href="Images/Logo/Ambrosia Logo.ico">
        <script src="Ambrosia.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ambrosia</title>
    </head>
    <body id="LoginBody">
        <!-- Header -->
        <?php include("Header.php"); ?>

            <!--? Login Page Contents -->
        <form id="CreatePanel" class="AccountPanel" method="post" action="Scripts/Script_AccountCreate.php"> 
            <!--^ Create Account Panel -->
            <div class="login-wrapper">
                <h1 class="LoginHeader">Create Account</h1>
            </div>

            <input type="text" 
                    id="Username"
                    name="Username"
                    class="InputField"
                    placeholder="Username"
                    required> 
<br>
            <input type="password"
                    id="Password"
                    name="Password"
                    class="InputField"
                    placeholder="Password"
                    required>

            <label for="showPassword">
            <input type="checkbox" id="showPassword" value="shown" onclick="displayPassword()">
                Show Password</label>
<br>
            <input type="password"
                    id="confirmPass"
                    name="confirmPass"
                    class="InputField"
                    placeholder="Confirm Password"
                    required>
<br><br>
            <button type="submit" class="InputField" name="CreateBtn" id="CreateBtn">
            Create Account</button>
            </form>
    <!-- ? Page Specific Contents END -->

    <?php include("Footer.php"); ?>
    
    </body>
</html>