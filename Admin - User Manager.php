<?php 
session_start();
    include("Scripts/Script_Connection.php");

    //^ If the User is not logged in, the person accessing this page is redirected to the Login page
    if (!isset($_SESSION["Admin"])) {
        header("Location: Login.php");
    }

    $sqlUser = "SELECT UserID, Username, Email FROM user_account";
    $result = mysqli_query($con, $sqlUser);
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
        <title>Ambrosia Admin</title>
    </head>

    <body id="AdminUserManagerBody" Class="ManagerBody">
        <?php include("Header.php"); ?>

        <!-- ^ SideMenu for Admin -->
        <button id="SideMenuBtn" onclick="SideMenu()"></button>
        <div id="SideMenu" class="ToggleMenu">
            <ul>
                <li><a href="Admin - User Manager.php">User Manager</a></li><hr>
                <li><a href="Admin - Admin Manager.php">Admin Manager</a></li><hr>
                <li><a href="Admin - Post Manager.php">Post Manager</a></li> <hr>
                <li><a href="Admin - Payment Manager.php">Payment Manager</a></li><hr>  
                <li><a href="Admin - Tag Manager.php">Tag Manager</a></li>  
                  </ul>
        </div>
        
        <!--? Admin - User Manager Contents -->
        <h1>User Manager</h1>
        <div id="ManagerBtnDiv">
            <!-- ?? Creates spacing problems when not present To be reviewed -->      
        </div>
<form id="DeleteUser" method="POST" action="Scripts/Script_UserManager.php">
        
        <table class="Manager" id="UserManager">
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
             </tr>
            <!-- Table rows are initialilised based on database -->
            <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    $UserID = $row["UserID"];
                    $Usernames = $row["Username"];
                    $Email = $row["Email"];
                    
                    echo '<tr>
                    <!-- Hidden input to hold UserID to POST to Scripts/Script_UserAccount.php -->
                        <td>' . $UserID .'
                        <input type="hidden" name="ID" id="ID" value="'.$UserID.'">
                        </td>
                        <td>' . $Usernames . '</td>
                        <td>' . $Email     . '</td>
                        <td><button type="submit" id="DeleteUserBtn" name="DeleteUserBtn" 
                        class="ManagerButtons" 
                        onclick="Confirmation(\'Users\',\''.$UserID.'\'); return false;">
                        Delete User</button></td>
                        </tr>';               
                }
            ?>
        </table>
 </form>         
      <!--? Page Specific Content END -->

        <!-- ^ Footer -->
  		<?php include("Footer.php"); ?>
    </body>   
</html>