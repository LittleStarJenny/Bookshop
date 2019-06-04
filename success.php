<?php
include_once 'classes/class.php';
include_once 'header.php';

  $upload = new Upload();
  $get = $upload->getId();

$api = new Api();

$books = [];

$books[0] = ['ISBN', 'Titel', 'Författare', '', 'Förlag'];

if ($file_handler = fopen('upload/' . $get->new_file, 'r')) 
{
  while($data = fgetcsv($file_handler, 0, ',')) 
  {
    $books[] = $api->getBooks($data[0]);  
  }
  fclose($file_handler);
    }
    if ($books)
    {
  $file_to_write = fopen('newfiles/' . $get->new_file, 'w');
  $download = true;
    foreach ($books as $book) 
   {
      $download = $download && fputcsv($file_to_write, $book);
   }
  fclose($file_to_write);
  }

  ?>
  <main><?php
      foreach ($books as $book) 
  {?> <table class="table2">
    <tbody>
      <tr>  
      <td><?php echo $book[0]?></td>
      <td><?php echo $book[1]?></td>
      <td><?php echo $book[2],'&nbsp;', $book[3]?></td>
      <td><?php echo $book[4]?></td>
      </tr>
    </tbody>
      </table>
  <?php }?>
  </main>

  <title>Thank You</title>
</head>
<body>
  <div class="container mt-4">
 
    <p>Din nedladdningsbara fil</p>
    <p>
      <?php
          if ($download) {
            echo '<a href= " ' . 'newfiles/' . $get->new_file . '" class="btn btn-light mt-2">Ladda ner här</a>';
        } else {
            echo 'Kunde inte fylla filen!';
        } ?>
      <p><a href="index.php" class="btn btn-light mt-2">Börja om</a></p>
  </div>
</body> 
</html>