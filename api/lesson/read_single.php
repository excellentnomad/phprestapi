<?php

  // required headers
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Lesson.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog lesson object
  $lesson = new Lesson($db);

  // Get ID
  $lesson->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get lesson
  $lesson->read_single();

  if ($lesson -> name != null) {
    // Create array
    $lesson_arr = array(
      'id' => $lesson->id,
      'name' => $lesson->name
    );
    // set response code - 200 OK
    http_response_code(200);
    // Make JSON
    print_r(json_encode($lesson_arr));
  } else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user lesson does not exist
    echo json_encode(array("message" => "Lesson does not exist."));
  }
?>