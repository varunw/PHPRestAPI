<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/attendance.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $attendance = new attendance($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $attendance->AttendanceId = $data->AttendanceId;
  $attendance->EmpId = $data->EmpId;
  $attendance->RecordDate = $data->RecordDate;
  $attendance->Time_In = $data->Time_In;
  $attendance->Time_Out = $data->Time_Out;
  

  // Create post
  if($attendance->create()) {
    echo json_encode(
      array('message' => 'Post Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Created')
    );
  }