<?php
  declare(strict_types = 1);

  session_start();

  include '../classes/DataBase.class.php';
  include '../classes/Search.class.php';

  $link = new DataBase();

  if (isset($_POST['query']) && !empty($_POST['query'])) {
    $search = new Search();
    $search->__search($link->__dbconnect(), $_POST['query']);
  }

?>
