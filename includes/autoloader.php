<?php

  spl_autoload_register('__autoloader');

  function __autoloader($classname) {

    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    if (strpos($url, 'ajax') == TRUE) {
      $path = "../classes/";
    } else {
      $path = "classes/";
    }

    $extensiton = ".class.php";
    $complete_path = $path.$classname.$extensiton;

    if (!file_exists($complete_path)) {
      return false;
    }

    require_once $complete_path;
  }

?>
