<?php 
    include("Script_Connection.php");
    $PostID = $_GET["PostID"];
    $Table = $_GET["Table"];
    
    if ($Table == "Recipe") {
        $TableName = "recipes";
    } else if ($Table == "Article") {
        $TableName = "articles";
    } else if ($Table == "Class") {
        $TableName = "classes";
    }

    $sqlDelete = ("DELETE FROM $TableName WHERE ".$Table."ID = '$PostID'");
    mysqli_query($con, $sqlDelete);
    echo '<script>window.location.href="../Admin - Post Manager.php";</script>';
?>