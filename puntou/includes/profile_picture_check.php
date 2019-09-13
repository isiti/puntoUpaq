<?php
  require("config.php");
  session_start();

  if (isset($_SESSION) && isset($_SESSION['id_images']))
  {
      echo $_SESSION['id_images'];
  }
  else
  {
      $image = get_db_row($_SESSION['id'],'id_images','users');
      if ($image != NULL) echo $image;
      else echo "No image";
  } 

?>

