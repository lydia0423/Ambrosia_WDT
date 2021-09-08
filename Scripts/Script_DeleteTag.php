<?php
include("Script_Connection.php");
$TagID = $_GET["TagID"];

$sql = "DELETE FROM tags WHERE TagID = '$TagID'";
mysqli_query($con, $sql);
header("Location: ../Admin - Tag Manager.php");
?>