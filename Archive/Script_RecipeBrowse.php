<?php
	include("Script_Connection.php");
	//? Pagination
	//^ How many total rows in recipes table
	$sqlRow = "SELECT COUNT(RecipeID) FROM recipes";
	$RowResult = mysqli_query($con, $sqlRow);
	$RowNum = mysqli_fetch_row($RowResult);
	$RowTotal = $RowNum[0];

	//^ Posts to show per page
	$PostsPerPage = 5;
	$Pages = ceil($RowTotal/$PostsPerPage); //^ Total pages 

	//^ Get the current page
	if (isset($_GET["CurrentPage"]) && is_numeric($_GET["CurrentPage"])) {
		$CurrentPage = (int) $_GET["CurrentPage"];
	} else { //^ Else, a default page is set
		$CurrentPage = 1;
	}

	//^	Page validation
	//? if current page (num) exceeds total pages, it is set to the last available page
	if ($CurrentPage > $Pages) {
		$CurrentPage = $Pages;
	}	//? if current page (num) is less than total pages, it is set to the first available page
	if ($CurrentPage < 1) {
		$CurrentPage = 1;
	}

	 //^ Retrieve recipe details from Database
	$Offset = ($CurrentPage - 1) * $PostsPerPage;
	$sqlLoadRecipe = "SELECT * FROM recipes LIMIT $Offset, $PostsPerPage";
	$result = mysqli_query($con, $sqlLoadRecipe);

	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Style-->
	<link href="../<?php echo $_SESSION['Theme']; ?>" rel="stylesheet" type="text/css">
	<script src="../Ambrosia.js"></script>
	<!-- Font Awesome-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
	
	<!-- Google Fonts-->
	<link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" href="../Images/Logo/Ambrosia Logo.ico">
    <title>Browse Recipes</title>
</head>
<body>
<?php include("HeaderForScripts.php"); ?>
	
	<!-- Content --> 
		<div class="browse-content clearfix">
				
			<!-- Main Content Recipes -->
			<div class="main-content">
				<h1 class="article-title">Recipes</h1>
			
<?php 
	//^ Retrieve recipe details from Database
	
	while ($Post = mysqli_fetch_assoc($result)) {
		$RecipeID = $Post["RecipeID"];
		$RecipeTitle = $Post["Title"];
		$Description = $Post["Description"];
		$PublishDate = $Post["PublishDate"];
		$Author = $Post["Author"];
		include("Script_RecipePosts.php");
		echo '<script> Posts(); </script>';
		
		}
?>

			</div>
		<!-- //Main Content Recipes -->
	
			<div class="sidebar">
				<div class="section search">
					<h2 class="section-title">Search</h2>
					<form action="index.html" method="post">
						<input type="text" name="search-term" class="text-input" placeholder="Search ...">
					</form>
				</div>
			
				<div class="section topics">
					<h2 class="section-title">Topics</h2>
					<ul>
						<li><a href="#">Asian</a></li>
						<li><a href="#">Western</a></li>
						<li><a href="#">Japanese</a></li>
						<li><a href="#">Korean</a></li>
						<li><a href="#">Dessert</a></li>
						<li><a href="#">5 minutes meals</a></li>
						<li><a href="#">Microwave meals</a></li>
					</ul>
				</div>
			</div>
		</div>
	<!-- //Content -->
	
	<!-- Footer -->
	<?php include("../Footer.php"); ?>
	
	<!-- JQuery-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
	
	<!-- Slick Carousel-->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
		
	<!-- Custom Script -->
	<script src="../External JS.js"></script>
	
</body>
</html>