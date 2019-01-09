<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=UTF-8');

  include_once '../../config/Database.php';
  include_once '../../models/Lesson.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate lesson object
  $lesson = new Lesson($db);

  // Category read query
  $result = $lesson->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any lessons
  if($num > 0) {
        // Cat array
        $lesson_arr = array();
        $lesson_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $lesson_item = array(
            'id' => $id,
            'name' => $name
          );

          // Push to "data"
          array_push($lesson_arr['data'], $lesson_item);
        }
        // set response code - 200 OK
        http_response_code(200);
        // Turn to JSON & output
        echo json_encode($lesson_arr);

  } else {
 
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user no lessons found
    echo json_encode(
        array("message" => "No products found.")
    );
  }
?>