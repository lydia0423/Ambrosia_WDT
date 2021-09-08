
<form method="GET" action="Scripts/Script_ArticlePost.php">
	<div class="post" id="ArticlePost">
			<!-- The hidden input contains the ArticleID which is sent through GET
			to Script_ArticlePost.php which displays the record according to ArticleID -->
			<input type="hidden" name="Article" value="<?php echo $ArticleID;?>">
		
		<input type="Image" src="Images/Articles/<?php echo $ArticleTitle;?>" 
		alt="<?php echo $ArticleTitle; ?>" class="post-image" name="ArticleImg">
			<div class="post-preview">	

				<h2><button class="PostName" type="submit" name="ArticleName"><?php echo $ArticleTitle; ?>
				</button></h2>
</form>
				<i class="far fa-user"><?php echo $Author; ?></i>
				&nbsp;
				<i class="far user"><?php echo $PublishDate; ?></i>
				<p class="preview-text">
					<?php echo $Description; ?>
				</p>
				<button type="submit" class="btn read-more" name="ArticleLink">Read More</button>
			 
	</div>
</div>
