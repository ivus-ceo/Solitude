<?php
  declare(strict_types = 1);

  session_start();

  include '../includes/autoloader.php';

  $user_introduction = $_POST['user_introduction'];

  echo $user_introduction;

  $link = new DataBase();
  $link->__SQLUPDATE('solitude', 'user_introduction', $user_introduction);

?>
