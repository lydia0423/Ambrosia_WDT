<?php 
session_start();
	 $ArticleID = $_GET["Article"];
    include("Script_Connection.php");
    $sqlArticle = "SELECT * FROM articles WHERE ArticleID = '$ArticleID'";
    $result = mysqli_query($con, $sqlArticle);
    $row = mysqli_fetch_assoc($result);

	//? Selects Article details
    $Title = $row["Title"];
	$Content = json_decode($row["Content"], true);
	$ArticleID = $row["ArticleID"];
   
	//? Selects and displays Tag Names in the sidebar
	$sqlTag = "SELECT * FROM tags";
	$resultTag = mysqli_query($con, $sqlTag);

    // ? If user is not logged in, display a warning message
	if (empty($_SESSION["UserID"])) {
		$UserID = "";
		$condition = "Deleted";
		if(isset($_GET["BookmarkBtn"])) {
			$condition = "Invalid";
		}
	}
	 else {
		$UserID = $_SESSION["UserID"];
	
	$sqlCheck = "SELECT * FROM bookmarks WHERE ArticleID = '$ArticleID' AND UserID = '$UserID'";
	$resultCheck = mysqli_query($con, $sqlCheck);
	// ? Checks the database if the recipe has been bookmarked by the user and displays accordingly
	if ((mysqli_affected_rows($con) == 0)) {
		$condition = "Deleted";
	} else if (mysqli_affected_rows($con) == 1) {
		$condition = "Created"; 		
	}

	// ? If the bookmark button was clicked, toggles bookmark in database
	if (isset($_GET["BookmarkBtn"])) {
		
		if (mysqli_affected_rows($con) == 0) {
			$sqlBookmark = "INSERT INTO bookmarks (ArticleID, UserID) VALUES ('$ArticleID', '$UserID')";
		 mysqli_query($con, $sqlBookmark);
			$condition = "Created";
		} else if (mysqli_affected_rows($con) == 1) {
			$sqlDelete = "DELETE FROM bookmarks WHERE ArticleID = '$ArticleID' AND UserID = '$UserID'";
		 	mysqli_query($con, $sqlDelete);
			$condition = "Deleted";
		}
	}
}
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
	
	<link rel="icon" href="../Images/Logo/Ambrosia Logo.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title><?php echo $Title; ?></title>
</head>
<body class="PostBody" onload="Bookmarks('<?php echo $condition; ?>')">
	<?php include("HeaderForScripts.php");  ?>
	<!-- Content -->
	<div class="browse-content clearfix"></div>
	
	<!-- Content -->
		<div id="PostArticleContent" class="browse-content clearfix">
		
		<!-- Main Content Articles  -->
			<div class="main-content single">

			<form method="GET">
			
			<!-- The hidden input contains the ArticleID which is sent through GET
			to Script_ArticlePost.php which displays the record according to ArticleID -->
			<input type="hidden" name="Article" value="<?php echo $ArticleID;?>">
		
				<input type="submit" name="BookmarkBtn" id="BookmarkBtn" value="" 
				onmouseover="BookmarkHover('In')" onmouseout="BookmarkHover('Out')">
				<i class="fas fa-bookmark large-icon" id="BookmarkIcon"></i>
				</form>

			<h1 class="post-title"><?php echo $Title; ?></h1>
			
				<div class="post-content">
				<img src="../Images/Articles/<?php echo $Title; ?>" class="ArticleImg">

			<?php 
			foreach($Content as $Section => $ContentArray) {
				echo '<h2>'.$ContentArray[0].'</h4>';
			for ($i=1; $i < count($ContentArray); $i++) {
				$Decode = Decode($ContentArray);
				echo '<p>'.$Decode[$i].'</p>';
			} }
			?>
				</div>
			</div>		
		<!-- //Main Content Articles -->
			<!-- Sidebar -->
			<div class="sidebar single">
					<div class="section popular">
						<h2 class="section-title">Popular</h2>
							<ul>
								<?php
									$sqlSidebar = "SELECT ArticleID, Title FROM articles WHERE NOT ArticleID = '$_GET[Article]'
									ORDER BY RAND() LIMIT 6";
									$resultSide = mysqli_query($con, $sqlSidebar);
									while ($rowSide = mysqli_fetch_assoc($resultSide)) {
										$SideArticleID = $rowSide["ArticleID"];
										$SideTitleA = $rowSide["Title"];
										echo '<li><a href="Script_ArticlePost.php?Article='.$SideArticleID.'">'.$SideTitleA.'</a></li>';
									}
								?>
							</ul>
					</div>
			
					<div class="section topics">
						<h2 class="section-title">Topics</h2>
							<ul>
								<?php
								//^ Tag filters for articles
								while ($rowT = mysqli_fetch_assoc($resultTag)) {
									$TagName = $rowT["Name"];
									$TagID = $rowT["TagID"];
									echo '<li><a href="../Main_Article Browse.php?TagID='.$TagID.'"
									name="TagList">'.$TagName.'</a></li>';
								}				
								?>
							</ul>
					</div>
			</div>
			<!-- //Sidebar -->
			
		</div>	
	<!-- //Content -->
	
	<!-- Footer -->
	<?php include("../Footer.php"); ?>
	<!-- //Footer -->
	
	<!-- JQuery-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
	
	<!-- Slick Carousel-->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
		
	<!-- Custom Script -->
	<script src="../External JS.js"></script>
	
</body>
</html>