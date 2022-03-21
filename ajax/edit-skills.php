<?php
  declare(strict_types = 1);

  session_start();

  include '../includes/autoloader.php';

  $skill_id = $_POST['skill_id'];
  $skill_title = $_POST['skill_title'];
  $skill_description = $_POST['skill_description'];
  $skill_progresses = $_POST['skill_progresses'];

  $array_columns = array('user_skill_title', 'user_skill_description');
  $array_data = array($skill_title, $skill_description);
  $array_where_update = array('id', $skill_id);

  $link = new DataBase();
  $link->__SQLUPDATE('skills', $array_columns, $array_data, $array_where_update);

  for ($i = 0; $i < count($skill_progresses); $i++) {
    $array_columns = array('skill_title', 'skill_amount');
    $array_data = array($skill_progresses[$i][1], $skill_progresses[$i][2]);
    $array_where_update = array('id', $skill_progresses[$i][0]);

    $link->__SQLUPDATE('skills_progresses', $array_columns, $array_data, $array_where_update);
  }

?>
