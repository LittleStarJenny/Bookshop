<?php

include_once 'classes/class.php';
include_once 'header.php';

  if(!empty($_GET['tid'] && !empty($_GET['product']))) {
      $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);

      $tid = $GET['tid'];
      $product = $GET['product'];
  } else {
      header('Location: index.php');
  }

  $upload = new Upload();
  $get = $upload->getId();

  $file_handler = fopen('upload/' . $get->new_file, 'r');
    $fread = fread($file_handler, filesize('upload/' . $get->new_file));
  fclose($file_handler);
 
  $isbnArray = explode(',', $fread);

  $api = new Api();
  $jsonData = $api->getBooks($isbnArray);

 foreach ($jsonData as $data) {
  $books[] = [$data['isbn'], $data['title'], $data['author_id']];
 }

  if ($books) {
    $file_to_write = fopen('newfiles/' . $get->new_file, 'w');
    $download = true;
    foreach ($books as $book) {
      $book = fill_book($book);
        $download = $download && fputcsv($file_to_write, $book);
    }
    fclose($file_to_write);
}
  function fill_book($book) {  
      $newBook = [];
      $newBook[0] = $book[0];
      $newBook[1] = $book[1];
      $newBook[2] = $book[2];
      return $newBook;
    }
   foreach ($books as $book) {
      $book = fill_book($book);
  ?>
  <main>
      <table class="table2">
        <thead>
          <tr>
            <th>Book List</th>
          </tr>
    </thead>
    <tbody>
      <tr>
      <td><?php echo $book[0]?></td>
      <td><?php echo $book[1]?></td>
      <td><?php echo $book[2]?></td>
      </tr>
    </tbody>
      </table>
  </main>
<?php 
  }
  ?>

  <title>Thank You</title>
</head>
<body>
  <div class="container mt-4">
    <hr>
    <p>Your transaction ID is <?php echo $tid; ?></p>
    <p>Check your email for more info</p>
    <p><a href="index.php" class="btn btn-light mt-2">Go Back</a></p>
    <p>
      <?php
          if ($download) {
            echo '<a href= " ' . 'newfiles/' . $get->new_file . '" class="btn btn-light mt-2">Download here</a>';
        } else {
            echo 'Kunde inte fylla filen!';
        }
     ?>
  </div>
</body> 
</html>