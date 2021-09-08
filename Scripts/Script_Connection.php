<?php
    //? connection string to mysql database
    //?                 host name, username, password, database name, mysql port
    $con=mysqli_connect("localhost", "root", "root", "Ambrosia", "8889");
    //?  checks Connection to database and returns an error message (if necessary)
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL:" . mysqli_connect_error();
    }
    return $Connection = true;
?>