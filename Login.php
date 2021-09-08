<?php
session_start();
    if($_SESSION["State"] == "") {
    $_SESSION["State"] = "Cancelled";
    header("Refresh:0");
    }
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
        <title>Ambrosia</title>
    </head>
    <body id="LoginBody" onload="ForgotPass('<?php echo $_SESSION['State']; ?>')">
        <?php include("Header.php"); ?>

<!--? Login Page Contents -->

        <form id="LoginPanel" class="AccountPanel" method="post" action="Scripts/Script_LoginVerification.php"> 
            <!--^ Login Panel -->
            <div class="login-wrapper">
            <h1 class="LoginHeader">Sign In</h1>
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
            <button type="submit" form="CheckUser" name="ForgotFuncBtn"
            class="HiddenBtn">Forgot Password?</button>
            
            <button id="LoginBtn" type="submit" class="InputField" name="LoginBtn">Login</button>
            
            <a id="CreateAccountBtn" href="Create Account.php" class="HiddenBtn">
            No account? Sign up now!</a>
            </form>

            <!-- Forgot Password -->
    <form id="CheckUser" method="POST" action="Scripts/Script_ForgotUsername.php"> 
    <div id=Forgot-Username class="Forgot">
<br>
        <label for="UsernameF">Username:</label>
        <input type="text" 
                id="UsernameF"
                name="UsernameF"
                class="InputField"
                placeholder="Username"> 
<br>
                <button type="submit" name="Forgot-UserBtn" class="ForgotBtn">Next</button>
                <button type="submit" class="CancelBtn" name="CancelBtn">X</button>
    </div></form>

    <!-- To verify the user -->
    <form method="POST" action="Scripts/Script_ForgotQuestion.php">
    <div id="Forgot-Security" class="Forgot">
    <b><?php echo $_SESSION["SecurityQ"]; ?></b>
    <br>  
        <label for="SecurityA">Answer:</label>
                <input type="text" placeholder="Enter your answer" name="SecurityA" id="SecurityA"> 
    <br>                  
        <button type="Submit" name="Forgot-SecurityBtn" class="ForgotBtn" 
        >Next</button>
        <button type="submit" class="CancelBtn" name="CancelBtn">X</button>
    </div> </form>

    <!-- To reset the password of the verified User -->
    <form method="POST" action="Scripts/Script_ForgotPassword.php">
    <div id="Forgot-Password" class="Forgot">
            <label for="NewPassword" class="Label" id="LblF">New password:</label>
            <input type="password" placeholder="Enter new pasword" 
                name="NewPassword" >
    <br>
            <label for="ConfirmNew">Confirm new password:</label>
            <input type="password" placeholder="Confirm new password"
                name="ConfirmNew">
    <br>
                <button type="Submit" name="Forgot-PasswordBtn" class="ForgotBtn">Submit</button>
                <button type="submit" class="CancelBtn" name="CancelBtn">X</button>
    </div>
    </form>
        <!-- ? Page Specific Contents END -->

    <!-- ^ Footer -->
    <?php include("Footer.php");?>
    
    </body>
</html>