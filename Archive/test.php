<?php
	include("../Scripts/Script_Connection.php");
	
	//? Pagination
	//^ How many total rows in recipes table
		$sqlRow = "SELECT COUNT(RecipeID) FROM recipes WHERE Tags = 'T006'";
	
	$RowResult = mysqli_query($con, $sqlRow);
	$RowNum = mysqli_fetch_row($RowResult);
	$RowTotal = $RowNum[0];
	echo $RowTotal;
?>