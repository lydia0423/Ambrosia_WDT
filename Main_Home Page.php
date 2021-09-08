<?php
session_start();
if(!isset($_SESSION["Theme"])) {
    $_SESSION["Theme"] = "Ambrosia.css";
    }
	include("Scripts/Script_Connection.php");
	$sqlArticles = "SELECT * FROM articles ORDER BY PublishDate DESC LIMIT 5";
	$resultA = mysqli_query($con, $sqlArticles);
	
	$sqlRecipes = "SELECT * FROM recipes ORDER BY PublishDate DESC Limit 5";
	$resultR = mysqli_query($con, $sqlRecipes);

	$sqlClasses = "SELECT * FROM classes WHERE Type = 'Upcoming'";
	$resultC = mysqli_query($con, $sqlClasses);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Style-->
	<link href="<?php echo $_SESSION['Theme']; ?>" rel="stylesheet" type="text/css">
	<!-- <link href="Test.css" rel="stylesheet" type="text/css"> -->
	
	<!-- Font Awesome-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
	
	<!-- Google Fonts-->
	<link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet">
	<!-- Icon -->
	<link rel="icon" href="Images/Logo/Ambrosia Logo.ico">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Home Page</title>

</head>
<body id="HomePageBody">
	<?php include("Header.php"); ?>
	
	<!-- Page Wrapper-->
	<div id="HomeContent" class="page-wrapper">
	
		<!-- Post Slider-->
		<div class="post-slider">
			<h1 class="slider-title">Upcoming Classes</h1>
			<i class="fas fa-chevron-left prev"></i>
			<i class="fas fa-chevron-right next"></i>
			
			<div id="TrendPost" class="post-wrapper">

				<?php
					while ($rowC = mysqli_fetch_assoc($resultC)) {

						$ClassTitle = $rowC["Title"];
						$PublishDate = $rowC["PublishDate"];
						$Status = $rowC["Type"];
						$Author = $rowC["Author"];
						$DescC = $rowC["Description"];
						echo '<div class="post">
								<img src="Images/Classes/'.$ClassTitle.'" 
								alt="'.$ClassTitle.'" 
								class="LongCarousel">
								<div class="overlay">
									<div class="text">
										<h4><a href="">'.$ClassTitle.'</a></h4>
										<i class="far fa-user">'.$Author.'</i>
										&nbsp;
										<i class="far fa-calendar">'.$PublishDate.'</i>
										<p>'.$DescC.'</p>
										<h3>Coming Soon!</h3>
									</div>
								</div>
							</div>';

					}
				?>				
			</div>
			
		</div>
		<!-- // Post Slider-->
	
	<!--Content- Article-->
	<div class="content clearfix">
	
		<!-- Main Content Articles -->
		<div class="main-content">
			<h1 class="article-title">Articles</h1>
			
			<?php 
				while ($rowA = mysqli_fetch_assoc($resultA)) {
					$ArticleID = $rowA["ArticleID"];
					$ArticleTitle = $rowA["Title"];
					$Description = $rowA["Description"];
					$PublishDate = $rowA["PublishDate"];
					$Author = $rowA["Author"];
					include("Scripts/Script_ArticleBrowsePosts.php");
				}
			?>
		</div>
		<!-- //Main Content Articles -->	
	</div>
	<!-- //Content- Article -->
<br>	
<!-- Content-Recipe -->
		<div class="content-recipe">
		
			<!-- Main Content Recipes -->	
				<div class="main-content-recipe">
					<h1 class="recipe-title">Recipes</h1>
					<i id="ArrowPrev" class="fas fa-chevron-left prev"></i>
					<i  id="ArrowNext" class="fas fa-chevron-right next"></i>
					
					<div id="RecipeWrapper" class="recipe-wrapper">
						<?php 
							while ($rowR = mysqli_fetch_assoc($resultR)) {
								$RecipeID = $rowR["RecipeID"];
								$RecipeTitle = $rowR["Title"];
								$DescriptionR = $rowR["Description"];
								$PublishDateR = $rowR["PublishDate"];
								$AuthorR = $rowR["Author"];
								 include("Scripts/Script_HomeRecipe.php"); 
							} 
						?>
					</div>		
				</div>
				<!-- //Main Content Recipes -->
		</div>
			<!-- //Content-Recipe -->
	</div>
	<!-- //Page Wrapper-->
	
	<!-- Footer -->
	<?php include("Footer.php"); ?>
	<!-- //Footer -->
	
	<!-- JQuery-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
	
	<!-- Slick Carousel-->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
		
	<!-- Custom Script -->
	<script src="External JS.js"></script>
	
</body>
</html>