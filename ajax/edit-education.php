<?php
  declare(strict_types = 1);

  session_start();

  include '../includes/autoloader.php';

  $education_id = $_POST['education_id'];
  $education_time = $_POST['education_time'];
  $education_title = $_POST['education_title'];
  $education_description = $_POST['education_description'];

  $array_columns = array('education_time', 'education_title', 'education_description');
  $array_data = array($education_time, $education_title, $education_description);
  $array_where_update = array('id', $education_id);

  $link = new DataBase();
  $link->__SQLUPDATE('education', $array_columns, $array_data, $array_where_update);

?>
