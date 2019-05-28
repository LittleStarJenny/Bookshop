<?php

include_once 'lib/pdo_db.php';

class Upload {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function setFile($new_file, $file) {
      // Prepare Query
      $this->db->query("INSERT INTO paypage.uploadedcsv (new_file, file) VALUES (:new_file, :file)");

      // Bind Values
      $this->db->bind(':new_file', $new_file);
      $this->db->bind(':file', $file);

      // Execute
      if($this->db->execute()) {
        return true;
      } else {
        return false;
      }
        }

    public function getId() {
        // Prepare Query
        $this->db->query('SELECT new_file FROM uploadedcsv ORDER BY csvId DESC LIMIT 1');
        $stmt = $this->db->single();

        // Execute
        if($this->db->execute()) {
          return $stmt;
        } else {
          return false;
        }
      }

}