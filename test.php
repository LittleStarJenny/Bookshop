<?php
include_once 'header.php';
include_once 'index.php';
include_once 'downloadcsv.php';

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    //print_r($_FILES);
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('csv');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 5000) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;

                $fileDestination = 'upload/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
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