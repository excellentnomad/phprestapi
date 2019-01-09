<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Lesson.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $lesson = new Lesson($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to Delete
  $lesson->id = $data->id;

  // Delete post
  if($lesson->delete()) {
    // set response code - 200 ok
    http_response_code(200);
    echo json_encode( array('message' => 'Lesson deleted') );
  } else {
    // set response code - 503 service unavailable
    http_response_code(503);
    echo json_encode( array('message' => 'Lesson not deleted') );
  }
?>