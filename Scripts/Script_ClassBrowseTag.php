
<div class="post-slider">
    <h2 class="type"><?php echo $TagName; ?></h2>
<br><br>
    <h2 id="Msg">There are no classes under this tag!</h2>
   
    <i class="fas fa-chevron-left prev"></i>
    <i class="fas fa-chevron-right next"></i>
    <div class="post-wrapper">
        <?php 
            $sqlClass = "SELECT * FROM classes WHERE Tags = '$TagID' AND NOT Type = 'Upcoming'";
            $resultClass = mysqli_query($con, $sqlClass);
          
            //^ Displays a message if there are no posts under this tag
            if (mysqli_affected_rows($con) == 0) {
            echo '<script>HideDivId("Msg", "block");</script>';
            }
        
            while ($rowClass = mysqli_fetch_assoc($resultClass)) {
                $Title = $rowClass["Title"];
                $PublishDate = $rowClass["PublishDate"];
                $Author = $rowClass["Author"];
                $ClassID = $rowClass["ClassID"];
                include("Scripts/Script_ClassBrowsePosts.php");
                }
        ?>
    </div>
</div>
