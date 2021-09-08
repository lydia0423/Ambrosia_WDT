<?php
include("Script_Connection.php");
$AdminID = $_GET["AdminID"];

$sql = "DELETE FROM admin WHERE AdminID = '$AdminID'";
mysqli_query($con, $sql);
header("Location: ../Admin - Admin Manager.php");
?>