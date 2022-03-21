<?php

  declare(strict_types = 1);

  session_start();

  include '../includes/autoloader.php';

  $article_id = intval($_POST['article_id']);

  $link = new DataBase();
  $article_data = $link->__SQLSELECT('articles', 'article_id', $article_id);
  echo json_encode($article_data);

?>
