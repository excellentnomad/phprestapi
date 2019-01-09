<?php
  // Headers
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  include_once '../../config/Database.php';
  include_once '../../models/Lesson.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $lesson = new Lesson($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $lesson->id = $data->id;

  $lesson->title = $data->title;

  // Update lesson
  if($lesson->update()) {
    // set response code - 200 ok
    http_response_code(200);
    echo json_encode(
      array('message' => 'Lesson Updated')
    );
  } else {
    http_response_code(503);
    echo json_encode(
      array('message' => 'Lesson not updated')
    );
  }
?>