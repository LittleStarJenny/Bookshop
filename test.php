<?php
include_once 'classes/class.php';
$upload = new Upload();
$get = $upload->getId();
$file_handler = fopen('upload/' . $get->new_file, 'r');
  $fread = fread($file_handler, filesize('upload/' . $get->new_file));
fclose($file_handler);

$isbnArray = explode(',', $fread);

$keys = array_keys($isbnArray);

for($i=0; $i < count($keys); ++$i) {

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'https://5ce8007d9f2c390014dba45e.mockapi.io/books');
$result = curl_exec($ch);
    $books = json_decode($result);
    foreach ($books as $book) {
        $isbn = $book->isbn;
        $title = $book->title;
        $author = $book->author_id;
        if($isbnArray[$keys[$i]] == $isbn) {
            echo $title;
    }
}
}
?>