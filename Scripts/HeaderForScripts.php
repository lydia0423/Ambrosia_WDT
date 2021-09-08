<?php    
    if (empty($_SESSION['Username'])) {
       $_SESSION["Username"] = "Login";
    }
   
    if ($_SESSION["Username"] == "Login") {     
        $login = "../Login.php";
    } else {
        $login = "#";
    }
    if (isset($_SESSION["Admin"])) {
        $Dashboard = "../Admin - User Manager.php";
    } else {
        $Dashboard = "../User - Main.php";
    }

    //^ Decoding Function
    function Decode($StringToDecode)  {
       return str_replace(["u0027", "u00b0", "u201d", "u2019", "u00e9"], ["'", "°", "\"", "'", "é"], $StringToDecode);
       
    }

?>
<html>
    <header>
            <!--^ Ribbon-->
            <div class="logo">
                <a href="../Main_Home Page.php"><h1 class="logo-text">Ambrosia</h1></a>
               
            </div>
            <i class="fas fa-chevron-circle-down menu-toggle"></i>
            <ul class= "nav">
                <li><a class="#" href="../Main_Home Page.php">Home</a></li>
                <li><a href="../Main_Recipe Browse.php">Recipes</a></li>
                <li><a href="../Main_Article Browse.php">Articles</a></li>
                <li><a href="../Main_Class Browse.php">Classes</a></li>	

                <li>
                <a href=<?php echo $login; ?>>
                <i class="fa fa-user"></i>
                <!-- Displays the username when logged in -->
                <?php echo $_SESSION["Username"]; ?> 
                <i class="fa fa-chevron-down"></i>
                </a>
                <ul id="UserMenu">
                        <li><a href="<?php echo $Dashboard; ?>">Dashboard</a></li>
                        <li>
                        <a href="../Scripts/Script_Logout.php?logout=Logout" class="logout"
                            name="logout">Logout</a>
                        </li>
                    </ul>

                     <!-- ? Prevents the dropdown menu from appearing if the user is not logged in -->
                     <?php if ($_SESSION["Username"]== "Login") {    
                     echo '<script> document.getElementById("UserMenu").style.display="none";
                     </script>';} ?>

                </li>
            </ul>
            <!--//Ribbon-->
        </header>
</html>
