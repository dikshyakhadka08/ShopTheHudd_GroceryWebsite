<?php  
  $conn = oci_connect('Dikshya','Password123#','//localhost/xe');
  if (isset($_SESSION['cartID'])) {
        $cartId = $_SESSION['cartID'];
        $userID = $_SESSION['id']; // Replace "your_cart_id" with the actual CART_ID value
        $sql = "SELECT P.PRODUCT_ID, P.PRODUCT_NAME, P.PRICE, P.QUANTITY, P.STOCK_STATUS, P.MAX_ORDER, P.PRODUCT_DETAIL, P.PRODUCT_IMG, P.SHOP_ID, P.CATEGORY_NAME, CP.QUANTITY
        FROM CART_PRODUCT CP
        JOIN PRODUCT P 
        ON 
        CP.PRODUCT_ID = P.PRODUCT_ID 
        WHERE CP.CART_ID = :cartId";

      $stmt = oci_parse($conn, $sql);

      oci_bind_by_name($stmt, ':cartId', $cartId);

      oci_execute($stmt);

      $numRows = oci_num_rows($stmt);

      // if ($numRows > 0) {
      //   while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
      //       print_r($row);
      //       // Access and process the retrieved data here
      //   }
      // } else {
      //     echo "No records found.";
      // }
  }

  if (isset($_POST['cartProductId'])) {
    $cartProductId = $_POST['cartProductId'];
    $quantity = $_POST['quantity'];
    echo "CODE REACHES HERE";
  
    // Update the quantity in the CART_PRODUCT table
    $updateQuantityQuery = 'UPDATE CART_PRODUCT
                            SET QUANTITY = :quantity
                            WHERE PRODUCT_ID = :productId AND CART_ID = :cartId';
  
    $updateQuantityStmt = oci_parse($conn, $updateQuantityQuery);
    oci_bind_by_name($updateQuantityStmt, ':quantity', $quantity);
    oci_bind_by_name($updateQuantityStmt, ':productId', $cartProductId);
    oci_bind_by_name($updateQuantityStmt, ':cartId', $_SESSION['cartID']);
    oci_execute($updateQuantityStmt);
  
    oci_free_statement($updateQuantityStmt);
  
    // Update the amount and product quantity in the CART table
    $updateCartQuery = 'UPDATE CART
                        SET AMOUNT = (SELECT SUM(p.PRICE * cp.QUANTITY) FROM CART_PRODUCT cp
                                      INNER JOIN PRODUCT p ON cp.PRODUCT_ID = p.PRODUCT_ID
                                      WHERE cp.CART_ID = :cartId),
                            PRODUCT_QUANTITY = (SELECT SUM(cp.QUANTITY) FROM CART_PRODUCT cp
                                                WHERE cp.CART_ID = :cartId)
                        WHERE CART_ID = :cartId';
  
    $updateCartStmt = oci_parse($conn, $updateCartQuery);
    oci_bind_by_name($updateCartStmt, ':cartId', $_SESSION['cartID']);
    oci_execute($updateCartStmt);
  
    oci_free_statement($updateCartStmt);
  
    // Send a response back to the client
    $response = [
        'status' => 'success',
        'message' => 'Cart updated successfully.'
    ];
  
    echo json_encode($response);
  } 
?>


<?php
// Assuming you have established the database connection

if (isset($_POST['checkout-btn'])) {
    $collectionDate = $_POST['hidden_collection_date'];
    $collectionTime = $_POST['collection_time'];
    $randomCID = rand(100000, 999999) + rand(1000, 9999) + rand(100, 999);
    $csID = $randomCID;
    echo $collectionDate;
    echo $collectionTime;
    $_SESSION['collectionDate'] = $collectionDate;
    $_SESSION['collectionTime'] = $collectionTime;
    $_SESSION['csID'] = $randomCID;

    $sql = "INSERT INTO COLLECTION_SLOT (CSLOT_ID,CSLOT_DAY, CSLOT_DATE) VALUES (:csID,:collectionTime, :collectionDate)";

    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':collectionDate', $collectionDate);
    oci_bind_by_name($stmt, ':collectionTime', $collectionTime);
    oci_bind_by_name($stmt, ':csID', $csID);


    if (oci_execute($stmt)) {
        header('Location: form.php');
        exit();
    } 
}


?>