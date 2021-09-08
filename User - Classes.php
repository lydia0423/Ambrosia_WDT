<?php
session_start();
    include("Scripts/Script_Connection.php");
    $UserID = $_SESSION["UserID"];

    //^ If the User is not logged in, the person accessing this page is redirected to the Login page
    if (!isset($UserID)) {
        header("Location: Login.php");
    }

    //^ Displays only relevant tags (to the user)
    $sqlTag = "SELECT DISTINCT classes.Tags, tags.Name FROM classes INNER JOIN subscription USING (ClassID)
     INNER JOIN tags ON classes.Tags = tags.TagID WHERE subscription.UserID = '$UserID'";
     $resultT = mysqli_query($con, $sqlTag);
     $resultTag = mysqli_query($con, $sqlTag);
     
     while ($rowT = mysqli_fetch_assoc($resultTag)) {
         $Array[] = $rowT["Tags"];
        }
        $TagArray = implode($Array, ",");
        
    //^ Retrieve subscription details from Database
	 $sqlSubscription = "SELECT * FROM subscription INNER JOIN classes USING (ClassID) 
    WHERE UserID = '$UserID'";
    $result = mysqli_query($con, $sqlSubscription);
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
        <title><?php echo $_SESSION["Username"];?> - Classes</title>
    </head>

    <body class="UserBody">
	   <!-- Header -->
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

        <!--? User - Class Page Content -->
        <div class="UserHeader">
            <h1>Classes</h1>
          
            <select class="UserFilter" name="ClassFilter" id="ClassFilter" 
            onchange="UserClassFilter('<?php echo $TagArray; ?>')">
                <option value="All">All</option>
                <?php 
                    while ($rowTag = mysqli_fetch_assoc($resultT)) {
                        echo '<option value="'.$rowTag["Tags"].'">'.$rowTag["Name"].'</option>';
                    }
                ?>
            </select>
        </div>
        
        <div class="UserDiv">
            <h2 id="ErrorMsg">No Classes purchased yet.</h2>
            <?php 
            //? If there are no Class, display a message
            if(mysqli_affected_rows($con) == 0) {
                echo '<script>
                document.getElementById("ErrorMsg").style.display = "block"; </script>';
            } else {
            //? Else, display purchased Classes
            while ($row = mysqli_fetch_assoc($result)) {
                $ClassTitle = $row["Title"];
                $ClassID = $row["ClassID"];
                $Description = $row["Description"];
                $Author = $row["Author"];
                $PublishDate = $row["PublishDate"];
                $Tag = $row["Tags"];
                include("Scripts/Script_Subscription.php");
            }
          }
            ?>
          </div>

        <!--? Page specific Content END -->
        
	  <?php include("Footer.php"); ?>
		
    </body>   
</html>