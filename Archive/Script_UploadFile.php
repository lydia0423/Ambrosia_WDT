<?php 
if (isset($_POST["UploadBtn"])){
    //? target_dir = Folder where the image file will be uploaded
   $target_dir = "../Images/Recipes/";
    //? Path of file to be uploaded
   $target_file = $target_dir . basename($_FILES["PostImage"]["name"]);
   $uploadOk = 1; //? Check for Upload success
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //? File type extension

   // Check if file already exists
   if (file_exists($target_file)) {
       $UploadError = "The image already exists!;"
       $uploadOk = 0;
       die();
    }
   
   // Check file size
   if ($_FILES["PostImage"]["size"] > 500000) {
    $UploadError = "The image is too big!";
     $uploadOk = 0;
   }
   
   // Allow certain file formats
   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $UploadError = "Only jpg/png/jpeg file types are accepted!";
     $uploadOk = 0;
   }
   
   // Check if $uploadOk is set to 0 by an error
   if ($uploadOk == 0) {
    echo '<script>alert("Sorry, your file was not uploaded!"'.$UploadError');</script>';
   // if everything is ok, try to upload file
   } else {
     if (move_uploaded_file($_FILES["PostImage"]["tmp_name"], $target_file)) {
       echo '<script>alert("The image '.basename($_FILES["PostImage"]["name"]).' has been uploaded");</script>';
     } else {
      echo '<script>alert("Sorry, there was an error uploading your file!");</script>';
     }
   }
  }
?>