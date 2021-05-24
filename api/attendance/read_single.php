<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/attendance.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $attendance = new attendance($db);

  // Get ID
  $attendance->AttendanceId = isset($_GET['AttendanceId']) ? $_GET['AttendanceId'] : die();

  // Get employee
  $attendance->read_single();

  // Create array
  $post_arr = array(
    'AttendanceId' => $attendance->AttendanceId,
    'EmpId' => $attendance->EmpId,
    'RecordDate' => $attendance->RecordDate,
    'Time_In' => $attendance->Time_In,
    'Time_Out' => $attendance->Time_Out
    
  );

  // Make JSON
  print_r(json_encode($post_arr));