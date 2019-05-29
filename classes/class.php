<?php 

include_once 'lib/pdo_db.php';

class Api {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

public function getBooks($isbnArray) {

    foreach ($isbnArray as $isbn) {
        // Set URL.
        $url = 'https://5ce8007d9f2c390014dba45e.mockapi.io/books/' . $isbn;
        // Create a curl instance.
        $ch = curl_init($url);
        // Setup curl options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Perform the request and get the response.
        $response = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($response, true);
    }
    return $json;
  }

public function getAuthor($isbnArray) {

  foreach ($isbnArray as $author_id) {
      // Set URL.
      $url = 'https://5ce8007d9f2c390014dba45e.mockapi.io/authors/' . $author_id;
      // Create a curl instance.
      $ch = curl_init($url);
      // Setup curl options
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // Perform the request and get the response.
      $response = curl_exec($ch);
      curl_close($ch);
      $json = json_decode($response, true);
  }
  return $json;
}
public function getPublisher($isbnArray) {

  foreach ($isbnArray as $publisher_id) {
      // Set URL.
      $url = 'https://5ce8007d9f2c390014dba45e.mockapi.io/publishers/' . $publisher_id;
      // Create a curl instance.
      $ch = curl_init($url);
      // Setup curl options
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // Perform the request and get the response.
      $response = curl_exec($ch);
      curl_close($ch);
      $json = json_decode($response, true);
  }
  return $json;
}
}

class Customer {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function addCustomer($data) {
      // Prepare Query
      $this->db->query('INSERT INTO customers (id, firstName, lastName, email) VALUES(:id, :firstName, :lastName, :email)');

      // Bind Values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':firstName', $data['firstName']);
      $this->db->bind(':lastName', $data['lastName']);
      $this->db->bind(':email', $data['email']);

      // Execute
      if($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function getCustomers() {
      $this->db->query('SELECT * FROM customers ORDER BY date DESC');

      $results = $this->db->resultset();

      return $results;
    } 
  }

  class Transaction {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function addTransaction($data) {
      // Prepare Query
      $this->db->query('INSERT INTO transactions (id, cId, product, amount, currency, status) VALUES(:id, :cId, :product, :amount, :currency, :status)');

      // Bind Values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':cId', $data['cId']);
      $this->db->bind(':product', $data['product']);
      $this->db->bind(':amount', $data['amount']);
      $this->db->bind(':currency', $data['currency']);
      $this->db->bind(':status', $data['status']);

      // Execute
      if($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function getTransactions() {
      $this->db->query('SELECT * FROM transactions ORDER BY date DESC');

      $results = $this->db->resultset();

      return $results;
    }
  } 

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
?>