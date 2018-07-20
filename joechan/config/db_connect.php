<?php

echo "Attempt";

define('DB_SERVER', '192.168.0.5');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Max10,dr');
define('DB_NAME', 'joechan');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{
  echo "connected";
}
