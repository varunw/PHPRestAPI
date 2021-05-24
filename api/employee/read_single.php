<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/employee.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $employee = new employee($db);

  // Get ID
  $employee->EmpId = isset($_GET['EmpId']) ? $_GET['EmpId'] : die();

  // Get employee
  $employee->read_single();

  // Create array
  $post_arr = array(
    'EmpId' => $employee->EmpId,
    'EmployeeName' => $employee->EmployeeName,
    'DepartmentId' => $employee->DepartmentId,
    'DateOfJoining' => $employee->DateOfJoining,
    'Salary' => $employee->Salary,
    'EmpAge' => $employee->EmpAge
    
  );

  // Make JSON
  print_r(json_encode($post_arr));