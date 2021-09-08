<?php
session_start();
    include("Scripts/Script_Connection.php");

    //^ If the Admin is not logged in, the person accessing this page is redirected to the Login page
    if (!isset($_SESSION["Admin"])) {
        header("Location: Login.php");
    }

    $sqlPost = "SELECT RecipeID, Title, PublishDate FROM recipes 
    UNION SELECT ArticleID, Title, PublishDate FROM articles 
    UNION SELECT ClassID, Title, PublishDate FROM classes";
    $result = mysqli_query($con, $sqlPost);

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

    <body id="AdminPostManagerBody" class="ManagerBody">
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
        
        <!--? Admin - Article/Recipe Manager Contents -->
      <h1>Post Manager</h1>
      <table class="Manager" id="PostManager">
          <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Date</th>
              <th>Type <br>
                  <select name="PostManagerFilter" class="UserFilter" id="PostFilter" 
                  onchange="FilterManager()">
                      <option value="All" selected>All</option>
                      <option value="Recipes">Recipes</option>
                      <option value="Articles">Articles</option>
                      <option value="Classes">Classes</option>
                  </select> 
              </th>
              <th>Actions</th>
          </tr>
          
            <?php 
      //? SQL statement Selects the ID, Title and PublishDate from the recipes/articles/classes table
                while ($row = mysqli_fetch_assoc($result)) {
                    $ID = $row["RecipeID"];
                    $Title = $row["Title"];
                    $Date = $row["PublishDate"];

                    //? Depending on the ID, the post Type is determined
                    if ($ID[0] == "R") {
                        $Type = "Recipe";
                    } else if ($ID[0] == "A") {
                        $Type = "Article";
                    } else if ($ID[0] == "C") {
                        $Type = "Class";
                    }
                    //^ Table rows filled from database
                        //? AddBtn = Add New Post
                        //? EditBtn = Edit current post
                        //? DeleteBtn = Delete current post
                        // <input type="image" src="Images/AddPost.png" name="AddBtn" class="ManagePostBtn">
                    echo '<tr>
                        <td>'.$ID.'</td>
                        <td>'.$Title.'</td>
                        <td>'.$Date.'</td>
                        <td class="PostType">'.$Type.'</td>
                        <td class="ManagePostBtnRow"> 
                    
                        <a href="Admin - Add New Post.php">
                        <i class="fas fa-file-medical new"></i>
                        </a>

                        <a href="Admin - Edit Post '.$Type.'.php?PostID='.$ID.'">
                        <i class="fas fa-edit edit"></i>
                        </a>

                        <a href="Scripts/Script_DeletePost.php?PostID='.$ID.'&Table='.$Type.'">
                        <i class="fas fa-trash delete" onclick="Confirmation(\'Post\' ,\''.$ID.'\'); return false;"></i>
                        </a>
                        </td>
                        </tr>';
                        /* <input type="image" src="Images/Edit.png" name="EditBtn" class="ManagePostBtn">
                        <input type="image" src="Images/Delete.png" name="DeleteBtn" 
                        class="ManagePostBtn" onclick="Confirmation(\'Post\' ,\''.$ID.'\'); return false;"> */
                    }
            ?>
        </table>
        
      <!--? Page Specific Content END -->
      
       <!-- ^ Footer -->
  		<?php include("Footer.php"); ?>
    </body>   
</html>
