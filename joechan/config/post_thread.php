<?php
  session_start();
  include '../config/db_connect.php';

  if (!isset($_POST['sumbit']))
  {
    include_once 'db_connect.php';

    $title = mysqli_real_escape_string($link, $_POST['title']);
    $comment = mysqli_real_escape_string($link, $_POST['comment']);
    $file = mysqli_real_escape_string($link, $_POST['file']);


    if (empty($title) || empty($comment) || empty($file))
    {
      header("Location: ../index.php?signup=empty");
      exit();
    }
    else
    {
      $sql = "INSERT INTO threads (thread_title, thread_op_text, thread_op_image) VALUES ('$title', '$comment', '$file');";
      mysqli_query($link, $sql);

      $thread_id = 
      $myfile = fopen($thread_id, "w") or die("Unable to open file!");
      $txt = file_get_contents('http://www.google.com/');
      fwrite($myfile, $txt);
      fclose($myfile);

      header("Location: ../index.php?signup=success");
      exit();
    }


  }
  else
  {
    echo "Something happened";
    //header("Location: ../index.php?signup=other");
    exit();
  }






?>
