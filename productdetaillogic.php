<?php require('connectsession.php'); ?>
<?php
  // product-detail.php

  if (isset($_GET['product'])) {
    $productId = $_GET['product'];
    $_SESSION['productID'] = $productId;
  }
  $productId = $_SESSION['productID'];
  $selectProduct = 'SELECT * FROM PRODUCT WHERE PRODUCT_ID = :productId';
  $prodDetailStmt = oci_parse($conn, $selectProduct);
  oci_bind_by_name($prodDetailStmt, ':productId', $productId);
  oci_execute($prodDetailStmt);
  $product = oci_fetch_array($prodDetailStmt,OCI_ASSOC);
  $productdetails = $product['PRODUCT_DETAIL'];
  $price = $product['PRICE'];
  $image = $product['PRODUCT_IMG'];
  $shopId = $product['SHOP_ID'];
  $productName = $product['PRODUCT_NAME'];
  $pquantity = $product['QUANTITY'];


  $selectShop = 'SELECT SHOP_NAME FROM SHOP WHERE SHOP_ID = :shopId';
  $shopStmt = oci_parse($conn, $selectShop);
  oci_bind_by_name($shopStmt, ':shopId', $shopId);
  oci_execute($shopStmt);

  $shop = oci_fetch_array($shopStmt, OCI_ASSOC);
  $shopName = $shop['SHOP_NAME']; 
?>

<?php 

// Handle form submission
if (isset($_POST['add_to_cart'])) {
  if (!isset($_SESSION['id'])) {
    // User is not logged in
    echo "<script>alert('Please login to add items to cart')</script>";
    return;
  } if ($pquantity == 0) {
    echo "<script>alert('Product is out of stock')</script>";
    return;
  } if ($_POST['p_quantity'] > $pquantity) {
    echo "<script>alert('Quantity exceeds stock')</script>";
    return;
  } 
  echo "Add to cart button clicked";
  // Retrieve form data
  $quantity = $_POST['p_quantity'];
  $userId = $_SESSION['id']; // Assuming you have stored the user ID in the session
  $amount = $price * (int)$quantity;

  // Check if the user has a cart
  $cartQuery = 'SELECT CART_ID FROM CART WHERE USER_ID = :userId';
  $cartStmt = oci_parse($conn, $cartQuery);
  oci_bind_by_name($cartStmt, ':userId', $userId);
  oci_execute($cartStmt);
  $cartRow = oci_fetch_array($cartStmt, OCI_ASSOC);

  // Retrieve the cart ID
  if ($cartRow) {
      $cartId = $cartRow['CART_ID'];
      $_SESSION['cartID'] = $cartId;

       // Update the existing cart with the new product information
      $updateCartQuery = "UPDATE CART SET AMOUNT = AMOUNT + :amount, PRODUCT_QUANTITY = PRODUCT_QUANTITY + :quantity, STATUS = 'ACTIVE' WHERE CART_ID = :cartId";
      $updateCartStmt = oci_parse($conn, $updateCartQuery);
      oci_bind_by_name($updateCartStmt, ':amount', $amount);
      oci_bind_by_name($updateCartStmt, ':quantity', $quantity);
      oci_bind_by_name($updateCartStmt, ':cartId', $cartId);
      oci_execute($updateCartStmt);

  } else {
      // Generate a new cart ID
      $randomcartId = rand(1, 999) + rand(999, 9998) + rand(9999, 99999);
      $cartId = $randomcartId;
      $_SESSION['cartID'] = $cartId;
      echo $userId;

      // Create a new cart entry for the user
      $insertCartQuery = "INSERT INTO CART (CART_ID, AMOUNT, PRODUCT_QUANTITY, USER_ID, STATUS) VALUES ('$cartId','$amount', '$quantity', :userId, 'ACTIVE')";
      $insertCartStmt = oci_parse($conn, $insertCartQuery);
      oci_bind_by_name($insertCartStmt, ':userId', $userId);
      oci_execute($insertCartStmt);
      
      // Get the newly generated cart ID
      // $cartId = oci_last_insert_id($conn);
  }

  // Check if the cart product table already has the product
  $cartProductQuery = "SELECT * FROM CART_PRODUCT WHERE PRODUCT_ID = :productId AND CART_ID = :cartId";
  $cartProductStmt = oci_parse($conn, $cartProductQuery);
  oci_bind_by_name($cartProductStmt, ':productId', $productId);
  oci_bind_by_name($cartProductStmt, ':cartId', $cartId);
  oci_execute($cartProductStmt);
  $cartProductRow = oci_fetch_array($cartProductStmt, OCI_ASSOC);

  if ($cartProductRow) {
    // Update the existing cart product entry
    $updateCartProductQuery = "UPDATE CART_PRODUCT SET QUANTITY = QUANTITY + :quantity WHERE PRODUCT_ID = :productId AND CART_ID = :cartId";
    $updateCartProductStmt = oci_parse($conn, $updateCartProductQuery);
    oci_bind_by_name($updateCartProductStmt, ':quantity', $quantity);
    oci_bind_by_name($updateCartProductStmt, ':productId', $productId);
    oci_bind_by_name($updateCartProductStmt, ':cartId', $cartId);
    oci_execute($updateCartProductStmt);
  } else {
    // Insert a new entry into the cart product table
    $insertProductQuery = "INSERT INTO CART_PRODUCT (PRODUCT_ID, QUANTITY, CART_ID) VALUES (:productId, '$quantity', :cartId)";
    $insertProductStmt = oci_parse($conn, $insertProductQuery);
    oci_bind_by_name($insertProductStmt, ':productId', $productId);
    oci_bind_by_name($insertProductStmt, ':cartId', $cartId);
    oci_execute($insertProductStmt);
  }

  header('Location: cart.php');
  exit();
}

