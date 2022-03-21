<?php
  declare(strict_types = 1);

  session_start();

  include '../includes/autoloader.php';

  $work_id = $_POST['work_id'];
  $work_time = $_POST['work_time'];
  $work_title = $_POST['work_title'];
  $work_description = $_POST['work_description'];

  $array_columns = array('work_time', 'work_title', 'work_description');
  $array_data = array($work_time, $work_title, $work_description);
  $array_where_update = array('id', $work_id);

  $link = new DataBase();
  $link->__SQLUPDATE('works', $array_columns, $array_data, $array_where_update);

?>
