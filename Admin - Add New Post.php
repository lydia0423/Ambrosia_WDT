<?php 
session_start();
$FolderName = $_POST["PostType"];  
include ("Scripts/Script_Connection.php");
    //^ If the Admin is not logged in, the person accessing this page is redirected to the Login page
if (!isset($_SESSION["Admin"])) {
        header("Location: Login.php");
    }
$sqlTags = "SELECT * FROM tags";
$result = mysqli_query($con, $sqlTags);
$resultR = mysqli_query($con, $sqlTags);

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
        <link rel="icon" href="Images/Logo/Ambrosia Logo.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="Ambrosia.js"></script>
        <title>New Post</title>
    </head>

    <body id="AdminAddNewPostBody" onload="PostTypeDisplay(); fillDate(); GetText('Type')">

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
        
        <!--? Admin - Add New Post Contents -->
        <form id="NewPost" action="Scripts/Script_NewPost.php" method="POST">
        <div id="GeneralDetails">
            <!--^ Displays current date for the posting of articles/recipes -->
<br>      
            <label for="Date" id="PostDate">Publish Date:
                <input id="Date" name="Date" type="Date" name="Date"></label>
              
<br>
            <!--^ Select type of post to be made -->
            <label for="PostType">Type:
                <select id="PostType" class="UserFilter" required 
                onchange="PostTypeDisplay(); GetText('Type')">
                    <option value="Articles">Article</option>
                    <option value="Recipes">Recipe</option>
                    <option value="Classes">Class</option>
                </select></label>
            <input type="hidden" name="PostType" id="PostTypeAddHidden">
<br> 
            <!--^ Title of Article/Recipe -->
            <label for="PostTitle">Title:
            <input id="PostTitle" type="text" name="PostTitle"></label>
<br>
            <!--^ Images for the post --> 
            <label for="PostImage">Please ensure that the image is named as per the Title of the post!</label>
            <input id="PostImage" type="file" name="PostImage" form="UploadFrm">
            <button id="UploadBtn" type="submit" name="UploadBtn" 
            form="UploadFrm" onclick="GetText('Type')">Upload</button>
            
<br>
            <!-- Hidden Input for POSTing Data-->
            <input type="hidden" id="StepInput" name="RecipeSteps">
            <input type="hidden" id="IngInput" name="RecipeIng"> 
            <input type="hidden" id="ContentInput" name="ContentInput">
            <input type="hidden" id="ClassInput" name="ClassInput">
        </div>

        </div>
<br>
        <div id="MainDetails">
            <h1 id="PostHeader">Article Content</h1>
            <button id="ArticleSection" type="button" class="SectionBtn" onclick="AddSection('', 'ArticleContent')">+ SECTION</button>
            <button id="RecipeSection" type="button" class="SectionBtn" onclick="AddSection('','RecipeContent')">+ SECTION</button>
            <input type="text" id="SectionName" placeholder="Section Name">
            
            <div id="ContentTagDiv">
<br>               
                <!-- Tags for Recipe/Articles -->
                <label id="TagsARLbl" for="TagsAR">Tags : <select name="PostTagsAR" id="TagsAR" class="UserFilter" required>
                    <option value="" disabled selected>Select a Tag</option>
                    <?php 
                    while ($row = mysqli_fetch_assoc($result)) {
                        $TagName = $row["Name"];
                        $TagID = $row["TagID"];
                        
                        echo '<option value="'.$TagID.'">'.$TagName.'</option>';
                    }
                    ?>
                </select></label>
<br>    
                <!-- Article Content uses bullet points -->
            <ul class="Content" id="ArticleContent" contenteditable="true"><li></li></ul>
                <!-- Recipe Content uses numbered list -->
            <ol class="Content" id="RecipeContent" contenteditable="true"><li></li></ol>
                </div>

            <!--^ Tags for the class  -->
            <div id="RadioDiv">
            <fieldset id="Tags" class="RadioTags"> 
                <legend>Tags:</legend>
                <?php 
                    while ($rowRadio = mysqli_fetch_assoc($resultR)) {
                        $TagNameR = $rowRadio["Name"];
                        $TagIDR = $rowRadio["TagID"];

                        echo '<label class="TagLbl" for="'.$TagNameR.'Tag"> 
                            <input id="'.$TagNameR.'Tag" type="radio" name="PostTags" value="'.$TagIDR.'">'.$TagNameR.'
                        </label><br>';
                    }
                ?>
            </fieldset>  
