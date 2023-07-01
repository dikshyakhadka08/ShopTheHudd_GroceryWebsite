
<?php
 require('connection.php');
 require('connectsession.php');
 include 'commonfunctions.php';
 print_r($_SESSION);
 $conn = oci_connect('Dikshya','Password123#','//localhost/xe');
 $traderID = $_SESSION['id'];
 $sqql = "SELECT * FROM PRODUCT WHERE USER_ID = '$traderID'";
 $resultt = oci_parse($conn, $sqql);
 oci_execute($resultt);
 $row = oci_fetch_array($resultt, OCI_ASSOC);
 $userID = $row['USER_ID'];
 $category = $row['CATEGORY_NAME'];
?>


<?php 
  if (isset($_POST["addbtn"]) && isset($_POST['acheckbox'])) {
    $productid = rand(100000, 999999) + rand(1000, 9999) + rand(100, 999); 
    $productname = inputdata($_POST['aproductname']);
    $productprice = inputdata($_POST['aproductprice']);
    $productquantity = inputdata($_POST['aproductqty']);
    $productdetail = inputdata($_POST['aproductdetail']);
    $allergyInfo = inputdata($_POST['aallergy-info']);
    if (isset($_POST['aimgurl'])) {
      $imageURL = $_POST['aimgurl'];
    } else if (isset($_POST['uimgurl'])) {
      $imageURL = $_POST['uimgurl'];
    } 
    $prodimg = $imageURL;
    $shopname = $_POST['shop'];
    echo "SHOP NAME:" . $shopname;

    // Write me a query to get the shop id given the shop name
    $getShopIdQuery = "SELECT SHOP_ID FROM SHOP WHERE SHOP_NAME = :shopName";
    $getShopIdStmt = oci_parse($conn, $getShopIdQuery);
    oci_bind_by_name($getShopIdStmt, ':shopName', $shopname);
    oci_execute($getShopIdStmt);
    $row = oci_fetch_array($getShopIdStmt, OCI_ASSOC);
    echo "ROW:" . $row;
    $shopID = $row['SHOP_ID'];
    echo "SHOP ID:" . $shopID;

    $insrtproduct = "INSERT INTO PRODUCT(PRODUCT_ID,PRODUCT_NAME,PRICE,QUANTITY,STOCK_STATUS,MIN_ORDER,MAX_ORDER,PRODUCT_DETAIL, ALLERGY_INFO,
    PRODUCT_IMG,CATEGORY_NAME,USER_ID,SHOP_ID) VALUES(:productid,:prodname,:prodprice,:productqty,'yes',0,20,:proddetail,:allergyinfo, :imgurl,:shoptype,:userid, '$shopID')";

    $qryexecute = oci_parse($conn, $insrtproduct);

    oci_bind_by_name($qryexecute, ':productid', $productid);
    oci_bind_by_name($qryexecute, ':prodname', $productname);
    oci_bind_by_name($qryexecute, ':prodprice', $productprice);
    oci_bind_by_name($qryexecute, ':productqty', $productquantity);
    oci_bind_by_name($qryexecute, ':allergyinfo', $allergyInfo);
    oci_bind_by_name($qryexecute, ':proddetail', $productdetail);
    oci_bind_by_name($qryexecute, ':imgurl', $prodimg);
    oci_bind_by_name($qryexecute, ':shoptype', $category);
    oci_bind_by_name($qryexecute, ':userid', $userID);

    $qryresult = oci_execute($qryexecute);

    if (!$qryresult) {
      $m = oci_error($qryexecute);
      trigger_error('Could not execute statement: ' . $m['message'], E_USER_ERROR);
    } else {
      echo "<script>alert('Product added successfully.')</script>";
    }

  } elseif (isset($_POST["updatebtn"]) && isset($_POST['ucheckbox'])) {
    $productname = inputdata($_POST['uproductname']);
    $productprice = inputdata($_POST['uproductprice']);
    $productquantity = inputdata($_POST['uproductqty']);
    $productdetail = inputdata($_POST['uproductdetail']);
    $allergyInfo = inputdata($_POST['uallergy-info']);
    $checkbox = $_POST['ucheckbox'];
    $prodimg = $imageURL;
    $porductID = $_SESSION['product-id'];
  
    $insrtproduct = "UPDATE PRODUCT SET PRODUCT_NAME = :prodname, PRICE = :prodprice, QUANTITY = QUANTITY + :productqty, CATEGORY_NAME = :shoptype, PRODUCT_DETAIL = :proddetail, ALLERGY_INFO = :allergyinfo WHERE product_id = '$porductID'";

    $qryexecute = oci_parse($conn, $insrtproduct);

    oci_bind_by_name($qryexecute, ':prodname', $productname);
    oci_bind_by_name($qryexecute, ':prodprice', $productprice);
    oci_bind_by_name($qryexecute, ':productqty', $productquantity);
    oci_bind_by_name($qryexecute, ':allergyinfo', $allergyInfo);
    oci_bind_by_name($qryexecute, ':proddetail', $productdetail);
    oci_bind_by_name($qryexecute, ':shoptype', $category);
  
    $qryresult = oci_execute($qryexecute);

    if ($qryresult) {
      echo "<script>alert('Product updated successfully.')</script>";
    }
  }


  if (isset($_GET['editProductId'])) {
    $editProductId = $_GET['editProductId'];

    // Retrieve the product details from the database based on the editProductId
    $selectProduct = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = $editProductId";
    $productResult = oci_parse($conn, $selectProduct);
    oci_execute($productResult);
    $row = oci_fetch_assoc($productResult);

    // Populate the form fields with the retrieved product details
    $productName = $row['PRODUCT_NAME'];
    $allergyInfo = $row['ALLERGY_INFO'];
    $productPrice = $row['PRICE'];
    $productQty = $row['QUANTITY'];
    $productDetail = $row['PRODUCT_DETAIL'];
    $_SESSION['shop-id'] = $row['SHOP_ID'];
    $_SESSION['product-id'] = $row['PRODUCT_ID'];
  }

  if (isset($_GET['deleteProductId'])) {
    $deleteProductId = $_GET['deleteProductId'];

    // Perform the deletion of the product from the database using the deleteProductId
    $deleteProductQuery = "DELETE FROM PRODUCT WHERE PRODUCT_ID = $deleteProductId";
    $deleteProductResult = oci_parse($conn, $deleteProductQuery);
    oci_execute($deleteProductResult);
    echo "<script>alert('Product deleted successfully.')</script>";
  }


