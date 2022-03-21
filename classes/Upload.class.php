<?php

  class Upload {
    /* Upload method */
    function __upload(object $link, string $upload_file_path, array $upload_file) {

      if (isset($_FILES) && isset($_POST)) {
        /* name | tmp_name | size | error | type */
        $file_extension = explode('.', $upload_file['name']);
        $file_real_extension = strtolower(end($file_extension));
        /* Allowed extension of files */
        $allowed_to_upload = array('jpg', 'jpeg', 'png', 'gif');
        /* Check for allowed extension file */
        if (in_array($file_real_extension, $allowed_to_upload)) {
          if ($upload_file['error'] == 0) {
            if ($upload_file['size'] < 10000000) {
              $new_file_name = uniqid().'.'.$file_real_extension;
              $upload_file_path = 'media/uploads/'.$new_file_name;
              move_uploaded_file($upload_file['tmp_name'], $upload_file_path);
              /* SQL query */
              $sql = "UPDATE users SET user_image=? WHERE user_id=?";
              /* Binding params */
              $data = [
                $new_file_name,
                $_SESSION['id']
              ];
              /* Preparing and executing method */
              $stmt = $link->prepare($sql);
              $stmt->execute($data);

            } else {
              header('Location: ./?error=large-file-size?&upload=true');
              exit();
            }
          } else {
            header('Location: ./?error=file-upload&upload=true');
            exit();
          }
        } else {
          header('Location: ./?error=wrong-file-format&upload=true');
          exit();
        }
        /* Close connection to db */
        $link = null;
      } else {
        header('Location: ./?error=file-doesnt-exist&upload=true');
        exit();
      }

    }

  }


?>
