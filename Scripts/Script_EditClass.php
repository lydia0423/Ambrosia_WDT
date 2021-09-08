<?php 
    
    include("Script_Connection.php");

    //^ Save Edits when Save button is clicked
    if (isset($_POST["SaveBtn"]) || isset($_POST["PreviewBtn"])) {
        //^ Data collection
      $ClassID = $_POST["PostID"];
      $Title = mysqli_real_escape_string($con, $_POST["PostTitle"]);
      $Desc = mysqli_real_escape_string($con, $_POST["Desc"]);
      $Author = mysqli_real_escape_string($con, $_POST["Author"]);
      $Video = mysqli_real_escape_string($con, $_POST["VideoLink"]);
      $Ing = mysqli_real_escape_string($con, $_POST["ClassIng"]);
      $Type = $_POST["ClassType"];
      $Tag = $_POST["PostTags"];
      $Date = $_POST["PublishDate"];

      function ArrayThis($Input) {

        $RemoveTags = str_replace(["<h4>", "</h4>", "<li>", "</li>"], ["*", "", "|", ""], $Input);
        $RemoveFront = ltrim($RemoveTags, "*");
        $ExplodeArray = explode("*", $RemoveFront);
            foreach ($ExplodeArray as $NextLevel) {
                $MultiArray[] = explode("|", $NextLevel);
            }
        return json_encode($MultiArray, JSON_HEX_APOS);
    }
        //? Converts the created array into a JSON for the database
        $IngJson = ArrayThis($Ing);     
        //^ Update the Database and return to Post Manager
        $sql = "UPDATE classes SET Title = '$Title', Description = '$Desc', Ingredients = '$IngJson', VideoLink = '$Video', Author = '$Author', 
        Tags = '$Tag', Type = '$Type', PublishDate = '$Date' WHERE ClassID = '$ClassID'";  
        // mysqli_query($con, $sql);
        if (!mysqli_query($con, $sql)) {
            echo mysqli_error($con);
        }
 
        //? If the preview button was clicked, redirect to the Recipe page
        // ! No way to navigate back ATM
        if (isset($_POST["PreviewBtn"])) {
            echo '<script>window.location.href="Script_ClassPost.php?Classes='.$ClassID.'";</script>';
        } else { //? Else, back to Post Manager
            echo '<script>window.location.href="../Admin - Post Manager.php"; 
            alert("Changes to '.$ClassID.' has been saved");</script>'; 
        }
    }

?>