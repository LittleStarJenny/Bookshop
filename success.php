<?php
include_once 'classes/class.php';
include_once 'header.php';

  $upload = new Upload();
  $get = $upload->getId();
  $file_handler = fopen('upload/' . $get->new_file, 'r');
    $fread = fread($file_handler, filesize('upload/' . $get->new_file));
  fclose($file_handler);
 
  $isbnArray = explode(',', $fread);
  $keys = array_keys($isbnArray);


  for($i=0; $i < count($keys); ++$i) {

  $api = new Api();
  $books = $api->getBooks();

  $auth = new Api();
  $authors = $auth->getAuthor();

  $publ = new Api();
  $publishers = $publ->getPublisher();

  ?>
  <main>
      <table class="table2">
    <tbody>
      <tr>
      <?php foreach ($books as $book) {
              foreach ($authors as $author) {   
                foreach ($publishers as $publisher) {
    $isbn = $book->isbn;
    $title = $book->title;
    $author_id = $book->author_id;
    $publisher_id = $book->publisher_id;
    $authId = $author->id;
    $firstName = $author->firstName;
    $lastName = $author->lastName;
    $name = $publisher->name;
    $publId = $publisher->id;
            if($isbnArray[$keys[$i]] == $isbn) { 
                if($author_id == $authId) {
                  if($publisher_id == $publId){?>
      
      <td><?php echo $isbn?></td>
      <td><?php echo $title?></td>
      <td><?php echo $firstName,'&nbsp;', $lastName?></td>
      <td><?php echo $name?></td>
      </tr>
    </tbody>
      </table>
  </main>
<?php 
  $bookarray=array($isbn, $title, $firstName, $lastName, $name);
  
    foreach ($books as $book) {
      foreach ($authors as $author) {   
        foreach ($publishers as $publisher)
    if ($bookarray) {
        $file_to_write = fopen('newfiles/' . $get->new_file, 'w');
        $download = true;   
        $download = $download && fputcsv($file_to_write, $bookarray);
    }
    fclose($file_to_write);
}}
                  }
  }}}}}}
  ?>

  <title>Thank You</title>
</head>
<body>
  <div class="container mt-4">
    <hr>

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