<?php
class attendance {
    // DB stuff
    private $conn;
    private $table = 'attendance';

    // Post Properties
    public $AttendanceId;
    public $EmpId;
    public $RecordDate;
    public $Time_In;
    public $Time_Out;
    
    

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
      $query = 'SELECT * FROM ' .$this->table.' WHERE AttendanceId=?';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->AttendanceId);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // Set properties
      $this->AttendanceId = $row['AttendanceId'];
      $this->EmpId = $row['EmpId'];
      $this->RecordDate = $row['RecordDate'];
      $this->Time_In = $row['Time_In'];
      $this->Time_Out = $row['Time_Out'];
      
     
}

public function create() {
  // Create query
  $query = 'INSERT INTO ' . $this->table . ' SET AttendanceId = :AttendanceId, EmpId = :EmpId, RecordDate = :RecordDate, Time_In = :Time_In, Time_Out = :Time_Out';

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->AttendanceId = htmlspecialchars(strip_tags($this->AttendanceId));
  $this->EmpId = htmlspecialchars(strip_tags($this->EmpId));
  $this->RecordDate = htmlspecialchars(strip_tags($this->RecordDate));
  $this->Time_In = htmlspecialchars(strip_tags($this->Time_In));
  $this->Time_Out = htmlspecialchars(strip_tags($this->Time_Out));
  

  // Bind data
  $stmt->bindParam(':AttendanceId', $this->AttendanceId);
  $stmt->bindParam(':EmpId', $this->EmpId);
  $stmt->bindParam(':RecordDate', $this->RecordDate);
  $stmt->bindParam(':Time_In', $this->Time_In);
  $stmt->bindParam(':Time_Out', $this->Time_Out);
  

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
  $query = 'UPDATE ' . $this->table . ' SET RecordDate = :RecordDate, Time_In = :Time_In, Time_Out = :Time_Out WHERE AttendanceId = :AttendanceId';

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->AttendanceId = htmlspecialchars(strip_tags($this->AttendanceId));
  $this->RecordDate = htmlspecialchars(strip_tags($this->RecordDate));
  $this->Time_In = htmlspecialchars(strip_tags($this->Time_In));
  $this->Time_Out = htmlspecialchars(strip_tags($this->Time_Out));
 

  // Bind data
  $stmt->bindParam(':AttendanceId', $this->AttendanceId);
  $stmt->bindParam(':RecordDate', $this->RecordDate);
  $stmt->bindParam(':Time_In', $this->Time_In);
  $stmt->bindParam(':Time_Out', $this->Time_Out);
  
  

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
  $query = 'DELETE FROM ' . $this->table . ' WHERE AttendanceId = :AttendanceId';

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->AttendanceId = htmlspecialchars(strip_tags($this->AttendanceId));

  // Bind data
  $stmt->bindParam(':AttendanceId', $this->AttendanceId);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: %s.\n", $stmt->error);

  return false;
}

}