<?php 
session_start();
    $PostID = $_REQUEST["PostID"];
       
    include("Scripts/Script_Connection.php");

    //^ If the User is not logged in, the person accessing this page is redirected to the Login page
    if (!isset($_SESSION["Admin"])) {
        header("Location: Login.php");
    }

    $sqlLoadPost = "SELECT * FROM classes WHERE ClassID = '$PostID'";
    $result = mysqli_query($con, $sqlLoadPost);
    $row = mysqli_fetch_assoc($result);
        $Title = $row["Title"];
        $PublishDate = $row["PublishDate"];
        $Description = $row["Description"];
        $ClassID = $row["ClassID"];
        $Author = $row["Author"];
        $Ingredients = json_decode($row["Ingredients"], true);
        $VideoLink = $row["VideoLink"];
        $Tag = $row["Tags"];
        $Type = $row["Type"];

    $sqlTag = "SELECT * FROM tags";
    $resultTag = mysqli_query($con, $sqlTag);
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
        <title>Edit Class - <?php echo $Title; ?></title>
    </head>

    <body id="AdminAddNewPostBody" onload="CheckRadio('<?php echo $Tag; ?>Tag', '<?php echo $Type; ?>Tag')">

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
        <form id="NewPost" action="Scripts/Script_EditClass.php" method="POST">
        <div id="GeneralDetails">
<br>
            <!--^ Displays publish date of classes -->
            <label for="Date" id="PostDate">Publish Date:
                <input id="Date" type="Date" name="PublishDate" 
                value="<?php echo $PublishDate; ?>"></label>
<br>
            <!--^ ID of Class -->
            <label for="PostID">Class ID:
            <input id="PostID" type="text" name="PostID" value="<?php echo $ClassID; ?>" readonly></label>
<br> 
            <!--^ Title of Class -->
            <label for="PostTitle">Title:
            <input id="PostTitle" type="text" name="PostTitle" value="<?php echo $Title; ?>"></label>
<br>
<br>
            <!-- Images for the post --> 
            <!-- TODO Show image name if available -->
            <label for="PostImage">Please ensure that the image is named as per the Class Title!</label>
            <input id="PostImage" type="file" name="PostImage" form="UploadFrm">
            <button id="UploadBtn" type="submit" name="UploadBtn" form="UploadFrm">Upload</button>
            
<br>
            <!-- Hidden Input for POSTing Data-->
            <input type="hidden" id="ClassInput" name="ClassIng">
        </div>

        <div id="MainDetails">
                <!-- Recipe Steps -->
            <h1 id="PostHeader">Class Details</h1>                       
            <!--^ Tags for the post  -->
            <div id="RadioDiv">
            <fieldset id="Tags" class="RadioTags"> 
                <legend>Tags:</legend>
                <?php 
                    while ($rowT = mysqli_fetch_assoc($resultTag)) {
                        $TagName = $rowT["Name"];
                        $TagID = $rowT["TagID"];

                        echo '<label class="TagLbl" for="'.$TagID.'Tag"> 
                            <input id="'.$TagID.'Tag" type="radio" name="PostTags" value="'.$TagID.'">'.$TagName.'
                        </label><br>';
                    }
                ?>    
            </fieldset>  
<br>
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
                </div>
<br>
                <label for="VideoLink" id="VidLbl">Video Link :
            <input type="text" name="VideoLink" id="VideoLink" value="<?php echo $VideoLink; ?>"></label>
        
        <div id="AdditionalDetails">
            <!-- Recipe Description -->
        <label for="PostDesc">Description</label>
        <textarea name="Desc" id="PostDesc"><?php echo $Description; ?></textarea>
<br><br>
            <!-- Recipe Author -->
            <label for="ClassAuthor">Author
                <input id="ClassAuthor" type="text" placeholder="Author" 
                value="<?php echo $Author;?>" name="Author">
            </label>
<br><br>          
            <!-- Recipe Ingredients  -->
            <label for="RecipeIngredients">Recipe Ingredients
                <div id="RecipeIngredients">
                <input type="text" id="IngSectionName" placeholder="Section Name">
                    <button id="IngSection" type="button" onclick="AddSection('IngSection','IngredientList')">+ SECTION</button>
                    <!-- Input Ingredient Name -->
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
                        <ol id="IngredientList" ondblclick="deleteIngredient()"><?php
                               foreach($Ingredients as $IngType => $IngArray) {
                                echo '<h4>'.$IngArray[0].'</h4>';
                               for ($i=1; $i < count($IngArray); $i++) {
                                echo '<li>'.$IngArray[$i].'</li>';
                               }
                            }
                            ?></ol>  
                    </div>  
                </div>
            </label>

        </div>  

            <!--^ Buttons  -->
            <button id="PreviewBtn" type="submit" name="PreviewBtn" class="PostBtn" onclick="GetText('Classes')">Preview</button>
            <button id="SaveBtn" type="submit" name="SaveBtn" class="PostBtn" onclick="GetText('Classes')">Save</button>
            <!-- <button id="PublishBtn" type="submit" name="PublishBtn" class="PostBtn">Publish</button> -->
                
    </div>
    </form> 

    <form id="UploadFrm" method="POST" action="Admin - Edit Post Class.php" enctype="multipart/form-data">
    <input id="PostID" type="hidden" name="PostID" value="<?php echo $ClassID; ?>">
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
   $target_dir = "Images/Classes/";
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
      echo '<script>alert("Sorry, there was an error uploading your file!");</script>';
     }
   }
  }
?>

