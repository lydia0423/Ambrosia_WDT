<?php 
session_start();
    $PostID = $_REQUEST["PostID"];

    include("Scripts/Script_Connection.php");

    //^ If the User is not logged in, the person accessing this page is redirected to the Login page
    if (!isset($_SESSION["Admin"])) {
        header("Location: Login.php");
    }

    $sqlLoadPost = "SELECT * FROM articles WHERE ArticleID = '$PostID'";
    $result = mysqli_query($con, $sqlLoadPost);
    $row = mysqli_fetch_assoc($result);
    $ArticleID = $row["ArticleID"];
    $Title = $row["Title"];
    $Description = $row["Description"];
    $Author = $row["Author"];
    $PublishDate = $row["PublishDate"];
    $Content = json_decode($row["Content"], true);
    $Tag = $row["Tags"];

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
        <link rel="icon" href="Images/Logo/Ambrosia Logo.ico">
        <script src="Ambrosia.js"></script>  

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
        <title>Edit Article</title>
    </head>

    <body id="AdminAddNewPostBody" onload="SelectTag('<?php echo $Tag; ?>')">

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
        <form id="NewPost" action="Scripts/Script_EditArticle.php" method="POST">
        <div id="GeneralDetails">
             <!--^ Displays publish date of articles/recipes -->
<br>      
             <label for="Date" id="PostDate">Publish Date:
                <input id="Date" type="Date" name="PublishDate" 
                value="<?php echo $PublishDate; ?>"></label>
<br>
            <!-- Article ID -->
            <label for="PostID">Article ID:
            <input type="text" id="PostID" name="PostID" value="<?php echo $ArticleID; ?>" readonly></label>
<br><br>
            <!--^ Title of Article -->
            <label for="PostTitle">Title:
            <input id="PostTitle" type="text" name="PostTitle" value="<?php echo $Title;?>"></label>
<br>
            <!-- Images for the post --> 
            <!-- TODO Show image name if available -->
            <label for="PostImage">Please ensure that the image is named as per the Article Title!</label>
            <input id="PostImage" type="file" name="PostImage" form="UploadFrm">
            <button id="UploadBtn" type="submit" name="UploadBtn" form="UploadFrm">Upload</button>
            
<br>
            <!-- Hidden Input for POSTing Data-->
            <input type="hidden" id="ContentInput" name="ContentInput" onclick="GetText('Article')">
        </div>

        <div id="MainDetails">
                <!-- Recipe Steps -->
            <h1 id="PostHeader">Article Content</h1>
             <div id="ContentTagDiv">
            <label id="TagsARLbl" for="TagsAR">Tags : <select name="PostTagsAR" id="TagsAR" class="UserFilter" required>
                    <option value="" disabled selected>Select a Tag</option>
                    <?php 
                    while ($rowT = mysqli_fetch_assoc($resultTag)) {
                        $TagName = $rowT["Name"];
                        $TagID = $rowT["TagID"];
                        
                        echo '<option id="'.$TagID.'" value="'.$TagID.'">'.$TagName.'</option>';
                    }
                    ?>
                </select></label>
                
            <div class="SectionBtnDiv">
                <input type="text" id="SectionNameEdit" placeholder="Section Name">
            <button id="ArticleSectionEdit" type="button" class="SectionBtnEdit" onclick="AddSection('ArticleSectionEdit','ArticleContent')">+ SECTION</button>
            </div>
                <ul class="Content" id="ArticleContent" contenteditable="true"><?php              
                        foreach($Content as $Section => $ContentArray) {
                            echo '<h4>'.$ContentArray[0].'</h4>';
                            for ($i=1; $i < count($ContentArray); $i++) {
                                //^ Replaces the unicode encoding
                        // $Decode = str_replace("u0027", "'", $ContentArray);
                            $Decode = Decode($ContentArray);
                            echo '<li>'.$Decode[$i].'</li>';
                        } }
                ?></ul></div>
<br>
        <div id="AdditionalDetails">
            <!-- Recipe Description -->
        <label for="PostDesc">Description</label>
        <textarea name="Desc" id="PostDesc"><?php echo $Description; ?></textarea>
<br><br>
            <!-- Article Author -->
            <label for="ArticleAuthor">Author
                <input id="ArticleAuthor" type="text" placeholder="Author" 
                value="<?php echo $Author;?>" name="Author">
            </label>
<br><br>          
           
        </div>  
            <!--^ Buttons  -->
            <button id="PreviewBtn" type="submit" name="PreviewBtn" class="PostBtn" onclick="GetText('Articles')">Preview</button>
            <button id="SaveBtn" type="submit" name="SaveBtn" class="PostBtn" onclick="GetText('Articles')">Save</button>
            <!-- <button id="PublishBtn" type="submit" name="PublishBtn" class="PostBtn">Publish</button> -->
</div>
</form> 

<form id="UploadFrm" method="POST" action="Admin - Edit Post Article.php" enctype="multipart/form-data">
    <input id="PostID" type="hidden" name="PostID" value="<?php echo $ArticleID; ?>">
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
   $target_dir = "Images/Articles/";
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

