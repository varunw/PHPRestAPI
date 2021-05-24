<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
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

  $employee->EmployeeName = $data->EmployeeName;
  $employee->DepartmentId = $data->DepartmentId;
  $employee->DateOfJoining =date('Y-m-d',strtotime($data->DateOfJoining));
  $employee->Salary = $data->Salary;
  $employee->EmpAge = $data->EmpAge;
  

  // Create post
  if($employee->create()) {
    echo json_encode(
      array('message' => 'Post Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Created')
    );
  }