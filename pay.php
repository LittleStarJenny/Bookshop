<?php 
include_once 'classes/class.php';
include_once 'header.php';
//create new object to get last inserted csv-file from database
 $obj = new Upload();
 $get = $obj->getId();

 //open and read the csv-file
  $file_handler = fopen('upload/' . $get->new_file, 'r');
  $fread = fread($file_handler, filesize('upload/' . $get->new_file));
  fclose($file_handler);

  // To split by newline
  $tmp = explode("\n", $fread); 
  // To split by *
  $data = array();
  for($i = 0; $i < count($tmp); $i++) {
      $data[] = explode(".", $tmp[$i]);
  }
?>
<body>
  <div class="container">
    <h2 class="my-4 text-center">Complete your purchase</h2>
    <?php //Echo file to table
    echo '<table class="table1">';
    foreach ($data as $row) {
      echo '<tr>';
      foreach ($row as $sr) {
        echo '<td>'.$sr.'</td>';
      }
      echo '</tr>';
    }
    echo '</table>';
    ?>
    <form action="./charge.php" method="post" id="payment-form">
      <div class="form-row">
       <input type="text" name="firstName" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="First Name">
       <input type="text" name="lastName" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Last Name">
       <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email Address">
        <div id="card-element" class="form-control">
          <!-- a Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors -->
        <div id="card-errors" role="alert"></div>
      </div>

      <button>Submit Payment</button>
    </form>
  </div> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="./js/charge.js"></script>
</body>
</html>