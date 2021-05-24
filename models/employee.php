<?php
class employee {
    // DB stuff
    private $conn;
    private $table = 'employee';

    // Post Properties
    public $EmpId;
    public $EmployeeName;
    public $DepartmentId;
    public $DateOfJoining;
    public $Salary;
    public $EmpAge;
    

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
      $query = 'SELECT * FROM ' .$this->table.' WHERE EmpId=?';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->EmpId);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // Set properties
      $this->EmpId = $row['EmpId'];
      $this->EmployeeName = $row['EmployeeName'];
      $this->DepartmentId = $row['DepartmentId'];
      $this->DateOfJoining = $row['DateOfJoining'];
      $this->Salary = $row['Salary'];
      $this->EmpAge = $row['EmpAge'];
     
}

public function create() {
  // Create query
  $query = 'INSERT INTO ' . $this->table . ' SET EmployeeName = :EmployeeName, DepartmentId = :DepartmentId, DateOfJoining = :DateOfJoining, Salary = :Salary, EmpAge = :EmpAge';

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->EmployeeName = htmlspecialchars(strip_tags($this->EmployeeName));
  $this->DepartmentId = htmlspecialchars(strip_tags($this->DepartmentId));
  $this->DateOfJoining = htmlspecialchars(strip_tags($this->DateOfJoining));
  $this->Salary = htmlspecialchars(strip_tags($this->Salary));
  $this->EmpAge = htmlspecialchars(strip_tags($this->EmpAge));
  

  // Bind data
  $stmt->bindParam(':EmployeeName', $this->EmployeeName);
  $stmt->bindParam(':DepartmentId', $this->DepartmentId);
  $stmt->bindParam(':DateOfJoining', $this->DateOfJoining);
  $stmt->bindParam(':Salary', $this->Salary);
  $stmt->bindParam(':EmpAge', $this->EmpAge);
  

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
  $query = 'UPDATE ' . $this->table . ' SET EmployeeName = :EmployeeName, DepartmentId = :DepartmentId, DateOfJoining = :DateOfJoining, Salary = :Salary, EmpAge = :EmpAge WHERE EmpId = :EmpId';

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->EmpId = htmlspecialchars(strip_tags($this->EmpId));
  $this->EmployeeName = htmlspecialchars(strip_tags($this->EmployeeName));
  $this->DepartmentId = htmlspecialchars(strip_tags($this->DepartmentId));
  $this->DateOfJoining = htmlspecialchars(strip_tags($this->DateOfJoining));
  $this->Salary = htmlspecialchars(strip_tags($this->Salary));
  $this->EmpAge = htmlspecialchars(strip_tags($this->EmpAge));

  // Bind data
  $stmt->bindParam(':EmpId', $this->EmpId);
  $stmt->bindParam(':EmployeeName', $this->EmployeeName);
  $stmt->bindParam(':DepartmentId', $this->DepartmentId);
  $stmt->bindParam(':DateOfJoining', $this->DateOfJoining);
  $stmt->bindParam(':Salary', $this->Salary);
  $stmt->bindParam(':EmpAge', $this->EmpAge);
  

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
  $query = 'DELETE FROM ' . $this->table . ' WHERE EmpId = :EmpId';

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->EmpId = htmlspecialchars(strip_tags($this->EmpId));

  // Bind data
  $stmt->bindParam(':EmpId', $this->EmpId);

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
  $query = 'DELETE FROM ' . $this->table . ' WHERE EmpId=?';

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->EmpId = htmlspecialchars(strip_tags($this->EmpId));

  // Bind data
  $stmt->bindParam(1, $this->EmpId);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: %s.\n", $stmt->error);

  return false;
}

}