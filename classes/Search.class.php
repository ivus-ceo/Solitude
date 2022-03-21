<?php

  class Search {
    /* Search in db method */
    function __search(object $link, string $search_query, array $search_advanced_query = null) {

      if (isset($search_query) && isset($_POST)) {
        $search_query_wrapped = "%{$search_query}%";
        /* SQL query */
        $sql = "SELECT article_title FROM articles WHERE article_title LIKE ?";
        /* Binding params */
        $data = [
          $search_query_wrapped
        ];
        /* Preparing and executing method */
        $stmt = $link->prepare($sql);
        $stmt->execute($data);
        /* Query data from table */
        $row = [];

        for ($i=0; $i < $stmt->rowCount(); $i++) {
          $row[$i] = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        echo json_encode($row);

        $link = null;
      } else {
        header('Location: ./?error=query-is-empty&search=true');
        exit();
      }

    }

  }


?>
