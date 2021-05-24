<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Get ID
  $post->DepartmentID = isset($_GET['DepartmentID']) ? $_GET['DepartmentID'] : die();

  // Get post
  $post->read_single();

  // Create array
  $post_arr = array(
    'DepartmentID' => $post->DepartmentID,
    'DepartmentName' => $post->DepartmentName,
    
  );

  // Make JSON
  print_r(json_encode($post_arr));