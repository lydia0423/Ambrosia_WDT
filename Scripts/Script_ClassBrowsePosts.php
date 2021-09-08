<?php
    if(isset($_SESSION["UserID"])) {
        //? If the user is logged in, the subscription table is checked to see if the User has
        //? purchased any classes.
        
        $UserID = $_SESSION["UserID"];
        $sqlSubscription = "SELECT * FROM subscription WHERE UserID = '$UserID' AND ClassID = '$ClassID'";
        $resultS = mysqli_query($con, $sqlSubscription);

        //^ User is directed to the Class page if they have purchased the class
        if (mysqli_affected_rows($con) == 1) {
            $Action = "Scripts/Script_ClassPost.php";
            $Class = "View";
        //^Else, they are directed to the payment page
        } else if (mysqli_affected_rows($con) == 0) {
            $Action = "Payment.php";
            $Class = "Enroll";
        }
} else { 
    //^ Users who are not logged in will be redirected to Login from the Payment page
    $Action = "Payment.php";
    $Class = "Enroll";
}
?>

<div class="post" id="ClassPost">     
        <form method="GET" action="<?php echo $Action; ?>">
        <input type="hidden" name="Classes" value="<?php echo $ClassID; ?>">
        <input type="Image" src="Images/Classes/<?php echo $Title; ?>" alt="<?php echo $Title;?>" class="slider-image">
        <div class="post-info">
                <h4><button class="PostName" type="submit" name="ClassName"><?php echo $Title; ?></button></h4>
            <i class="far fa-user"><?php echo $Author;?></i>
            &nbsp;
            <i class="far fa-calendar"><?php echo $PublishDate; ?></i>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn read-more" name="ClassLink"><?php echo $Class; ?></a>
        </div>
        </form>
    </div>