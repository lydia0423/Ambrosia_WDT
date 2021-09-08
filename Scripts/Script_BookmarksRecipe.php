<!-- The Image and Title are both hyperlinks -->
<html>
	<div id="RecipeBookmark" class="BookmarkR">
		<form method="GET" action="Scripts/Script_RecipePost.php">
		<input type="Image" src="Images/Recipes/<?php echo $RecipeTitle; ?>.jpg"
			alt="<?php echo $RecipeTitle;?>" class="RecipeImage" name="RecipeImg">

		<!-- The hidden input contains the RecipeID which is sent via GET to
			Script_RecipePost.php -->
			<input type="hidden" name="Recipe" value="<?php echo $RecipeID;?>">

			<h4><button class="RecipeName" type="submit" name="RecipeName"><?php echo $RecipeTitle; ?>
			</button></h4>
		</form>

		<div class="recipe-info">
			<i class="far fa-user"><?php echo $Author; ?></i>
			<i class="far fa-calendar"><?php echo $PublishDate; ?></i>
			<p class="PreviewText">
			<?php echo $Description; ?>
			</p>
		</div>
	</div>	


</html>