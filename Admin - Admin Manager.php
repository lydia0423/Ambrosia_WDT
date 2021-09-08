<?php 
session_start();
    include("Scripts/Script_Connection.php");

    //^ If the Admin is not logged in, the person accessing this page is redirected to the Login page
    if (!isset($_SESSION["Admin"])) {
        header("Location: Login.php");
    }

    $sqlAdmin = "SELECT AdminID, Username FROM admin";
    $result = mysqli_query($con, $sqlAdmin);
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
        <h1>Admin Manager</h1>
        <div id="ManagerBtnDiv">
            <!-- ?? Creates spacing problems when not present To be reviewed -->      
        </div>
<form id="AddAdmin" method="POST" action="Scripts/Script_AdminManager.php">
        
        <table class="Manager" id="UserManager">
            <tr>
                <th>Admin ID</th>
                <th>Username</th>
                <th>Action</th>
             </tr>
            <!-- Table rows are initialised based on database -->
            <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    $AdminID = $row["AdminID"];
                    $Username = $row["Username"];
                    
                    echo '<tr>
                   
                        <td>' . $AdminID .'
                        <input type="hidden" name="ID" id="ID" value="'.$AdminID.'">
                        </td>
                        <td class="Name">' . $Username . '</td>
                         <td>
                       
                            <i class="fas fa-user-plus new" onclick="AdminSubmit()"></i>
                                   
                            <a href="Scripts/Script_DeleteAdmin.php?AdminID='.$AdminID.'">
                            <i class="fas fa-trash delete" 
                            onclick="Confirmation(\'Admin\' ,\''.$Username.'\'); 
                            return false;"></i></a>
                         </td>
                        </tr>';               
                }
            ?>
        </table>
        <input type="hidden" id="HiddenUsername" name="HiddenUsername">
        <input type="hidden" id="HiddenPassword" name="HiddenPassword">
 </form>         
      <!--? Page Specific Content END -->

        <!-- ^ Footer -->
  		<?php include("Footer.php"); ?>
    </body>   
</html>