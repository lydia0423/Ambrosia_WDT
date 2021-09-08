<div class="post-recipe">
    <form action="Scripts/Script_RecipePost.php" method="GET">
    <input type="hidden" name="Recipe" value="<?php echo $RecipeID; ?>">
    <input type="image" src="Images/Recipes/<?php echo $RecipeTitle;?>" 
    alt="<?php echo $RecipeTitle; ?>" class="recipe-image" name="RecipeImg">

        <div class="recipe-info">
            <h4><a href="Scripts/Script_RecipePost.php?Recipe=<?php echo $RecipeID; ?>">
             <?php echo $RecipeTitle; ?></a></h4>
            <i class="far fa-user"><?php echo $AuthorR;?></i>
            <i class="far fa-calendar"><?php echo $PublishDateR;?></i>
            <br><br>
            <p class="preview-text"><?php echo $DescriptionR; ?></p>								
        </div>
</form>
</div>