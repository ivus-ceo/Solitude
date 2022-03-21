<?php

  class LogOut {

    function __logout(object $link, bool $logout) {
      if (isset($_SESSION['id']) && isset($logout) && $logout == TRUE) {
        /* SQL query */
        $sql = "UPDATE users SET user_online=:user_online WHERE user_id=:user_id";
        /* Binding params */
        $data = array(
          ':user_online' => time(),
          ':user_id' => $_SESSION['id']
        );
        /* Preparing and executing method */
        $stmt = $link->prepare($sql);
        $stmt->execute($data);
        /* Close prepared statement */
        $stmt = null;
        /* Starting session */
        session_start();
        /* Unset session */
        session_unset();
        /* Destroy session */
        session_destroy();
        /* Close connection */
        $link = null;

        header("Location: ./");
        exit();
      } else {
        header("Location: ./?error=something-went-wrong&logout=true");
        exit();
      }
    }

  }

?>
