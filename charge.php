  <?php
  require_once('vendor/stripe/stripe-php/init.php');
  
  
  \Stripe\Stripe::setApiKey('sk_test_Tj9TAtN6z7sFfFB8JEAdwAPI00MGt594cB'); //YOUR_STRIPE_SECRET_KEY
  
  // Get the token from the JS script
  $token = $_POST['stripeToken'];
  
  
  if (isset($customer_id)) {
      try {
          // Use Stripe's library to make requests...
          $customer = \Stripe\Customer::retrieve($customer_id);
      } catch (\Stripe\Error\Card $e) {
          // Since it's a decline, \Stripe\Error\Card will be caught
          $body = $e->getJsonBody();
          $err  = $body['error'];
          print('Status is:' . $e->getHttpStatus() . "\n");
          print('Type is:' . $err['type'] . "\n");
          print('Code is:' . $err['code'] . "\n");
          // param is '' in this case
          print('Param is:' . $err['param'] . "\n");
          print('Message is:' . $err['message'] . "\n");
      } catch (\Stripe\Error\RateLimit $e) {
          // Too many requests made to the API too quickly
      } catch (\Stripe\Error\InvalidRequest $e) {
          // Invalid parameters were supplied to Stripe's API
      } catch (\Stripe\Error\Authentication $e) {
          // Authentication with Stripe's API failed
          // (maybe you changed API keys recently)
      } catch (\Stripe\Error\ApiConnection $e) {
          // Network communication with Stripe failed
      } catch (\Stripe\Error\Base $e) {
          // Display a very generic error to the user, and maybe send
          // yourself an email
      } catch (Exception $e) {
          // Something else happened, completely unrelated to Stripe
      }
  } else {
      try {
          // Use Stripe's library to make requests...
          $customer = \Stripe\Customer::create(array(
              'email' => 'rednalan23@gmail.com',
              'source' => $token,
          ));
      } catch (\Stripe\Error\Card $e) {
          // Since it's a decline, \Stripe\Error\Card will be caught
          $body = $e->getJsonBody();
          $err  = $body['error'];
          print('Status is:' . $e->getHttpStatus() . "\n");
          print('Type is:' . $err['type'] . "\n");
          print('Code is:' . $err['code'] . "\n");
          // param is '' in this case
          print('Param is:' . $err['param'] . "\n");
          print('Message is:' . $err['message'] . "\n");
      } catch (\Stripe\Error\RateLimit $e) {
          // Too many requests made to the API too quickly
      } catch (\Stripe\Error\InvalidRequest $e) {
          // Invalid parameters were supplied to Stripe's API
      } catch (\Stripe\Error\Authentication $e) {
          // Authentication with Stripe's API failed
          // (maybe you changed API keys recently)
      } catch (\Stripe\Error\ApiConnection $e) {
          // Network communication with Stripe failed
      } catch (\Stripe\Error\Base $e) {
          // Display a very generic error to the user, and maybe send
          // yourself an email
      } catch (Exception $e) {
          // Something else happened, completely unrelated to Stripe
      }
  }
  if (isset($customer)) {
    $charge_customer = true;
      // Charge the Customer instead of the card
      try {
          // Use Stripe's library to make requests...
          $charge = \Stripe\Charge::create(array(
              'amount' => 2000,
              'description' => 'Bribes to teacher',
              'currency' => 'sek',
              'customer' => $customer->id,
          ));
      } catch (\Stripe\Error\Card $e) {
          // Since it's a decline, \Stripe\Error\Card will be caught
          $body = $e->getJsonBody();
          $err  = $body['error'];
      
          print('Status is:' . $e->getHttpStatus() . "\n");
          print('Type is:' . $err['type'] . "\n");
          print('Code is:' . $err['code'] . "\n");
          // param is '' in this case
          print('Param is:' . $err['param'] . "\n");
          print('Message is:' . $err['message'] . "\n");
          $charge_customer = false;
      } catch (\Stripe\Error\RateLimit $e) {
          // Too many requests made to the API too quickly
      } catch (\Stripe\Error\InvalidRequest $e) {
          // Invalid parameters were supplied to Stripe's API
      } catch (\Stripe\Error\Authentication $e) {
          // Authentication with Stripe's API failed
          // (maybe you changed API keys recently)
      } catch (\Stripe\Error\ApiConnection $e) {
          // Network communication with Stripe failed
      } catch (\Stripe\Error\Base $e) {
          // Display a very generic error to the user, and maybe send
          // yourself an email
      } catch (Exception $e) {
          // Something else happened, completely unrelated to Stripe
      }
        if ($charge_customer) {
            header('location:success.php');
        }
    
      }
  
      ?>