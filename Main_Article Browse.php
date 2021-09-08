<?php
session_start();
if(!isset($_SESSION["Theme"])) {
    $_SESSION["Theme"] = "Ambrosia.css";
    }
	include("Scripts/Script_Connection.php");
	//? Pagination
	//^ How many total rows in the articles table
	if (isset($_GET["TagID"])) {
		$TagID = $_GET["TagID"];
		$sqlRow = "SELECT COUNT(ArticleID) FROM articles WHERE Tags = '$TagID'";
	} else {
		$sqlRow = "SELECT COUNT(ArticleID) FROM articles";
	}
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

	//^ Retrieving Tag details from Tag table
	$sqlTag = "SELECT * FROM tags";
	$resultTag = mysqli_query($con, $sqlTag);

	 //^ Retrieve Article details from Database
	$Offset = ($CurrentPage - 1) * $PostsPerPage;
	if (isset($_GET["TagID"])) {
		$TagID = $_GET["TagID"];
		$sqlLoadArticle = "SELECT * FROM articles WHERE Tags = '$TagID' LIMIT $Offset, $PostsPerPage";
	} else {
		$sqlLoadArticle = "SELECT * FROM articles LIMIT $Offset, $PostsPerPage";
	}
	$result = mysqli_query($con, $sqlLoadArticle);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Style-->
	<link href="<?php echo $_SESSION['Theme']; ?>" rel="stylesheet" type="text/css">
	<script src="Ambrosia.js"></script>
	<!-- Font Awesome-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
	
	<!-- Google Fonts-->
	<link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet">
	
	<!-- Icon -->
	<link rel="icon" href="Images/Logo/Ambrosia Logo.ico">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Article Browse</title>

</head>
<body class="GridlessBody">
	<?php include("Header.php"); ?>
	
	<!-- Content -->
		<div class="browse-content clearfix">
	
		<!-- Main Content Articles  -->
			<div class="main-content">
				<h1 class="article-title">Articles</h1>
				<h2 id="Msg">There are no articles under this tag!</h2>		
<?php 
	
		//^ Displays a message if there are no posts under this tag
		if (mysqli_affected_rows($con) == 0) {
			echo '<script>HideDivId("Msg", "block");</script>';
			$Pages = 1;
			$CurrentPage = 1;
			}

		//^ Retrieve Article details from Database
	while ($Post = mysqli_fetch_assoc($result)) {
		$ArticleID = $Post["ArticleID"];
		$ArticleTitle = $Post["Title"];
		$Description = $Post["Description"];
		$PublishDate = $Post["PublishDate"];
		$Author = $Post["Author"];
		include("Scripts/Script_ArticleBrowsePosts.php");
		}

		// ? Displays Next if not on the last page
		if ($CurrentPage != $Pages) {
			$NextPage = $CurrentPage + 1;
			echo "<a class='LoadMore' id='NextPage' href='{$_SERVER['PHP_SELF']}?CurrentPage=$NextPage'>
			Next</a>";
		}
		// ? Displays Previous if on any page except the first
		if ($CurrentPage !== 1) {
			$PrevPage = $CurrentPage - 1;
			echo "<a class='LoadMore' id='PrevPage' href='{$_SERVER['PHP_SELF']}?CurrentPage=$PrevPage'>
			Previous</a>";
		}
?>			
			</div>
		<!-- //Main Content Articles -->
	
			<div class="sidebar">
				<div class="section search">
					<h2 class="section-title">Search</h2>
					<form action="index.html" method="post">
						<input type="text" id="SearchBox" name="search-term" class="text-input" 
						placeholder="Search ..." oninput="SearchFunction()" onblur="setTimeout(NoSearch, 100)"
						autoComplete="off">
					</form>
				</div>
			
				<div class="section topics">
					<h2 class="section-title">Topics</h2>
					<ul>
						<?php
							//^ Tag filters for articles
							while ($rowT = mysqli_fetch_assoc($resultTag)) {
								$TagName = $rowT["Name"];
								$TagID = $rowT["TagID"];
								echo '<li><a href="Main_Article Browse.php?TagID='.$TagID.'"
								 name="TagList">'.$TagName.'</a></li>';
							}				
						?>
					</ul>
				</div>
			</div>
		</div>
	<!-- //Content -->
	
	<!-- Search Dropdown -->
	<?php include("Scripts/Script_Search.php"); ?>

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