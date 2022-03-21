<?php

  if (isset($_POST['file']) && isset($_FILES['file'])) {
    $upload = new Upload();
    $upload->__upload($link->__dbconnect(), 'media/uploads/', $_FILES['file']);
  }

?>
