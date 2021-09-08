<?php
session_start();
include("Scripts/Script_Connection.php");

//^ If the Admin is not logged in, the person accessing this page is redirected to the Login page
if (!isset($_SESSION["Admin"])) {
    header("Location: Login.php");
}

$sql = "SELECT * FROM subscription";
$result = mysqli_query($con, $sql);

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

    <body id="AdminPayManagerBody" Class="ManagerBody">
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
        <!--? Admin - Payment Manager Contents -->
        <h1>Payment Manager</h1>
      
        <table class="Manager" id="PayManager">
            <tr>
                <th>No.</th>
                <th>User ID</th>
                <th>Class ID</th>
                <th>Total Paid (RM)</th>
                <th>Action</th>
            </tr>
        
            <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    $UserID = $row["UserID"];
                    $ClassID = $row["ClassID"];
                    $Num = $row["Number"];

                    echo '<tr>
                        <td>'.$Num.'</td>
                        <td>'.$UserID.'
                        <input type="hidden" name="IdUser" value="'.$UserID.'"></td>
                        <td>'.$ClassID.'
                        <input type="hidden" name="IdClass" value="'.$ClassID.'"></td>
                        <td>20</td>
                        <td><a href="Scripts/Script_PayManager.php?IdUser='.$UserID.'&IdClass='.$ClassID.'">
                        <button type="submit" name="RefundBtn" class="ManagerButtons"
                        onclick="Confirmation(\'Refund\', \''.$Num.'\'); return false;">
                        Refund Purchase</button></a></td>
                        </tr>';
                }
            ?>
        </table>
      <!--? Page Specific Content END -->

    <!-- ^ Footer -->
  		<?php include("Footer.php"); ?>
    </body>   
</html>