<?php
class Post {
    // DB stuff
    private $conn;
    private $table = 'department';

    // Post Properties
    public $DepartmentID;
    public $DepartmentName;
    

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT * FROM ' .$this->table;
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    public function read_single() {
      // Create query
      $query = 'SELECT * FROM ' .$this->table.' WHERE DepartmentID=?';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->DepartmentID);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // Set properties
      $this->DepartmentID = $row['DepartmentID'];
      $this->DepartmentName = $row['DepartmentName'];
     
}

public function create() {
  // Create query
  $query = 'INSERT INTO ' . $this->table . ' SET DepartmentName = :DepartmentName';

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->DepartmentName = htmlspecialchars(strip_tags($this->DepartmentName));
  

  // Bind data
  $stmt->bindParam(':DepartmentName', $this->DepartmentName);
  

  // Execute query
  if($stmt->execute()) {
    return true;
}

// Print error if something goes wrong
printf("Error: %s.\n", $stmt->error);

return false;
}

public function update() {
  // Create query
  $query = 'UPDATE ' . $this->table . ' SET DepartmentName = :DepartmentName WHERE DepartmentID = :DepartmentID';

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->DepartmentName = htmlspecialchars(strip_tags($this->DepartmentName));
  $this->DepartmentID = htmlspecialchars(strip_tags($this->DepartmentID));

  // Bind data
  $stmt->bindParam(':DepartmentName', $this->DepartmentName);
  $stmt->bindParam(':DepartmentID', $this->DepartmentID);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: %s.\n", $stmt->error);

  return false;
}

public function delete() {
  // Create query
  $query = 'DELETE FROM ' . $this->table . ' WHERE DepartmentID = :DepartmentID';

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->DepartmentID = htmlspecialchars(strip_tags($this->DepartmentID));

  // Bind data
  $stmt->bindParam(':DepartmentID', $this->DepartmentID);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: %s.\n", $stmt->error);

  return false;
}

public function delete_get() {
  // Create query
  $query = 'DELETE FROM ' . $this->table . ' WHERE DepartmentID=?';

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->DepartmentID = htmlspecialchars(strip_tags($this->DepartmentID));

  // Bind data
  $stmt->bindParam(1, $this->DepartmentID);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: %s.\n", $stmt->error);

  return false;
}

}