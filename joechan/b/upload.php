
<?php

include '../config/db_connect.php';

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
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
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file))
{
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000)
{
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
{
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0)
{
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}
else
{
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
    {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

        if (!isset($_POST['sumbit']))
        {
          $title = mysqli_real_escape_string($link, $_POST['title']);
          $comment = mysqli_real_escape_string($link, $_POST['comment']);
          $file = mysqli_real_escape_string($link, basename( $_FILES["fileToUpload"]["name"]));

          if (empty($title) || empty($comment) || empty($file))
          {
            header("Location: index.php?signup=empty");
            exit();
          }
          else
          {
            $timestamp = date('Y-m-d H:i:s');

            $sql = "INSERT INTO threads (thread_title, thread_op_text, thread_op_image, thread_time, board_thread_id, thread_user_id, thread_hierarchy, reply_count, reply_image_count )
            VALUES ('$title', '$comment', '$file', '$timestamp', 1, 1, 0,0,0)";

            $sql2 = "SELECT threads.thread_id FROM threads WHERE thread_title = '$title';";

            $result1 = mysqli_query($link, $sql);
            echo "   sql1: " . $result1;
            $result = mysqli_query($link, $sql2);
            $row = mysqli_fetch_assoc($result);

            $thread_id = "./threads/" . $row['thread_id'] . ".php";
            echo "   debug 1: " . $thread_id;
            $myfile = fopen($thread_id, "w+") or die("Unable to open file!");
            echo "   debug 2";
            $txt = file_get_contents('../config/thread_template.php');

            fwrite($myfile, $txt);
            fclose($myfile);

            header("Location: index.php?post=success_op");
            exit();
          }
        }
        else
        {
          echo "Something happened";
          //header("Location: ../index.php?signup=other");
          exit();
        }
    }
    else
    {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
