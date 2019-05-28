
<?php

include_once 'downloadcsv.php';

//import.php

if(!empty($_FILES['csv_file']['name']))
{
 $file_data = fopen($_FILES['csv_file']['name'], 'r');
 fgetcsv($file_data);
 while($row = fgetcsv($file_data))
 {
  $data[] = array(
   'ISBN'  => $row[0],
   'Title'  => $row[1],
   'Author'  => $row[2]
  );

}
 echo json_encode($data);
}



        



        ?>