?>

<?php
    if (isset($_POST['savechangesbtn'])) {
      $fullname = $_POST['fullname'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $contactNo = $_POST['contact_no'];
      $dob = $_POST['dob'];
    
      $sql = "UPDATE USERR
        SET FULLNAME = :fullname,
            USERNAME = :username,
            EMAIL = :email,
            CONTACT_NO = :contact_no,
            DOB = TO_DATE(:dob, 'YYYY-MM-DD')
        WHERE USER_ID = :user_id";

      $stmt = oci_parse($conn, $sql);

      oci_bind_by_name($stmt, ':fullname', $fullname);
      oci_bind_by_name($stmt, ':username', $username);
      oci_bind_by_name($stmt, ':email', $email);
      oci_bind_by_name($stmt, ':contact_no', $contactNo);
      oci_bind_by_name($stmt, ':dob', $dob);
      oci_bind_by_name($stmt, ':user_id', $userID);

      $result = oci_execute($stmt);

      echo '<script>User info updated successfully.</script>';

      if (isset($_POST['current-pwd']) && isset($_POST['new-pwd']) && isset($_POST['confirm-pwd'])) {
      $currentPassword = $_POST['current-pwd'];
      $newPassword = $_POST['new-pwd'];
      $confirmPassword = $_POST['confirm-pwd'];
      echo $currentPassword;
      echo $newPassword;
      // Verify if the current password matches the one in the database
      $verifyPasswordQuery = "SELECT PASSWORD FROM USERR WHERE USER_ID = :userId";
      $verifyPasswordStmt = oci_parse($conn, $verifyPasswordQuery);
      oci_bind_by_name($verifyPasswordStmt, ':userId', $userID);
      oci_execute($verifyPasswordStmt);
      $row = oci_fetch_assoc($verifyPasswordStmt);
      $storedPassword = $row['PASSWORD'];
      if (md5($currentPassword) == $storedPassword) {
        $hashedPassword = md5($newPassword);
        $updatePasswordQuery = "UPDATE USERR SET PASSWORD = :password WHERE USER_ID = :userId";
        $updatePasswordStmt = oci_parse($conn, $updatePasswordQuery);
        oci_bind_by_name($updatePasswordStmt, ':password', $hashedPassword);
        oci_bind_by_name($updatePasswordStmt, ':userId', $userID);
        oci_execute($updatePasswordStmt);
      } 
      
    }
    $getUser = "SELECT * FROM USERR WHERE USER_ID = $userID";
    $getCurrentUser = oci_parse($conn, $getUser);
    oci_execute($getCurrentUser);
    $newRow = oci_fetch_assoc($getCurrentUser);
    $statusbeginning = $newRow['STATUS'];
    $_SESSION['id'] = $newRow['USER_ID'];
    $_SESSION['email'] = $newRow['EMAIL'];
    $_SESSION['username'] = $newRow['USERNAME'];
    $_SESSION['fullname'] = $newRow['FULLNAME'];
    $_SESSION['password'] = $newRow['PASSWORD'];
    $_SESSION['role'] = inputdata($newRow['ROLE']);
    $_SESSION['status'] = $statusbeginning;
  }

  if (isset($_POST['deleteaccbtn'])) {
    $query = "DELETE * FROM USERR WHERE USER_ID = $userID";
    $deleteTrader = oci_parse($conn, $query);
    oci_execute($deleteTrader);
  }
  ?>