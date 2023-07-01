<?php
session_start();
require('connection.php'); 
//print_r($_SESSION);
$userid = $_SESSION['id'];

?>
<!DOCTYPE html>
<html>
<head>
  <titl>Token Page</title>
  <style>
    body {
      background-color: black;
      color: white;
      font-family: Arial, sans-serif;
      text-align: center;
    }
    
    .token-form {
      margin-top: 100px;
    }
    
    .token-input {
      padding: 10px;
      font-size: 16px;
    }
    
    .token-submit {
      margin-top: 10px;
      padding: 10px 20px;
      font-size: 16px;
      background-color: white;
      color: black;
      border: none;
      cursor: pointer;
    }
    
    .token-output {
      margin-top: 30px;
      font-size: 18px;
    }
  </style>
</head>
<body>
  <h1> Token Page </h1>


 
  
  <form class="token-form" method="POST">
    <input type="text" name="token" class="token-input" placeholder="Enter your token" autocomplete="off">
    <br>
    <input type="submit" value="Submit" name="submitt" class="token-submit">
  </form>
  <a href="logout.php"><button>Logout</button></a>
  
  <div class="token-output">
    <?php
$authCodes = array(
  "12345", "98765", "54321", "67890", "01234", "56789", "43210", "87654", "21098", "34567",
  "90123", "45678", "89012", "34567", "67890", "12345", "56789", "01234", "45678", "89012",
  "23456", "78901", "32109", "76543", "09876", "54321", "98765", "43210", "87654", "21098",
  "65432", "10987", "76543", "21098", "09876", "54321", "98765", "43210", "87654", "32109",
  "56789", "01234", "45678", "90123", "34567", "89012", "23456", "78901", "12345", "67890",
  "11111", "22222", "33333", "44444", "55555", "66666", "77777", "88888", "99999", "00000",
  // Add more values manually here
  "24680", "13579", "86420", "97531", "74103", "58246", "69357", "40718", "82963", "51479",
  "12312", "45645", "78978", "10101", "13131", "40404", "92929", "78787", "57575", "18181",
  "24681", "13579", "86421", "97531", "74103", "58246", "69357", "40718", "82963", "51479",
  "12313", "45646", "78979", "10102", "13132", "40405", "92930", "78788", "57576", "18182",
  // ... and so on
);
for ($i = 0; $i < 150; $i++) {
  $authCode = "";
  for ($j = 0; $j < 5; $j++) {
    $digit = mt_rand(0, 9);
    $authCode .= $digit;
  }
  $authCodes[] = $authCode;
}
$codes =[142223,32111,123743,561111,456111,987000,123670,653232];
$authCodes = array(
  "12345", "98765", "54321", "67890", "01234", "56789", "43210", "87654", "21098", "34567",
  "90123", "45678", "89012", "34567", "67890", "12345", "56789", "01234", "45678", "89012",
  "23456", "78901", "32109", "76543", "09876", "54321", "98765", "43210", "87654", "21098",
  "65432", "10987", "76543", "21098", "09876", "54321", "98765", "43210", "87654", "32109",
  "56789", "01234", "45678", "90123", "34567", "89012", "23456", "78901", "12345", "67890",
  "11111", "22222", "33333", "44444", "55555", "66666", "77777", "88888", "99999", "00000",
  // Add more values manually here
  "24680", "13579", "86420", "97531", "74103", "58246", "69357", "40718", "82963", "51479",
  "12312", "45645", "78978", "10101", "13131", "40404", "92929", "78787", "57575", "18181",
  "24681", "13579", "86421", "97531", "74103", "58246", "69357", "40718", "82963", "51479",
  "12313", "45646", "78979", "10102", "13132", "40405", "92930", "78788", "57576", "18182",
  // ... and so on
);
for ($i = 0; $i < 150; $i++) {
  $authCode = "";
  for ($j = 0; $j < 5; $j++) {
    $digit = mt_rand(0, 9);
    $authCode .= $digit;
  }
  $authCodes[] = $authCode;
}
    if (isset($_POST['submitt'])) {
      $token = $_POST['token'];

      if (in_array($token,$codes)){

        $sql = "UPDATE USERR SET STATUS = '1' WHERE user_id = :user_id";
        $updatestatus = oci_parse($conn, $sql);
        oci_bind_by_name($updatestatus, ':user_id', $userid);
        $result = oci_execute($updatestatus);

        if($result){

          $_SESSION['status'] = 1;

        }

        echo "<script>window.location.href = 'login.php'</script>";

        }
      
      else{
        echo "Wrong Token";

      }
    }
    ?>
  </div>
</body>
</html>
