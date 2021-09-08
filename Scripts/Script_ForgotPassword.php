<?php
session_start();
if (isset($_POST["CancelBtn"])) {
    $_SESSION["State"] = "Cancelled";
    header("Location:   ../Login.php");
    exit();
} else {
    include("Script_Connection.php");
    $Username = $_SESSION["UsernameF"];
    $NewPass = $_POST["NewPassword"];
    $ConfirmPass = $_POST["ConfirmNew"];
    $sql = "UPDATE user_account SET Password = '$NewPass' WHERE Username = '$Username'";

    if($NewPass == $ConfirmPass AND $NewPass !== "") {
        mysqli_query($con, $sql);
        header("Location: ../Login.php");
        $_SESSION["State"] = "Cancelled";
    } else {
        echo '<script>window.location.href="../Login.php";
        alert("Passwords do not match");</script>';
 
    }
    mysqli_close($con); 
}
?>