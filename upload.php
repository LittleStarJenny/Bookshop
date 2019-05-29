<?php
include_once 'header.php';
include_once 'index.php';
include_once 'classes/class.php';

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
        echo 'Kunde inte ladda upp filen!';
    }
} 
?>
