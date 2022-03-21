<?php

  class LogIn {

    private $user_login;
    private $user_password;

    function __construct(string $user_login, string $user_password) {
      $this->user_login = str_replace(' ', '', $user_login);
      $this->user_password = str_replace(' ', '', $user_password);
    }

    function __login(object $link) {

      if (empty($this->user_login) || empty($this->user_password)) {
        header('Location: ./?error=empty-fields&login=true');
        exit();
      } elseif (!preg_match('/^[a-zA-Z0-9]/', $this->user_login)) {
        header('Location: ./?error=invalid-login&login=true');
        exit();
      } else {
        /* SQL query */
        $sql = "SELECT * FROM users WHERE user_uid=? OR user_email=?";
        /* Binding params */
        $data = [
          $this->user_login,
          $this->user_login
        ];
        /* Preparing and executing method */
        $stmt = $link->prepare($sql);
        $stmt->execute($data);

        if ($row = $stmt->rowCount() < 1) {
          header('Location: ./?error=user-not-found&login=true');
          exit();
        } else {
          /* SQL query */
          $sql = "SELECT * FROM users WHERE user_uid=? OR user_email=?";
          /* Binding params */
          $data = [
            $this->user_login,
            $this->user_login
          ];
          /* Preparing and executing method */
          $stmt = $link->prepare($sql);
          $stmt->execute($data);
          /* Query data from table */
          $row = $stmt->fetch(PDO::FETCH_OBJ);
          /* Check for password */
          $user_dehashed_password = password_verify($this->user_password, $row->user_pwd);

          if ($user_dehashed_password == FALSE) {
            header('Location: ./?error=wrong-password&login=true');
            exit();
          } elseif ($user_dehashed_password == TRUE) {
            /* SQL query */
            $sql = "UPDATE users SET user_online=:user_online WHERE user_id=:user_id";
            /* Binding params */
            $data = array(
              ':user_online' => time(),
              ':user_id' => $row->user_id
            );
            /* Preparing and executing method */
            $stmt = $link->prepare($sql);
            $stmt->execute($data);
            /* Close prepared statement */
            $stmt = null;
            /* Start the session */
            session_start();
            /* Parsing the query data */
            $_SESSION['id'] = $row->user_id;
            $_SESSION['user_name'] = $row->user_uid;
            $_SESSION['first_name'] = $row->user_name;
            $_SESSION['last_name'] = $row->user_last;
            $_SESSION['user_type'] = $row->user_type;
            /* Redirect to main page */
            header('Location: ./');
            exit();
          }
        }
      }
      /* Close connection to db */
      $link = null;
    }

  }

?>
