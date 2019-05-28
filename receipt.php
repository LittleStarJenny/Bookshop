<?php
include_once 'header.php';

include_once 'downloadcsv.php';



// // Open the file for reading
// if(isset($_POST['upload'])) {
// if(!empty($_FILES['csv_file']['name']))
// {
    
//  $file_data = fopen($_FILES['csv_file']['name'], 'r');
//  fgetcsv($file_data);
 
//     // Read one line from the csv file, use comma as separator
//     while($row = fgetcsv($file_data))
    
//     {
//      $data[] = array(
//       'ISBN'  => $row[0],
//       'Title'  => $row[1],
//       'Author'  => $row[2]
//      );
//      var_dump($data); echo "<br>";  echo "<br>";
//      var_dump($book->isbn);
//      foreach ($books as $book) {
//         if($data == $book->isbn) {
//            // echo $book->isbn;
//      echo $book->title;
//      echo $book->author_id;}
//             else {
//                 echo 'you´re a mistake';
//             }
//         }
//     // var_dump($row[0]);
//    }
//     // Close the file
//     fclose($file_data);
// }

// }
?>
 <body>
  <div class="container">
   <br />
   <h3 align="center">Import CSV File into Jquery Datatables using PHP Ajax</h3>
   <br />
   <form id="upload_csv" method="post" action="receipt.php" enctype="multipart/form-data">
    <div class="col-md-3">
     <br />
     <label>Add More Data</label>
    </div>  
                <div class="col-md-4">  
                   <input type="file" name="csv_file" id="csv_file" accept=".csv" style="margin-top:15px;" />
                </div>  
                <div class="col-md-5">  
                    <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                </div>  
                <div style="clear:both"></div>
   </form>
   <br />
   <br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered" id="data-table">
     <thead>
      <tr>
       <th>ISBN</th>
       <th>Title</th>
       <th>Author</th>

      </tr>
     </thead>
    </table>
   </div>
  </div>
 </body>
</html>

