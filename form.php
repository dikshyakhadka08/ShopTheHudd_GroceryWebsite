<?php require('connectsession.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Paypal Integration Test</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 3px;
      background-color: #f9f9f9;
      cursor: not-allowed;
    }

    .form-submit {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #ffffff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    .form-submit:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Paypal Payment Page</h1>
    <form class="paypal" action="payments.php" method="post" id="paypal_form">
      <!-- <div class="form-group">
        <label class="form-label" for="collectionTime">Collection Time:</label>
        <input class="form-input" type="text" id="collectionTime" name="collectionTime" value="<?php echo $_SESSION['collectionTime']; ?>" readonly>
      </div>
      <div class="form-group">
        <label class="form-label" for="collectionDate">Collection Date:</label>
        <input class="form-input" type="text" id="collectionDate" name="collectionDate" value="<?php echo $_SESSION['collectionDate']; ?>" readonly>
      </div> -->
      <div class="form-group">
        <label class="form-label" for="totAmount">Total Amount:</label>
        <input class="form-input" type="text" id="totAmount" name="totAmount" value="<?php echo $_SESSION['totAmount']; ?>" readonly>
      </div>
      <input type="hidden" name="cmd" value="_xclick" />
      <input type="hidden" name="no_note" value="1" />
      <input type="hidden" name="lc" value="UK" />
      <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
      <input type="hidden" name="first_name" value="Customer's First Name" />
      <input type="hidden" name="last_name" value="Customer's Last Name" />
      <input type="hidden" name="payer_email" value="customer@example.com" />
      <input type="hidden" name="item_number" value="123456" />
      <input class="form-submit" type="submit" name="submit" value="Submit Payment" />
    </form>
  </div>
</body>
</html>
