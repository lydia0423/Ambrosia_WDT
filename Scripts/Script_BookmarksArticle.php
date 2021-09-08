<!-- The Image and Title are both hyperlinks -->
<html>
	<div id="ArticleBookmark" class="BookmarkA">
		<form method="GET" action="Scripts/Script_ArticlePost.php">
		<input type="Image" src="Images/Articles/<?php echo $ATitle; ?>"
			alt="<?php echo $ATitle;?>" class="RecipeImage" name="RecipeImg">

		<!-- The hidden input contains the RecipeID which is sent via GET to
			Script_RecipePost.php -->
			<input type="hidden" name="Article" value="<?php echo $ArticleID;?>">

			<h4><button class="RecipeName" type="submit" name="RecipeName"><?php echo $ATitle; ?>
			</button></h4>
		</form>

		<div class="recipe-info">
			<i class="far fa-user"><?php echo $AAuthor; ?></i>
			<i class="far fa-calendar"><?php echo $APublishDate; ?></i>
			<p class="PreviewText">
			<?php echo $ADescription; ?>
			</p>
		</div>
	</div>


</html>