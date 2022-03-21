<?php

  if (isset($_POST['login-button'])) {
    $user_login = $_POST['user_login'];
    $user_password = $_POST['user_password'];

    if (isset($_POST['user_remember'])) {
      setcookie('cookie_uid', $user_login, time() + (86400 * 1));
      setcookie('cookie_pwd', $user_password, time() + (86400 * 1));
    } else {
      setcookie('cookie_uid', '');
      setcookie('cookie_pwd', '');
    }

    $login = new LogIn($user_login, $user_password);
    $login->__login($link->__dbconnect());
  }

?>
