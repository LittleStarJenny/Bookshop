<?php 

include_once 'lib/pdo_db.php';

class Api {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

public function getApi($isbnArray) {

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

}
?>