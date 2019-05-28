<?php

include_once 'header.php';
include_once 'index.php';
include_once 'classes/upload.php';

if (isset($_POST['submit'])) {
    $files = $_FILES['file'];
    $file = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $file);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('csv');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 5000) {
                $new_file = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'upload/' . $new_file;
                move_uploaded_file($fileTmpName, $fileDestination);

                $obj = new Upload();
                $obj->setFile($new_file, $file);
                header('Location: pay.php?uploadsuccess');
            } else {
                echo 'Your file is too big';
            }
        }else {
            echo 'Error occured while upploading your file';
        }
    } else { 
        echo 'Couldn upload chosen file!';
    }
} 


?>


<!-- <!DOCTYPE html>
<html>
 <head>
  
  <link rel="stylesheet" href="style.css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="request.js"></script>

 </head>
 <body>
  <div class="container">
   <br />
   <h3 align="center">Import CSV File into Jquery Datatables using PHP Ajax</h3>
   <br />
   <form id="upload_csv" method="post" enctype="multipart/form-data">
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
      </tr>
     </thead>
    </table>
   </div>
  </div>
 </body>
</html> -->
