<?php
session_start();
	include("Script_Connection.php");
	$ClassID = $_GET["Classes"];
    $sqlClass = "SELECT * FROM classes WHERE ClassID = '$ClassID'";
    $result = mysqli_query($con, $sqlClass);
    
    $row = mysqli_fetch_assoc($result);
    $Title = $row["Title"];
    $Link = $row["VideoLink"];
    $Description = $row["Description"];
    $Type = $row["Type"];
    $Ingredients = json_decode($row["Ingredients"], true);
	$ClassID = $row["ClassID"];
	
	//? Selects and displays Tag Names in the sidebar
	$sqlTag = "SELECT * FROM tags";
	$resultTag = mysqli_query($con, $sqlTag);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Style-->
	<link href="../<?php echo $_SESSION['Theme']; ?>" rel="stylesheet" type="text/css">
	
	<!-- Font Awesome-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
	
	<!-- Google Fonts-->
	<link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet">	
	<link rel="icon" href="../Images/Logo/Ambrosia Logo.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Class</title>
</head>
<body id="ClassBody" class="PostBody">
	<?php include("HeaderForScripts.php"); ?>
	
	<!-- Content -->
		<div id="PostClassContent" class="browse-content clearfix">
		
		<!-- Main Content Articles  -->
			<div class="main-content single">
			<h1 class="post-title"><?php echo $Title; ?></h1>
			
				<div class="post-content">
                    <input type="hidden" name="Class" value="<?php echo $ClassID; ?>">

					<iframe id="ClassVideo" src="<?php echo $Link; ?>" frameborder="0"
					allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="video">
					</iframe>
                    <p class="RecipeDesc"><?php echo $Description; ?></p>     
                    
					<h2>Ingredients</h2>
                        <?php 
                        //JsonArray as IngredientType, $IngArray = Array of ingredients
						foreach($Ingredients as $IngType => $IngArray) {
							echo '<h4>'.$IngArray[0].'</h4>';
						   for ($i=1; $i < count($IngArray); $i++) {
							echo '<li>'.$IngArray[$i].'</li>';
						   }
						}
                        ?>                
				</div>
			</div>		
		<!-- //Main Content Articles -->
			
			<!-- Sidebar -->
			<div class="sidebar single">
					<div class="section popular">
						<h2 class="section-title">Classes Owned</h2>
							<ul>
								<?php 
									$sqlSidebar = "SELECT subscription.ClassID, classes.Title FROM subscription INNER JOIN classes
									USING (ClassID) WHERE UserID = '$_SESSION[UserID]' AND NOT ClassID = '$_GET[Classes]' 
									ORDER BY RAND() LIMIT 6";
									$resultSide = mysqli_query($con, $sqlSidebar);
										while ($rowSide = mysqli_fetch_assoc($resultSide)) {
											$SideClassID = $rowSide["ClassID"];
											$SideClassTitle = $rowSide["Title"];
											echo '<li><a href="Script_ClassPost.php?Classes='.$SideClassID.'">'.$SideClassTitle.'</a></li>';
										}
									?>
							</ul>
					</div>
			
					<div class="section topics">
						<h2 class="section-title">Topics</h2>
							<ul>
								<?php
								//^ Tag filters for recipes
									while ($rowT = mysqli_fetch_assoc($resultTag)) {
										$TagName = $rowT["Name"];
										$TagID = $rowT["TagID"];
										echo '<li><a href="../Main_Class Browse.php?TagID='.$TagID.'"
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