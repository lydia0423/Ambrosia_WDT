<?php 
include("Script_Connection.php");
    $AdminUsername = $_POST["HiddenUsername"];
    $AdminPass = $_POST["HiddenPassword"];

    $sql = "INSERT INTO admin (Username, Password)
    VALUES ('$AdminUsername', '$AdminPass')";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo '<script>
    alert("'.$AdminUsername.' has been added as an Admin!");
    window.location.href="../Admin - Admin Manager.php";
    </script>';
?>