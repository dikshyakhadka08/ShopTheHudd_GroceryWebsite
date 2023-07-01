<?php require ('connectsession.php');
error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shop The Hudd</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Alkatra:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../dist/main.css" />
</head>
<body>
    <?php include 'includes/header.php' ?>
    <section class="wishlist">
        <h2>My Wishlist</h2>
        <div class="wishlist_body">
            <div class="wishlist_item wishlist_titles">
                <h3>Product image</h3>
                <h3>Product name</h3>
                <h3>Unit Price</h3>
                <h3>Action</h3>
            </div>
            <?php
            $userid = $_SESSION['id'];
            // Fetch wishlist items from the database
            $wishlistItemsQuery = 'SELECT w.WISHLIST_ID, w.PRODUCT_ID, w.PRODUCT_QUANTITY, w.USER_ID, p.PRODUCT_NAME, p.PRICE, p.PRODUCT_IMG
            FROM WISHLIST w
            INNER JOIN PRODUCT p ON w.PRODUCT_ID = p.PRODUCT_ID
            WHERE w.USER_ID = :userid';
  
            $wishlistItemsStmt = oci_parse($conn, $wishlistItemsQuery);
            oci_bind_by_name($wishlistItemsStmt, ':userid', $userid);
            oci_execute($wishlistItemsStmt);

            while ($wishlistItem = oci_fetch_array($wishlistItemsStmt, OCI_ASSOC)) {
                $productName = $wishlistItem['PRODUCT_NAME'];
                $unitPrice = $wishlistItem['PRICE'];
                $imageUrl = $wishlistItem['PRODUCT_IMG'];   
                $productId = $wishlistItem['PRODUCT_ID'];
                $quantity = 1; // Quantity will always be one
                        
                ?>
                <form 
                method="post"
                action="wishlist.php"
                class="wishlist_item wishlist-product">
                    <img src="https://www.svgrepo.com/show/501635/minimize.svg" 
                    class="wishlist-product__delete"
                    alt="Delete icon">
                    <img src="<?php echo $imageUrl; ?>" alt="Product image" 
                    class="wishlist-product__image"
                    height="50px">
                    <span><?php echo $productName; ?></span>
                    <span><?php echo $unitPrice; ?></span>
                    <button name="wishlist-addtocart">Add to cart</button>
                </form>
            <?php
             if (isset($_POST['wishlist-addtocart'])) {

                // Check if the user has a cart
                $cartQuery = 'SELECT CART_ID FROM CART WHERE USER_ID = :userId';
                $cartStmt = oci_parse($conn, $cartQuery);
                oci_bind_by_name($cartStmt, ':userId', $userid);
                oci_execute($cartStmt);
                $cartRow = oci_fetch_array($cartStmt, OCI_ASSOC);
              
              if (!$cartRow) {
                  $cartID = rand(100, 1000) + rand(1, 99) + rand(1000, 9999);
                  $_SESSION['cartID'] = $cartID;
                  // Create a new cart and store the cart ID in the session
                  $insertCartQuery = "INSERT INTO CART (CART_ID, AMOUNT, PRODUCT_QUANTITY, USER_ID, STATUS)
                  VALUES (:cartId, :unitPrice, :quantity, :userId, 'Active')";
                  
                  $insertCartStmt = oci_parse($conn, $insertCartQuery);
                  oci_bind_by_name($insertCartStmt, ':userId', $userid);
                  oci_bind_by_name($insertCartStmt, ':quantity', $quantity);                   
                  oci_bind_by_name($insertCartStmt, ':unitPrice', $unitPrice);
                  oci_bind_by_name($insertCartStmt, ':cartId', $_SESSION['cartID']);

                  oci_execute($insertCartStmt);
                  

                  // Insert the product into the cart_products table
                  $insertCartProductQuery = "INSERT INTO CART_PRODUCT (PRODUCT_ID, QUANTITY, CART_ID)
                  VALUES (:productId, :quantity, :cartId)";
                  $insertCartProductStmt = oci_parse($conn, $insertCartProductQuery);
                  echo $productId;
                  oci_bind_by_name($insertCartStmt, ':productId', $productId);
                  oci_bind_by_name($insertCartStmt, ':quantity', $quantity);
                  oci_bind_by_name($insertCartStmt, ':cartId', $_SESSION['cartID']);
                  oci_execute($insertCartStmt);

                  // Show error 
                  if (!$insertCartStmt) {
                      $e = oci_error($insertCartStmt);
                      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                  }
              
              } else if ($cartRow) {
                  $cartID = $_SESSION['cartID'];

                  // Check if the product already exists in the cart
                  $checkCartProductQuery = 'SELECT * FROM CART_PRODUCT WHERE PRODUCT_ID = :productId AND CART_ID = :cartId';
                  $checkCartProductStmt = oci_parse($conn, $checkCartProductQuery);
                  oci_bind_by_name($checkCartProductStmt, ':productId', $productId);
                  oci_bind_by_name($checkCartProductStmt, ':cartId', $cartID);
                  oci_execute($checkCartProductStmt);
             
                  // show error
                  if (!$checkCartProductStmt) {
                      $e = oci_error($checkCartProductStmt);
                      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                  } 

                  // If the product exists in the cart product table then append the quantity.
                  if ($checkCartProduct = oci_fetch_array($checkCartProductStmt, OCI_ASSOC)) {
                      $quantity = $checkCartProduct['QUANTITY'] + 1;
                      echo $quantity;
                      $updateCartProductQuery = "UPDATE CART_PRODUCT SET QUANTITY = :quantity WHERE PRODUCT_ID = :productId AND CART_ID = :cartId";
                      $updateCartProductStmt = oci_parse($conn, $updateCartProductQuery);
                      oci_bind_by_name($updateCartProductStmt, ':quantity', $quantity);
                      oci_bind_by_name($updateCartProductStmt, ':productId', $productId);
                      oci_bind_by_name($updateCartProductStmt, ':cartId', $cartID);
                      oci_execute($updateCartProductStmt);

                      // check error 
                      if (!$updateCartProductStmt) {
                          $e = oci_error($updateCartProductStmt);
                          trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                      }

                      // Also append to cart quantity and amount
                      $updateCartQuery = "UPDATE CART SET PRODUCT_QUANTITY = PRODUCT_QUANTITY + 1, AMOUNT = AMOUNT + :unitPrice WHERE CART_ID = :cartId";
                      $updateCartStmt = oci_parse($conn, $updateCartQuery);
                      oci_bind_by_name($updateCartStmt, ':unitPrice', $unitPrice);
                      oci_bind_by_name($updateCartStmt, ':cartId', $cartID);
                      oci_execute($updateCartStmt);

                      // check error
                      if (!$updateCartStmt) {
                          $e = oci_error($updateCartStmt);
                          trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                      }

                      oci_free_statement($updateCartStmt);
                  }
          
              }
              
              
              
             
              }
        
            }
            // Close the OCI statement and connection
            oci_free_statement($wishlistItemsStmt);
            oci_close($conn);
            ?>
        </div>
    </section>
    <?php include 'includes/footer.php' ?>
    <script src="app/js/script.js"></script>
    <script>
        const deleteBtn = document.querySelectorAll('.wishlist-product__delete');
        const wishlistItem = document.querySelectorAll('.wishlist-product');

        deleteBtn.forEach((btn, index) => {
          btn.addEventListener('click', () => {
            wishlistItem[index].remove();
          });
        });
    </script>
</body>
</html>