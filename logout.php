<?php

  session_start();

  include 'includes/autoloader.php';

  $link = new DataBase();

  $logout = new LogOut();
  $logout->__logout($link->__dbconnect(), $_GET['logout']);

?>
