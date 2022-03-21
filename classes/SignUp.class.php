<?php

  class SignUp {

    private $user_sex;
    private $user_name;
    private $user_last;
    private $user_login;
    private $user_email;
    private $user_password;

    function __construct(string $user_sex, string $user_name, string $user_last, string $user_login, string $user_email, string $user_password) {
      $this->user_sex = str_replace(' ', '', $user_sex);
      $this->user_name = str_replace(' ', '', $user_name);
      $this->user_last = str_replace(' ', '', $user_last);
      $this->user_login = str_replace(' ', '', $user_login);
      $this->user_email = str_replace(' ', '', $user_email);
      $this->user_password = str_replace(' ', '', $user_password);
    }

    function __signup(object $link) {

      if (empty($this->user_name) || empty($this->user_last) || empty($this->user_login) || empty($this->user_email) || empty($this->user_password)) {
        header('Location: ./?error=empty-fields&signup=true');
        exit();
      } elseif (!filter_var($this->user_email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9-]/', $this->user_name)) {
        header('Location: ./?error=invalid-login-email&signup=true');
        exit();
      } elseif (!filter_var($this->user_email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ./?error=invalid-email&signup=true');
        exit();
      } elseif (!preg_match('/^[a-zA-Z0-9]/', $this->user_login)) {
        header('Location: ./?error=invalid-login&signup=true');
        exit();
      } else {
        /* SQL query */
        $sql = "SELECT * FROM users WHERE user_uid=? OR user_email=?";
        /* Binding params */
        $data = [
          $this->user_login,
          $this->user_email
        ];
        /* Preparing and executing method */
        $stmt = $link->prepare($sql);
        $stmt->execute($data);

        if ($row = $stmt->rowCount() > 0) {
          header('Location: ./?error=user-exists&signup=true');
          exit();
        } else {
          /* SQL query */
          $sql = "INSERT INTO users (user_status, user_ban, user_type, user_name, user_last, user_email, user_uid, user_pwd, user_sex, user_image, user_background) VALUES (:user_status, :user_ban, :user_type, :user_name, :user_last, :user_email, :user_uid, :user_pwd, :user_sex, :user_image, :user_background)";
          /* Binding params */
          $data = array(
            ':user_status' => 1,
            ':user_ban' => '',
            ':user_type' => 0,
            ':user_name' => $this->user_name,
            ':user_last' => $this->user_last,
            ':user_email' => $this->user_email,
            ':user_uid' => $this->user_login,
            ':user_pwd' => password_hash($this->user_password, PASSWORD_DEFAULT),
            ':user_sex' => $this->user_sex,
            ':user_image' => '',
            ':user_background' => ''
          );
          /* Preparing and executing method */
          $stmt = $link->prepare($sql);
          $stmt->execute($data);
          /* Close prepared statement */
          $stmt = null;

          /* Succesful executing! */
          header('Location: ./?error=no-errors&signup=success');
          exit();
        }
      }
      /* Close connection to db */
      $link = null;
    }

  }

?>
