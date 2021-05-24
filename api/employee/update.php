<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/employee.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $employee = new employee($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set DepartmentID to update
  $employee->EmpId = $data->EmpId;
  $employee->EmployeeName = $data->EmployeeName;
  $employee->DepartmentId = $data->DepartmentId;
  $employee->DateOfJoining = $data->DateOfJoining;
  $employee->Salary = $data->Salary;
  $employee->EmpAge = $data->EmpAge;

  

  // Update post
  if($employee->update()) {
    echo json_encode(
      array('message' => 'Post Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Updated')
    );
  }