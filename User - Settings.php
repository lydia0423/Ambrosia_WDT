<?php
session_start();
/* if (empty($_SESSION["Theme"])) {
 $_SESSION["Theme"] = "Ambrosia.css"; //^ should be set at home page
 header("refresh:0"); } */
 
 include("Scripts/Script_LoadSettings.php");
     //^ If the User is not logged in, the person accessing this page is redirected to the Login page
     if (!isset($UserID)) {
        header("Location: Login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link id="Theme" rel="stylesheet" type="text/css"
        href="<?php echo $_SESSION["Theme"]; ?>">
            <!-- Font Awesome-->
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">	
        <!-- Google Fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet">
            <!-- Icon -->
    <link rel="icon" href="Images/Logo/Ambrosia Logo.ico">
        <script src="Ambrosia.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $_SESSION["Username"]; ?> - Settings</title>
    </head>

    <body id="UserSettingsBody"  onload="Subscription(); Theme('<?php echo $Theme; ?>')">
            <?php include("Header.php"); ?>

           <!--^ Sidemenu -->
           <button id="SideMenuBtn" onclick="SideMenu()"></button>
           <div id="SideMenu" class="ToggleMenu">
               <ul>
                   <li><a href="User - Bookmarks.php">Bookmarks</a></li><hr>
                   <li><a href="User - Classes.php">Classes</a></li><hr>
                   <li><a href="User - Settings.php">Settings</a></li> 
                </ul>
           </div>

           <!--? User - Settings Page Contents -->
            <h1 id="SettingsHeader">Settings</h1>
<form id="UserSettings" method="POST" action="Scripts/Script_SaveSettings.php">

                <!-- Profile -->
        <div id="ProfileDiv" class="SettingsDiv">
                    <h2>Profile</h2>
                     <label class="Label" for="FullName">Full Name:</label>
                     <input class="Box" id="FullName" type="text" name="FullName"
                     value="<?php echo $FullName; ?>">
<br><br>    
                     <label class="Label" for="Email">Email:</label>
                     <input class="Box" id="Email" type="email" name="Email"
                     value="<?php echo $Email; ?>">
<br><br>
                     <label class="Label" for="PhoneNo">Phone Number:</label>
                     <input class="Box" id="PhoneNo" type="text" name="PhoneNo"
                     value="<?php echo $PhoneNum; ?>">
<br><br>
                     <label class="Label" for="Address">Address:</label>
                     <textarea class="Box" name="Address" id="Address"><?php echo $Address; ?>
                     </textarea>
<br><br>
                     <label class="Label" for="CardNo">Card Number:</label>
                     <input class="Box" id="CardNo" type="number" name="CardNo"
                     value="<?php echo $CardNum; ?>">

                </div>
            
            <!-- Security Questions -->
                <div class="SettingsDiv">
                    <h2>Security Questions</h2>
                     <Label for="SecurityQ" class="Label">Security Question:</Label>
                     <select class="Box" name="SecurityQ" id="SecurityQ" required>
                        <option value="0" 
                        <?php if($SecurityQ == 0) {echo 'selected="selected"';} ?>>
                        Please set a security question</option>

                        <option value="1" 
                        <?php if($SecurityQ == 1) {echo 'selected="selected"';} ?>>
                        What is your pet's name?</option>

                        <option value="2"
                        <?php if($SecurityQ == 2) {echo 'selected="selected"';} ?>>
                        What is your favourite book?</option>

                        <option value="3"
                        <?php if($SecurityQ == 3) {echo 'selected="selected"';} ?>>
                        Which school/institute of higher education did you attend?</option>
                     </select>
<br><br>
                    <label for="SecurityA" class="Label">Answer:</label>
                    <input type="text" placeholder="Answer" name="SecurityA" id="SecurityA"
                   class="Box" value="<?php echo $SecurityA; ?>"><br>
                </div>

           <!-- TODO Change Password functionality -->
                <div class="SettingsDiv">
                    <h2>Change Password</h2>
                     <label for="CurrentPassword" class="Label">Current password:</label>
                     <input type="password" class="Box" placeholder="Enter current password" 
                     name="CurrentPassword">
<br><br>
                    <label for="NewPassword" class="Label">New password:</label>
                    <input type="password" class="Box" placeholder="Enter new pasword" 
                            name="NewPassword">
<br><br>
                    <label for="ConfirmNew" class="Label">Confirm new password:</label>
                    <input type="password" class="Box" placeholder="Confirm new password"
                            name="ConfirmNew">
                </div>

                <!-- TODO Newsletters functionality?? -->
                <div class="SettingsDiv">
                    <h2>Newsletter</h2>
                    <label for="NewsletterSub">
                        <input type="checkbox" name="NewsletterSub" id="NewsletterSub" 
                        onclick="Subscription()"
                        <?php if($Newsletter == 1) {echo "checked";} ?>>
                        Would you like to receive newsletters from us?</label>

                    <p>Which topics would you like to hear about?</p>
                    <label for="UpcomingClasses">
                        <input type="checkbox" name="UpcomingClasses" id="UpcomingClasses" disabled>
                        Upcoming Classes
                    </label><br>

                    <label for="NewRecipes">
                        <input type="checkbox" name="NewRecipes" id="NewRecipes" disabled>
                        New Recipes
                    </label><br>

                    <label for="NewArticles">
                        <input type="checkbox" name="NewArticles" id="NewArticles" disabled>
                        New Articles
                    </label>
                </div>

                <!-- Theme Settings for the website -->
                <div class="SettingsDiv" id="ThemeDiv">
                    <h2>Dark Mode</h2>
                    <label id="LblDark" for="EnableDarkMode">
                        <input type="checkbox" name="EnableDarkMode" id="EnableDarkMode" 
                        value="Enabled">
                        Enable
                    </label>
                    <label id="LblLight" for="EnableLightMode">
                        <input type="checkbox" name="EnableLightMode" id="EnableLightMode" 
                        value="Disabled">
                        Disable
                    </label>
                </div>
                <button type="submit" id="SaveSettingsBtn" name="SaveSettingsBtn">Save Settings</button>
</form>

           <!-- ? Page Specific Content END -->

            <?php include("Footer.php"); ?>
        
    </body>   
</html>
