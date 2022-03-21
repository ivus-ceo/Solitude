<?php

  class DataBase {
    private $dbServerName;
    private $dbUsername;
    private $dbPassword;
    private $dbName;
    private $dbCharset;

    function __dbconnect() {
      $this->dbServerName = "localhost";
      $this->dbUsername = "root";
      $this->dbPassword = "";
      $this->dbName = "solitude";
      $this->dbCharset = "utf8mb4";

      try {
        $dsn = 'mysql:host='.$this->dbServerName.';dbname='.$this->dbName.';charset='.$this->dbCharset;
        $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_EMULATE_PREPARES => false];
        $pdo = new PDO($dsn, $this->dbUsername, $this->dbPassword, $opt);
        return $pdo;
      } catch(PDOException $error) {
        die("Connection failed: ".$error->getMessage());
      }
    }

    function __SQLSELECT(string $db_table_name, $db_column_name = NULL, $db_search_name = NULL, $db_order_command = NULL) {
      if (empty($db_column_name) && empty($db_search_name) && empty($db_order_command)) {
        /* Create query */
        $sql = "SELECT * FROM $db_table_name";
      } elseif (is_array($db_column_name) && is_array($db_search_name)) {
        /* Turn imploded array into string */
        $db_imploded_name = implode('=? AND ', $db_column_name)."=?";
        /* Create query */
        $sql = "SELECT * FROM $db_table_name WHERE $db_imploded_name";
        /* Binding params */
        $data = $db_search_name;
      } elseif (!empty($db_order_command) && empty($db_column_name) && empty($db_search_name)) {
        //* Create query */
        $sql = "SELECT * FROM $db_table_name $db_order_command";
      } else {
        /* Create query */
        $sql = "SELECT * FROM $db_table_name WHERE $db_column_name=?";
        /* Binding params */
        $data = [
          $db_search_name
        ];
      }
      /* Preparing and executing method */
      $stmt = $this->__dbconnect()->prepare($sql);
      /* Proceed execution */
      if (empty($db_column_name) && empty($db_search_name) || !empty($db_order_command)) {
        $stmt->execute();
      } elseif (is_array($db_column_name) && is_array($db_search_name)) {
        $stmt->execute($data);
      } else {
        $stmt->execute($data);
      }
      /* Fetching data */
      if ($stmt->rowCount() > 1) {
        for ($i = 0; $i < $stmt->rowCount(); $i++) {
          $data[$i] = $stmt->fetch(PDO::FETCH_OBJ);
        }
      } else {
        $data = $stmt->fetch(PDO::FETCH_OBJ);
      }
      /* Close prepared statement */
      $stmt = null;
      /* Return data */
      return $data;
    }

    function __SQLUPDATE(string $db_table_name, $db_column_name, $db_data_name, $db_where_name = NULL) {
      if (!empty($db_column_name) && !empty($db_data_name) && !is_array($db_column_name) && !is_array($db_data_name)) {
        /* Create query */
        $sql = "UPDATE $db_table_name SET $db_column_name = ?";
        /* Binding params */
        $data = [
          $db_data_name
        ];
      } elseif (!empty($db_column_name) && !empty($db_data_name) && is_array($db_column_name) && is_array($db_data_name) && is_array($db_where_name)) {
        /* Turn imploded array into string */
        $db_imploded_column_name = implode('=?, ', $db_column_name)."=?";
        $db_imploded_where_name = implode('=', $db_where_name);
        /* Create query */
        $sql = "UPDATE $db_table_name SET $db_imploded_column_name WHERE $db_imploded_where_name";
        /* Binding params */
        $data = $db_data_name;
      }
      /* Preparing and executing method */
      $stmt = $this->__dbconnect()->prepare($sql);
      /* Proceed execution */
      $stmt->execute($data);
      /* Close prepared statement */
      $stmt = null;
    }
  }

?>
