<?php
class db {
public $conn;
public $servername = "localhost";
public $username = "comp1640";
public $password = "Cdd8D7dFa8Xyn34b";
public $dbname = "comp1640";
public $statement;
function __construct(){
    
    try {
        $this->conn = new PDO("mysql:host=$this->servername;dbname=comp1640", $this->username, $this->password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
}
// Truy vấn database
public function query($sql) {
  $this->statement = $this->conn->prepare($sql);
  return $sql;
}

// Gán values
public function bind($parameter, $value, $type = null) {
  switch (is_null($type)) {
      case is_int($value):
          $type = PDO::PARAM_INT;
          break;
      case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
      case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
      default:
          $type = PDO::PARAM_STR;
  }
  return $this->statement->bindValue($parameter, $value, $type);
}

// Chạy truy vấn
public function execute() {
  return $this->statement->execute();
}

// Trả về mảng (Array)
public function resultSet() {
  $this->execute();
  return $this->statement->fetchAll(PDO::FETCH_OBJ);
}


// Trả về dữ liệu 
public function result() {
  $this->execute();
  return $this->statement->fetchAll(PDO::FETCH_ASSOC);
}


// Trả về một cột chỉ định theo Object
public function single() {
  $this->execute();
  return $this->statement->fetch(PDO::FETCH_OBJ);
}

// Đếm cột
public function rowCount() {
  return $this->statement->rowCount();
}

public function column() {
  $this->execute();
  return $this->statement->fetchColumn();
}


}


?>