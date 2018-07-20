
<?php

include '../config/db_connect.php';
$thread_id = $_POST['var'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$image_included = true;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"]))
{
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false)
    {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    }
    else
    {
        echo "File is not an image / no image included";
        $uploadOk = 1;
        $image_included = false;
    }
}

/*
// Check if file already exists
if (file_exists($target_file))
{
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
*/

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000)
{
    echo " Sorry, your file is too large. ";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
{
    echo " Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
    $uploadOk = 0;
}
echo " uploadok : " . $uploadOk . "  image_included : " . $image_included;
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0 && $image_included)
{
    echo " Sorry, your file was not uploaded. ";
// if everything is ok, try to upload file
}
else if ($uploadOk == 1 && $image_included)
{
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
  {
      echo " The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. ";

      if (!isset($_POST['sumbit']))
      {

        $comment = mysqli_real_escape_string($link, $_POST['comment']);

        if ($image_included)
        {
          $file = mysqli_real_escape_string($link, basename( $_FILES["fileToUpload"]["name"]));
        }
        else
        {
          $file = "";
        }

        if (empty($comment))
        {
          header("Location: threads/". $thread_id .".php?post=empty");
          exit();
        }
        else
        {
          $timestamp = date('Y-m-d H:i:s');
          $sql = "INSERT INTO replies (reply_text, image_included, reply_image, thread_reply_id, reply_user_id, reply_time)
          VALUES ('$comment', '$image_included', '$file', '$thread_id', 1, '$timestamp' );";
          $result = mysqli_query($link, $sql);
          header("Location: threads/". $thread_id .".php?post=success_image");
          exit();
        }
      }
      else
      {
        echo " Something happened ";
        header("Location: threads/". $thread_id .".php?post=error");
        exit();
      }
  }
  else
  {
    echo " Sorry, there was an error uploading your file. ";
    header("Location: threads/". $thread_id .".php?post=error");
  }
}
else
{
  $comment = mysqli_real_escape_string($link, $_POST['comment']);
  $timestamp = date('Y-m-d H:i:s');
  $sql = "INSERT INTO replies (reply_text, image_included, reply_image, thread_reply_id, reply_user_id, reply_time)
  VALUES ('$comment', '$image_included', 0, '$thread_id', 1, '$timestamp');";
  mysqli_query($link, $sql);
  header("Location: threads/". $thread_id .".php?post=success");
  exit();
}
?>
