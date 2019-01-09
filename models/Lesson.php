<?php
  class Lesson {
    // DB Stuff
    private $conn;
    private $table = 'lesson';

    // Properties
    public $id;
    public $title;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get lessons
    public function read() {
      // Create query
      $query = 'SELECT
        id,
        title,
        created_at
      FROM
        ' . $this->table . '
      ORDER BY
        created_at DESC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Create Lesson
    public function create() {
      // Create Query
      $query = 'INSERT INTO ' .
        $this->table . '
      SET
        title = :title';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->title = htmlspecialchars(strip_tags($this->title));

      // Bind data
      $stmt-> bindParam(':title', $this->title);

      // Execute query
      if($stmt->execute()) {
        return true;
      }
      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
    }

     // Get Single Lesson
    public function read_single(){
      // Create query
      $query = 'SELECT
            id,
            title
          FROM
            ' . $this->table . '
        WHERE id = ?
        LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id = $row['id'];
      $this->title = $row['title'];
    }

    // Update Lesson
    public function update() {
      // Create Query
      $query = 'UPDATE ' .
        $this->table . '
      SET
        title = :title
        WHERE
        id = :id';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt-> bindParam(':title', $this->title);
      $stmt-> bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);

      return false;
    }

    // Delete Lesson
    public function delete() {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // clean data
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind Data
      $stmt-> bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }
      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
      return false;
    }
  }
?>