<br>
            <!-- Class Type Selection -->
            <fieldset id="TypeTag" class="RadioTags"> 
                <legend>Type:</legend>
                <label for="PaidTag">
                    <input id="PaidTag" type="radio" name="ClassType" value="Paid">Paid       
                </label><br>
                <label for="FreeTag">
                    <input id="FreeTag" type="radio" name="ClassType" value="Free">Free
                </label><br>
                <label for="UpcomingTag">
                    <input id="UpcomingTag" type="radio" name="ClassType" value="Upcoming">Upcoming 
                </label>     
            </fieldset>   
<br>            <!--Input field for the class video link -->
            <label for="VideoLink" id="VidLbl">Video Link :
                <input type="text" name="VideoLink" id="VideoLink"></label>
            </div>
                
                <div id="AdditionalDetails">
                    <!-- Recipe Description -->
                    <label for="PostDesc">Description</label>
                    <textarea name="Desc" id="PostDesc"></textarea>
                    <br><br>
                    <!-- ^ Author -->
                    <label for="Author">Author:
                        <input id="Author" name="Author" type="text" placeholder="Author">
                    </label>
                    <br>
                    
                    <br>            
                    <!--^ Recipe Ingredients  -->
                    <label for="RecipeIngredients" id="IngLbl">Recipe Ingredients
                    <div id="RecipeIngredients">
<br>
                    <input type="text" id="IngSectionName" placeholder="Section Name">
                    <button id="IngSection" type="button" onclick="AddSection('IngSection','IngredientList')">+ SECTION</button>
                         
                    <!-- Input Ingredients here-->
                    <input id="Ingredients" type="text" placeholder="Ingredient"> 
                    
                    <!-- Input number of ingredients-->
                    <input id="IngredientsNo"type="number" placeholder="0"> 
                    
                    <!-- Input unit of ingredients-->
                    <select name="IngredientsUnit" id="IngredientsUnit"> 
                        <option value="g">g</option>
                        <option value="ml">ml</option>
                        <option value="cups">cups</option>
                        <option value="tbsp">tbsp</option>
                        <option value="tsp">tsp</option>
                        <option value="pieces">pieces</option>
                    </select>
                    
                    <!-- Click this to add the ingredients into the list -->
                    <button id="AddIngBtn" type="button" onclick="AddIngredient()"></button>

                    <!-- List of ingredients used in the recipe. 
                    Added dynamically through JS from input elements above. -->
                    <div id="IList">
                        <ol id="IngredientList" ondblclick="deleteIngredient()"></ol>  
                    </div>  
                    </div>
            </label>

        </div>  
 
            <!--^ Buttons  -->
            <button id="PreviewBtn" type="submit" name="PreviewBtn" class="PostBtn" 
                onclick="GetText('All')">Preview</button>
            <button id="SaveBtn" type="submit" name="SaveBtn" class="PostBtn" 
                onclick="GetText('All')">Save</button>
          
                  
        </div>
        </form> 
        <!-- Form that handles uploading images -->
        <form id="UploadFrm" method="POST" action="Admin - Add New Post.php" enctype="multipart/form-data">
    <input id="PostTypeHidden" type="hidden" name="PostType">
      </form>
  
     <!--? Page Specific Content END -->

        <!-- ^ Footer -->
  		<?php include("Footer.php"); ?>
    </body>   
</html>


//^ Upload Image Script
<?php 
if (isset($_POST["UploadBtn"])){
    //? target_dir = Folder where the image file will be uploaded
   $target_dir = "Images/$FolderName/";
    //? Path of file to be uploaded
   $target_file = $target_dir . basename($_FILES["PostImage"]["name"]);
   $uploadOk = 1; //? Check for Upload success
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //? File type extension

   // Check if file already exists
   if (file_exists($target_file)) {
       $UploadError = "The image already exists!";
       $uploadOk = 0;
    }
   
   // Check file size
   if ($_FILES["PostImage"]["size"] > 500000) {
    $UploadError = "The image is too big!";
     $uploadOk = 0;
   }
   
   // Allow certain file formats
   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $UploadError = "Only jpg/png/jpeg file types are accepted!";
     $uploadOk = 0;
   }
   
   // Check if $uploadOk is set to 0 by an error
   if ($uploadOk == 0) {
    echo '<script>alert("Sorry, your file was not uploaded!" + " '.$UploadError.'");</script>';
   // if everything is ok, try to upload file
   } else {
     if (move_uploaded_file($_FILES["PostImage"]["tmp_name"], $target_file)) {
       echo '<script>alert("The image '.basename($_FILES["PostImage"]["name"]).' has been uploaded");</script>';
     } else {
        echo '<script>alert("Sorry, your file was not uploaded!");</script>';
     }
   }
  }
?>

