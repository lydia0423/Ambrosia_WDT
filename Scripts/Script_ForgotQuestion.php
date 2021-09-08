<?php 
    session_start();
    if (isset($_POST["CancelBtn"])) {
        $_SESSION["State"] = "Cancelled";
        header("Location: ../Login.php");
        exit();
    } else {
    include("Script_Connection.php");
    $Username = $_SESSION["UsernameF"];
    $sql = "SELECT SecurityQuestion, SecurityAnswer FROM user_account 
    WHERE Username = '$Username'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $DBAnswer = $row["SecurityAnswer"];
    $UserAnswer = $_POST["SecurityA"];

    if ($DBAnswer == $UserAnswer) {
        echo '<script>
        window.location.href="../Login.php";
        </script>';
        $_SESSION["State"] = "Verified";
    } else {
        echo '<script>
        window.location.href="../Login.php";
        alert("The answer is incorrect. Please try again");
        </script>';
    }
    mysqli_close($con);}
?>