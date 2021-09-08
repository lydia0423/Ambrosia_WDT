<?php 
session_start();
if(!isset($_SESSION["Theme"])) {
    $_SESSION["Theme"] = "Ambrosia.css";
    }
    include("Scripts/Script_Connection.php");
   
	if (isset($_GET["TagID"])) {
		$sqlTag = "SELECT * FROM tags WHERE TagID = '$_GET[TagID]'";
	} else {
	$sqlTag = "SELECT DISTINCT classes.Tags, tags.Name FROM classes INNER JOIN tags ON classes.Tags = tags.TagID";
	}
    $resultTag = mysqli_query($con, $sqlTag);
      

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

	<title>Class Enroll</title>
</head>
<body class="GridlessBody">
	<?php include("Header.php"); ?>
	
	<!-- Content -->
		<div class="class-content clearfix">
			
			<!-- Main Content -->
				<div id="ClassBrowse" class="post-slider">
					<h1 class="class-title">Classes</h1>
					
					<div class="sidebar">
						<div class="search">
							<!-- <form action="index.html" method="GET"> -->
								<input type="search" id="SearchBox" name="SearchBox" class="text-input" 
								placeholder="Search ..." oninput="SearchFunction()" onblur="setTimeout(NoSearch,100)"
								autoComplete="off">
							<!-- </form> -->
						</div>
					</div>
				
				</div>
		
				<?php 
					while ($rowTag = mysqli_fetch_assoc($resultTag)){
					$TagName = $rowTag["Name"];
					if (isset($_GET["TagID"])) {
						$TagID = $_GET["TagID"];
					} else {
						$TagID = $rowTag["Tags"];
					}
						include("Scripts/Script_ClassBrowseTag.php"); 
					}
				
				?>

		<!-- Search Dropdown -->
		<?php include("Scripts/Script_Search.php"); ?>
	</div>
	
	<!-- //Content -->
	

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