?>

<?php
// Check if the review form is submitted
if (isset($_POST['itemsubmit']) && isset($_SESSION['id'])) {
    // Retrieve the form data
    $comment = $_POST['review'];
    $productIddd = $_SESSION['productID'];
    $userIdd = $_SESSION['id'];
    $uniqueId = rand(10000,90000) + rand(100,900) + rand(0,10);
    $ratingval = "True";
    // $productIddd = $_SESSION['productID'];
    // echo $uniqueId . '<br>';
    // echo $ratingvals . '<br>';
    // echo $uniqueId . '<br>';
    // echo $uniqueId . '<br>';
    // Perform the database insertion
    $insertReview = "INSERT INTO REVIEW (REVIEW_ID, COMMENTT, RATING, PRODUCT_ID, USER_ID) VALUES (:reviewIdd, :commentt, :ratingvals, :productIdd, :userIdd)";
    $reviewStmt = oci_parse($conn, $insertReview);
    oci_bind_by_name($reviewStmt, ':reviewIdd', $uniqueId);
    oci_bind_by_name($reviewStmt, ':ratingvals', $ratingval);
    oci_bind_by_name($reviewStmt, ':commentt', $comment);
    oci_bind_by_name($reviewStmt, ':productIdd', $productIddd);
    oci_bind_by_name($reviewStmt, ':userIdd', $userIdd);

    $reviewResult = oci_execute($reviewStmt);
}

if (isset($_POST['add_to_wishlist'])) {
  $wishlistID = rand(10000,90000) + rand(100,900) + rand(0,10); 
  $userID = $_SESSION['id'];

  $sql = "INSERT INTO WISHLIST (WISHLIST_ID, PRODUCT_QUANTITY, PRODUCT_ID, USER_ID)
          VALUES (:wishlistId, :quantity, :productId, :userId)";
  
  $stmt = oci_parse($conn, $sql);

  oci_bind_by_name($stmt, ':wishlistId', $wishlistID);
  oci_bind_by_name($stmt, ':quantity', $pquantity);
  oci_bind_by_name($stmt, ':productId', $productId);
  oci_bind_by_name($stmt, ':userId', $userID);

  $result = oci_execute($stmt);
  
  header('Location: wishlist.php');
  exit();
}

if (isset($_POST))

?>