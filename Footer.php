     <!-- ^ Footer -->
  <div class="footer">
    <div class="footer-content">
        <div class="footer-section about">
            <h1 class="logo-text">Ambrosia</h1>
            <p>Ambrosia, learn to cook today!</p>
            <div class="contact">
                <span><i class="fas fa-phone"> &nbsp; 07-6625678</i></span>
                <span><i class="fas fa-envelope"> &nbsp; info@ambrosia.com</i></span>
            </div>
            <div class="social">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        
        <div class="footer-section links">
            <h2>Quick Links</h2>
            <br>
            <ul>
                <a href="Main_Recipe Browse.php">
                    <li>Recipes</li>
                </a>
                <a href="Main_Article Browse.php">
                    <li>Articles</li>
                </a>
                <a href="Main_Class Browse.php">
                    <li>Classes</li>
                </a>
            </ul>
        </div>
        <div class="footer-section subscribe">
            <h2>Subscribe Newsletter</h2>
            <br>
            <form action="index.html" method="post">
                <input type="email" name="email" placeholder="Your email address">
                <button type="submit" class="btn btn-big">Subscribe</button>
            </form>
        </div>
        <div class="footer-bottom">
            &copy; Ambrosia.com | Designed by Lydia & Becky
        </div>
    </div>
</div>

<?php 
//^ Close the database connection
    if (isset($Connection)) {
        mysqli_close($con);
    }
?>