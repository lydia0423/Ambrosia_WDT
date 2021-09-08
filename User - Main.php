<?php
session_start();
	include("Scripts/Script_Connection.php");
    $UserID = $_SESSION["UserID"];

    //^ If the User is not logged in, the person accessing this page is redirected to the Login page
    if (!isset($UserID)) {
        header("Location: Login.php");
    }
    
    //^ Load most recent class puchased
	$sqlLoadClass = "SELECT * FROM subscription INNER JOIN classes USING (ClassID) 
	WHERE UserID = '$UserID' ORDER BY Number DESC LIMIT 1";
    $ResultC = mysqli_query($con, $sqlLoadClass);
    $rowReturnC = mysqli_affected_rows($con);
	$RecentClass = mysqli_fetch_assoc($ResultC);
    $ClassVideo = $RecentClass["VideoLink"];
    $ClassID = $RecentClass["ClassID"];
    $ClassLink = "http://localhost:8080/Assignment/Scripts/Script_ClassPost.php?Classes=".$ClassID;
    
    
    //^ Load most recent bookmarks from database - 2 each for Articles/Recipes
    $sqlLoadBookmarksR = "SELECT * From bookmarks INNER JOIN recipes USING (RecipeID) 
    WHERE UserID = '$UserID' ORDER BY NUMBER DESC LIMIT 2";
    $resultR = mysqli_query($con, $sqlLoadBookmarksR);
    $RowReturnR = mysqli_affected_rows($con);
    $sqlLoadBookmarksA = "SELECT * From bookmarks INNER JOIN articles USING (ArticleID) 
    WHERE UserID = '$UserID' ORDER BY NUMBER DESC LIMIT 2";
    $resultA = mysqli_query($con, $sqlLoadBookmarksA);
    $RowReturnA = mysqli_affected_rows($con);
    

?>

<!DOCTYPE html>
<html>
    <head>
        <link id="Theme" rel="stylesheet" type="text/css"
        href="<?php echo $_SESSION["Theme"]; ?>">
            <!-- Font Awesome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">	
            <!-- Google Fonts-->
        <link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet">
            <!-- Icon -->
        <link rel="icon" href="Images/Logo/Ambrosia Logo.ico">
        <script src="Ambrosia.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
    </head>

    <body id="UserMainBody">
        <?php include("Header.php"); ?>

        <button id="SideMenuBtn" onclick="SideMenu()"></button>
        <div id="SideMenu" class="ToggleMenu">
            <ul>
                <li><a href="User - Bookmarks.php">Bookmarks</a></li><hr>
				<li><a href="User - Classes.php">Classes</a></li><hr>
                <li><a href="User - Settings.php">Settings</a></li> 
            </ul>
        </div>
        
        <!--? User - Main Page Contents -->
        <div id="RecentClass">
        <h1><a href="<?php echo $ClassLink; ?>">Most Recent Class</a></h1>
            <!-- ^ YouTube Video Placeholder for Class -->
            <iframe id="ClassVideo" src="<?php echo $ClassVideo; ?>" 
                frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; 
                picture-in-picture" allowfullscreen></iframe>
            <h3 id="ClassMsg">No classes purchased yet</h3>
       <?php
            if($rowReturnC == 0) {
                echo '<script>document.getElementById("ClassMsg").style.display="block";</script>';
            }
       ?>
      </div>

      <div id="RecentBookmarks">    
<hr> 
        <h2><a href="User - Bookmarks.php">Recent Bookmarks</a></h2> 
<hr>
        <div>
        <h3 id="InfoMsg">No bookmarks yet.</h3>

          <?php 
            if ($RowReturnA == 0 && $RowReturnR == 0) {
                echo '<script>document.getElementById("InfoMsg").style.display="block";</script>';
             } else {
            while ($rowR = mysqli_fetch_assoc($resultR)) {
                $RecipeTitle = $rowR["Title"];
                $RecipeID = $rowR["RecipeID"];
                $Description = $rowR["Description"];
                $Author = $rowR["Author"];
                $PublishDate = $rowR["PublishDate"];
                include("Scripts/Script_BookmarksRecipe.php");
            }

            while ($rowA = mysqli_fetch_assoc($resultA)) {
                $ATitle = $rowA["Title"];
                $ArticleID = $rowA["ArticleID"];
                $ADescription = $rowA["Description"];
                $AAuthor = $rowA["Author"];
                $APublishDate = $rowA["PublishDate"];
                include("Scripts/Script_BookmarksArticle.php");
            }}
          ?>
        </div>
      </div>
      <!--? Page Specific Content END -->

        <!-- ^ Footer -->
  		<?php  include("Footer.php"); ?>
    </body>   
</html>