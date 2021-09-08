<?php
session_start();
    include("Script_Connection.php");

    if (isset($_POST["CreateBtn"])) {
        
        $NewUsername = mysqli_real_escape_string($con, $_POST["Username"]);
        $NewPassword = mysqli_real_escape_string($con, $_POST["Password"]);
        $ConfirmPass = mysqli_real_escape_string($con, $_POST["confirmPass"]);
        $sqlCheck = "SELECT Username FROM user_account WHERE Username = '$NewUsername'";

        $uniqueUsername = mysqli_query($con, $sqlCheck);
        
        if (stripos($NewUsername, "Admin") !== FALSE) {
            //^ Reserves the word Admin for Administrators only
            echo '<script>alert("Your username is invalid! Please remove the word Admin from your username."); 
            window.location.href="../Create Account.php";</script>';
        } else if (mysqli_affected_rows($con) > 0) {
            //^ Checks if username is unique 
            echo '<script>alert("Your username is not unique!"); 
            window.location.href="../Create Account.php";</script>';
        } else if ($NewPassword !== $ConfirmPass) { //^ Checks if passwords match
            echo '<script>alert("Your passwords do not match!");
            window.location.href="../Create Account.php";</script>';
        } else {
            //? If there is an error due to repeated UserID, the code loops to increment the value
           do {
               //^ Creates and sets UserID
               $id +=1;
                $sqlAccount = "SELECT UserID FROM user_account";
                $UserAccount = mysqli_query($con, $sqlAccount);
          
                if (mysqli_num_rows($result) < 9) {
                    $UserID = "U00". (mysqli_num_rows($result) + $id);
                     } else {
                     $UserID = "U0". (mysqli_num_rows($result) + $id);
                     }
                //^ Creates new user account - INSERT into database
                $sqlQuery = "INSERT INTO user_account(UserID, Username, Password)
                VALUES ('$UserID', '$NewUsername', '$NewPassword')";
                mysqli_query($con, $sqlQuery);
                echo mysqli_affected_rows($con);
          } while (mysqli_affected_rows($con) == "-1");

            $_SESSION["Username"] = $NewUsername;
            $_SESSION["UserID"] = $UserID;

            echo '<script>alert("Please set a security password to be able to use the Forgot Password function");
             window.location.href="../User - Settings.php"; </script>';
        }
         mysqli_close($con);
    }
?>