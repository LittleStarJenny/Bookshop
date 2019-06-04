<?php 

include_once 'lib/pdo_db.php';

//create class to all API-calls
class Api {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }
//create method to retrieve data from API
public function getBooks($isbn) {
  $book = [];
  $book[0] = $isbn;
  $url = 'https://5ce8007d9f2c390014dba45e.mockapi.io/books/' ."$isbn";

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

  $result = curl_exec($ch);

curl_close($ch);
      $b = json_decode($result);

    $book[1] = $b->title ?? 'Hittar ingen matchning';
    $book[2] = $b->author_id ?? '';
  
      $id = $book[2];

  if (isset($id))
  { 
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    
    curl_setopt($ch, CURLOPT_URL, 'https://5ce8007d9f2c390014dba45e.mockapi.io/authors/' ."$id");
    $result = curl_exec($ch);
    curl_close($ch);

        $a = json_decode($result);

       
    $book[2] = $a->firstName ?? ''; 
    $book[3] = $a->lastName ?? '';
     
    }

    $book[4] = $b->publisher_id ?? '';
    
    $p_id = $book[4];

    if(isset($p_id)) {

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

      curl_setopt($ch, CURLOPT_URL, 'https://5ce8007d9f2c390014dba45e.mockapi.io/publishers/' ."$p_id");
      $result = curl_exec($ch);
      curl_close($ch);

          $p = json_decode($result);
    
          $book[4] = $p->name ?? '';
    }
        return $book;
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
//create class to Upload file
  class Upload {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    //method to insert the cvs-file into database
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

//method to get last inserted id from database
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