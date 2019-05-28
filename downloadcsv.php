<?php  


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

}
json_encode($books);
print_r($books);

//curl_close($ch);




?>
