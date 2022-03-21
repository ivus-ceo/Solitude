<?php

  class User {

    function __getUser(object $link, int $user_id) {

      if (empty($user_id)) {
        return FALSE;
      } else {
        /* SQL query */
        $sql = "SELECT * FROM users WHERE user_id=?";
        /* Binding params */
        $data = [
          $user_id
        ];
        /* Preparing and executing method */
        $stmt = $link->prepare($sql);
        $stmt->execute($data);
        /* Fetching data */
        $user_data[] = $stmt->fetch(PDO::FETCH_OBJ);
        /* Close prepared statement */
        $stmt = null;
        return $user_data;
      }
      /* Close connection to db */
      $link = null;
    }

  }

?>
