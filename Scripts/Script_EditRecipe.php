<?php 
    
    include("Script_Connection.php");

    //^ Save Edits when Save button is clicked
    if (isset($_POST["SaveBtn"]) || isset($_POST["PreviewBtn"])) {
        //^ Data collection
      $RecipeID = $_POST["PostID"];
      $Title = mysqli_real_escape_string($con, $_POST["PostTitle"]);
      $Desc = mysqli_real_escape_string($con, $_POST["Desc"]);
      $Author = mysqli_real_escape_string($con, $_POST["Author"]);
      $Step = mysqli_real_escape_string($con, $_POST["RecipeSteps"]);
      $Ing = mysqli_real_escape_string($con, $_POST["RecipeIng"]);
      $Date = $_POST["PublishDate"];
      $Tag = $_POST["PostTagsAR"];

       //? Converts the created array into a JSON for the database
      function ArrayThis($Input) {

        $RemoveTags = str_replace(["<h4>", "</h4>", "<li>", "</li>"], ["*", "", "|", ""], $Input);
        $RemoveFront = ltrim($RemoveTags, "*");
        $ExplodeArray = explode("*", $RemoveFront);
            foreach ($ExplodeArray as $NextLevel) {
                $MultiArray[] = explode("|", $NextLevel);
            }
        return json_encode($MultiArray, JSON_HEX_APOS);
    }      
       
        $StepJson = ArrayThis($Step); 
        $IngJson = ArrayThis($Ing);

        //^ Update the Database and return to Post Manager
        $sql = "UPDATE recipes SET Title = '$Title', Description = '$Desc', Steps = '$StepJson', 
        Ingredients = '$IngJson', Author = '$Author', PublishDate = '$Date', Tags = '$Tag' WHERE RecipeID = '$RecipeID'";  
        // mysqli_query($con, $sql);
        if (!mysqli_query($con, $sql)) {
            echo mysqli_error($con);
        }

        //? If the preview button was clicked, redirect to the Recipe page
        // ! No way to navigate back ATM
        if (isset($_POST["PreviewBtn"])) {
            echo '<script>window.location.href="Script_RecipePost.php?Recipe='.$RecipeID.'";</script>';
        } else { //? Else, back to Post Manager
            echo '<script>window.location.href="../Admin - Post Manager.php"; 
            alert("Changes to '.$RecipeID.' has been saved");</script>'; 
        }
    }

?>