<?php
session_start();
    include("Scripts/Script_Connection.php");
    $UserID = $_SESSION["UserID"];

    //^ If the User is not logged in, the person accessing this page is redirected to the Login page
    if (!isset($UserID)) {
        header("Location: Login.php");
    }

	 //^ Retrieve recipe details from Database
    $sqlBookmarkR = "SELECT * FROM bookmarks INNER JOIN recipes USING (RecipeID) 
    WHERE UserID = '$UserID'";
    $result = mysqli_query($con, $sqlBookmarkR);
    $rowReturnR = mysqli_affected_rows($con);
    //^ Retrieve article details from Database
    $sqlBookmarkA = "SELECT * FROM bookmarks INNER JOIN articles USING (ArticleID) 
    WHERE UserID = '$UserID'";
    $resultA = mysqli_query($con, $sqlBookmarkA);
    $rowReturnA = mysqli_affected_rows($con);
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
        <!--? User - Bookmarks Page Content -->
        <div class="UserHeader">
            <h1>Bookmarks</h1>

            <select class="UserFilter" id="BookmarkFilter" name="BookmarkFilter" onchange="UserFilter('BookmarkFilter')">
                <option value="All">All</option>
                <option value="Articles">Articles</option>
                <option value="Recipes">Recipes</option>
            </select>
        </div>
        
        <div class="UserDiv">
            <h2 id="ErrorMsg">No bookmarks yet.</h2>
            <?php 
            //? If there are no bookmarks, display a message
            if($rowReturnA == 0 && $rowReturnR == 0) {
                echo '<script>
                document.getElementById("ErrorMsg").style.display = "block"; </script>';
            } else {
            //? Else, display stored bookmarks
            //^ Recipes
            while ($row = mysqli_fetch_assoc($result)) {
                $RecipeTitle = $row["Title"];
                $RecipeID = $row["RecipeID"];
                $Description = $row["Description"];
                $Author = $row["Author"];
                $PublishDate = $row["PublishDate"];
                include("Scripts/Script_BookmarksRecipe.php");
            }
            //^ Articles
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
        <!--? Page specific Content END -->
        
	  <?php include("Footer.php"); ?>
		
    </body>   
</html>