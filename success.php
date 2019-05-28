<?php

include_once 'classes/upload.php';
include_once 'classes/api.php';


  if(!empty($_GET['tid'] && !empty($_GET['product']))) {
    $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);

    $tid = $GET['tid'];
    $product = $GET['product'];
  } else {
    header('Location: index.php');
  }

  $obj = new Upload();
  $get = $obj->getId();
  //var_dump($get->fileNameNew);

  $file_handler = fopen('upload/' . $get->new_file, 'r');
  $fread = fread($file_handler, filesize('upload/' . $get->new_file));
  fclose($file_handler);
  //var_dump($fread);

  $isbnArray = explode(',', $fread);
  //var_dump($isbnArray);

  $obj2 = new Api();
  $jsonData = $obj2->getApi($isbnArray);
  //var_dump($jsonData);

 foreach ($jsonData as $data) {
  $books[] = [$data['isbn'], $data['title'], $data['author_id']];
 }
 //var_dump($books);

  if ($books) {
    $file_to_write = fopen('newfiles/' . $get->new_file, 'w');
    $download = true;
    foreach ($books as $book) {
      $book = fill_book($book);
        $download = $download && fputcsv($file_to_write, $book);
    }
    fclose($file_to_write);
    if ($download) {
        echo '<a href= " ' . 'newfiles/' . $get->new_file . '">Download here</a>';
    } else {
        echo 'Couldnt fill in books!';
    }
}
  function fill_book($book)
   {
      //var_dump($book);
      $newBook = [];
      $newBook[0] = $book[0];
      $newBook[1] = $book[1];
      $newBook[2] = $book[2];
      return $newBook;

    //var_dump($book);
  }

  foreach ($books as $book) {
    $book = fill_book($book);
  ?>
    <table>
    <tr>
    <td><?php echo $book[0]?></td>
    <td><?php echo $book[1]?></td>
    <td><?php echo $book[2]?></td>
    </tr>
    </table>
  <?php
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Thank You</title>
</head>
<body>
  <div class="container mt-4">
    <h2>Thank you for purchasing <?php echo $product; ?></h2>
    <hr>
    <p>Your transaction ID is <?php echo $tid; ?></p>
    <p>Check your email for more info</p>
    <p><a href="index.php" class="btn btn-light mt-2">Go Back</a></p>
    <p><a href="download.php" class="btn btn-light mt-2">Download</a></p>

  </div>
</body> 
</html>