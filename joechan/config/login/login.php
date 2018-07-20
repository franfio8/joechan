<?php

session_start();

include '../config/db_connect.php';
echo "\n";
echo $_POST["u_name"];
echo "\t";
echo $_POST['p_word'];
$username = mysqli_real_escape_string($link, $_POST['u_name']);
$password = mysqli_real_escape_string($link, $_POST['p_word']);

echo "debug1 \n";
//ERROR handlers
//Check if inputs are empty
if (empty($username) || empty($password))
{
  echo $username . "&" .  $password;
  echo "\n" . $_POST['u_name'];
  //header("Location: ../index.php?login=empty");
  //exit();
}
else
{
  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($link, $sql);
  $resultCheck = mysqli_num_rows($result);

  echo "debug2";

  if ($resultCheck < 1)
  {
    //no users exist
    header("Location: ../index.php?login=error");
    exit();
  }
  else
  {
    echo "debug3";
      if ($row = mysqli_fetch_assoc($result))
      {
        //De-hashing password
        echo "debug4";
        //$hashedPwdCheck = password_verify($password, $row['password']);
        echo "debug5";
        /*
        if ($hashedPwdCheck == false)
        {

          header("Location: ../index.php?login=incorrectPwd");
          exit();
        }
        elseif ($hashedPwdCheck == true)
        {

          echo "debug3";
          //login the user here
          $_SESSION['u_username'] = $row['u_name'];
          //$_SESSION['u_firstname'] = $row['f_name'];
          //$_SESSION['u_surname'] = $row['s_name'];
          //$_SESSION['u_email'] = $row['e_mail'];
          //$_SESSION['u_id'] = $row['user_id'];
          //$_SESSION['u_profile'] = $row['p_picture'];
          header("Location: ../home.php?login=success");
          exit();
        }
        */

        if ($row['password'] != $password)
        {

          header("Location: ../index.php?login=incorrectPwd");
          exit();
        }
        elseif ($row['password'] == $password)
        {

          echo "debug3";
          //login the user here
          $_SESSION['u_username'] = $row['username'];
          //$_SESSION['u_firstname'] = $row['f_name'];
          //$_SESSION['u_surname'] = $row['s_name'];
          //$_SESSION['u_email'] = $row['e_mail'];
          //$_SESSION['u_id'] = $row['user_id'];
          //$_SESSION['u_profile'] = $row['p_picture'];
          header("Location: ../index.php?login=success");
          exit();
        }
        echo $row['username'];
      }
  }
}
