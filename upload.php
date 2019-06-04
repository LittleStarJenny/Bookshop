<?php
include_once 'header.php';
include_once 'index.php';
include_once 'classes/class.php';

// check if submit is set
if (isset($_POST['submit'])) {
   //csv-file details
    $files = $_FILES['file'];
    $file = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    //explode the file
    $fileExt = explode('.', $file);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('csv');

    //give file a unique name
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 5000) {
                $new_file = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'upload/' . $new_file;
                move_uploaded_file($fileTmpName, $fileDestination);

                //new object from upload and send us to pay.php if everything is fine
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
        echo 'Kunde inte ladda upp filen!';
    }
} 
?>
