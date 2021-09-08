<?php 
    
    include("Script_Connection.php");

    //^ Save Edits when Save button is clicked
    if (isset($_POST["SaveBtn"]) || isset($_POST["PreviewBtn"])) {
        //^ Data collection
      $ArticleID = $_POST["PostID"];
      $Title = mysqli_real_escape_string($con, $_POST["PostTitle"]);
      $Desc = mysqli_real_escape_string($con, $_POST["Desc"]);
      $Author = mysqli_real_escape_string($con, $_POST["Author"]);
      $ArticleContent = $_POST["ContentInput"];
      $Date = $_POST["PublishDate"];
      $Tag = $_POST["PostTagsAR"];

        function ArrayThis($Input) {

            $RemoveTags = str_replace(["<h4>", "</h4>", "<li>", "</li>"], ["*", "", "|", ""], $Input);
            $RemoveFront = ltrim($RemoveTags, "*");
            $ExplodeArray = explode("*", $RemoveFront);
                foreach ($ExplodeArray as $NextLevel) {
                    $MultiArray[] = explode("|", $NextLevel);
                }
            return json_encode($MultiArray, JSON_HEX_APOS);
        }

        $ContentJson = ArrayThis($ArticleContent);
   
        //^ Update the Database and return to Post Manager
        $sql = "UPDATE articles SET Title = '$Title', Description = '$Desc', Content = '$ContentJson', 
        Author = '$Author', PublishDate = '$Date', Tags = '$Tag' WHERE ArticleID = '$ArticleID'";  
        // mysqli_query($con, $sql);
        if (!mysqli_query($con, $sql)) {
            echo mysqli_error($con);
        }
        
        //? If the preview button was clicked, redirect to the Recipe page
        // ! No way to navigate back ATM
        if (isset($_POST["PreviewBtn"])) {
            echo '<script>window.location.href="Script_ArticlePost.php?Article='.$ArticleID.'";</script>';
        } else { //? Else, back to Post Manager
            echo '<script>window.location.href="../Admin - Post Manager.php"; 
            alert("Changes to '.$ArticleID.' has been saved");</script>'; 
        }
    } 

?>