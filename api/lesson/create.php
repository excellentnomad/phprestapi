<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Lesson.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate lesson object
  $lesson = new Lesson($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $lesson->name = $data->name;

  // Create lesson
  if($lesson->create()) {
    echo json_encode(
      array('message' => 'Lesson Created Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Lesson Not Created')
    );
  }
