<?php 
 session_start();  

 if (isset($_POST["ForgotFuncBtn"])) {
     $_SESSION["State"] = "Initial";
     header("Location: ../Login.php");
     echo $_SESSION["State"];
     exit();
 } else if (isset($_POST["CancelBtn"])) {
     $_SESSION["State"] = "Cancelled";
     header("Location: ../Login.php");
     exit();
 } else {
include("Script_Connection.php");

$_SESSION["UsernameF"] = $_POST["UsernameF"];
$Username = $_SESSION["UsernameF"];
    
$sql = "SELECT SecurityQuestion FROM user_account 
            WHERE Username = '$Username'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
    
    $CheckQ = $row["SecurityQuestion"];
    switch ($CheckQ) {
        case 0:
            echo '<script>
            window.location.href="../Login.php";
            alert("No User found. Please ensure that your username has been entered correctly. If you have not set a security question, then please contact the Admin for further assistance.");
            </script>';
            $_SESSION["State"] = "Initial";
            exit();
        case 1:
            $_SESSION["SecurityQ"] = "What is your pet's name?";
        break;

        case 2:
             $_SESSION["SecurityQ"] = "What is your favourite book";
        break;

        case 3: 
             $_SESSION["SecurityQ"] = "Which school/institute of higher education did you attend?";
        break;
    }
    $_SESSION["State"] = "Identified";
 header("Location: ../Login.php");
 mysqli_close($con);
}
?>