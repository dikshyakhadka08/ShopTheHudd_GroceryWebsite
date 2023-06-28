<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shop The Hudd</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Alkatra:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../dist/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
  </head>
<body>
<?php 
$totItems = 0;
include 'includes/header.php' 
?>
<div class="cart">
  <div class="cart__left">
    <h2 class="cart__title">YOUR CART</h2>
  <div class="cart__items">
  <?php   
        require('cartlogic.php');
        $arrayytot = 0;
        
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)): 
        
          // Access the retrieved data
          $productId = $row['PRODUCT_ID'];
          $productName = $row['PRODUCT_NAME'];
          $quantity = $row['QUANTITY'];
          $price = $row['PRICE'];
          $imgUrl = $row['PRODUCT_IMG'];
          $totAmount = $price * $quantity;
          $arrayytot = $totAmount + $arrayytot;
          $totItems = $totItems + 1;
          $_SESSION['totAmount'] = $arrayytot;
          $_SESSION['totItems'] = $totItems;
    ?>
      <?php

if (isset($_POST['delete-btn'])) {
echo "Delete button clicked";
  // First check if cart is empty or not 
  $checkCartQuery = "SELECT * FROM CART WHERE CART_ID = :cartId";
  $checkCartStmt = oci_parse($conn, $checkCartQuery);
  oci_bind_by_name($checkCartStmt, ':cartId', $cartId);
  oci_execute($checkCartStmt);
  $checkCartRow = oci_fetch_array($checkCartStmt, OCI_ASSOC);

  // check if the cart row is empty now
  if($cartRow['PRODUCT_QUANTITY'] == 0) {
     // Update cart table
    $updateCartQuery = "UPDATE CART
    SET PRODUCT_QUANTITY = PRODUCT_QUANTITY - '$quantity', AMOUNT = AMOUNT - :price, STATUS = 'EMPTY'
    WHERE CART_ID = :cartId";
  } else {
     // Update cart table
    $updateCartQuery = "UPDATE CART
    SET PRODUCT_QUANTITY = PRODUCT_QUANTITY - '$quantity', AMOUNT = AMOUNT - :price
    WHERE CART_ID = :cartId";
  }
  $updateCartStmt = oci_parse($conn, $updateCartQuery);
  oci_bind_by_name($updateCartStmt, ':price', $price);
  oci_bind_by_name($updateCartStmt, ':cartId', $cartId);
  oci_execute($updateCartStmt);

  // Delete from cart_product table
  $deleteCartProductQuery = "DELETE FROM CART_PRODUCT WHERE CART_ID = :cartId
  AND PRODUCT_ID = :productId";
  $deleteCartProductStmt = oci_parse($conn, $deleteCartProductQuery);
  oci_bind_by_name($deleteCartProductStmt, ':cartId', $cartId);
  oci_bind_by_name($deleteCartProductStmt, ':productId', $productId);
  oci_execute($deleteCartProductStmt);

  header("Location: cart.php"); 
  exit();
}
?>
    <div class="cart-item">
      <img class="cart-item__image" src="<?php echo $imgUrl ?>" alt="Item 1">
      <div class="cart-item__details">
        <div class="cart-item__details--1">
          <p class="cart-item__name"><?php echo $productName ?></p>
          <p class="cart-item__price"><?php echo $price ?></p>
        </div>
        <p class="cart-item__shop"><?php 
        $prodid = $productId;
        $query2 = "SELECT SHOP_NAME FROM PRODUCT P JOIN SHOP S
        ON P.SHOP_ID = S.SHOP_ID
        WHERE PRODUCT_ID = '$prodid'";
        $stmt2 = oci_parse($conn, $query2);
        oci_execute($stmt2);
        $row2 = oci_fetch_array($stmt2, OCI_ASSOC);
        echo $row2['SHOP_NAME'];
        ?></p>
        <div class="cart-item__quantity">
        <button class="cart-item__decrement">-</button>
        <input class="cart-item__count" type="number" value="<?php echo $quantity; ?>" readonly>
        <button class="cart-item__increment">+</button>
      </div>
      </div>  
      <div class="cart-item__subtotal">
        <span>Subtotal: </span>
        <span class="cart-item__subtotal-price">$<?php echo $totAmount; ?></span>
      </div>
      <form action="cart.php" method="post">
        <button name="delete-btn" class="cart-item__delete-btn">X</button>
      </form>
    </div>
    <?php endwhile; ?>
    <!-- repeat for other cart items -->
  </div>
  <h2 class="cart__title">SIMILAR ITEMS</h2>
  <div class="cart__similar-items">
  <?php
  // Your database connection code here

  $query = "SELECT * FROM PRODUCT ORDER BY DBMS_RANDOM.VALUE";
  $statement = oci_parse($conn, $query);
  oci_execute($statement);

  $counter = 0;
  while ($row = oci_fetch_array($statement, OCI_ASSOC)) {
    $productImage = $row['PRODUCT_IMG'];
    $productName = $row['PRODUCT_NAME'];
    $productPrice = $row['PRICE'];
    $counter++;
    ?>
    <div class="cart__similar-item">
      <img class="cart__similar-item-image" src="<?php echo $productImage; ?>" alt="Product Image <?php echo $counter; ?>">
      <p class="cart__similar-item-name"><?php echo $productName; ?></p>
      <p class="cart__similar-item-price">$<?php echo $productPrice; ?></p>
      <div class="cart__add-box">+</div>
    </div>
    <?php
    if ($counter >= 4) {
      break;
    }
  }
  oci_free_statement($statement);
  oci_close($conn);
  ?>
</div>
</div>
   
  <div class="cart__summary">
    <div class="cart__summary-box">
      <h2 class="cart__summary-title">Summary</h2>
      <div class="cart__summary-line">
        <span class="cart__summary-subtotal">Subtotal:</span>
        <span class="cart__summary-price">$<?php echo $arrayytot; ?></span>
      </div>
      <div class="cart__summary-line">
        <span>VAT:</span>
        <span>$0</span>
      </div>
      <div class="cart__summary-line">
  <span>Offers:</span>
  <form class="form" method="post" action="cart.php">
    <select class="form__select" id="offer" name="offer">
      <option value="">Select an offer</option>
      <option value="1 Ticket for Carnival">1 Ticket for Carnival</option>
      <option value="1 Sticker for Your Mobile Phone">1 Sticker for Your Mobile Phone</option>
    </select>
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <button name="apply-offer" class="cart__apply-offer-btn">Apply</button>
  </form>
</div>

<?php
if (isset($_POST['apply-offer'])) {
  // Get the selected offer from the form
  $selectedOffer = $_POST['offer'];

  // Generate a random offer ID
  $offerId = rand(110,999)+rand(10000,100000) + rand(0,9);

  // Get the current date
  $currentDate = date("Y-m-d");

  // Get the user ID
  $userId = $_SESSION['id'];



  // Check if the user already has an active offer of the same type
  $query = "SELECT OFFER_ID FROM OFFER WHERE USER_ID = $userId AND OFFER_DESCRIPTION = :selectedOffer AND END_DATE >= TRUNC(SYSDATE)";
  $stmt = oci_parse($conn, $query);
  // oci_bind_by_name($stmt, ':userId', $userId);
  oci_bind_by_name($stmt, ':selectedOffer', $selectedOffer);
  oci_execute($stmt);

  // If the user already has an active offer of the same type, update the end date
  if ($row = oci_fetch_assoc($stmt)) {
    $existingOfferId = $row['OFFER_ID'];

    // Update the end date of the existing offer
    $query = "UPDATE OFFER SET END_DATE = TO_DATE(:currentDate, 'YYYY-MM-DD') WHERE OFFER_ID = :existingOfferId";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':currentDate', $currentDate);
    oci_bind_by_name($stmt, ':existingOfferId', $existingOfferId);
    oci_execute($stmt);
  } else {
    // Insert the new offer
    $query = "INSERT INTO OFFER (OFFER_ID, START_DATE, END_DATE, OFFER_DESCRIPTION, USER_ID) VALUES ($offerId, TO_DATE(:currentDate, 'YYYY-MM-DD'), TO_DATE(:currentDate, 'YYYY-MM-DD'), :selectedOffer, $userId)";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':currentDate', $currentDate);
    oci_bind_by_name($stmt, ':selectedOffer', $selectedOffer);
    // oci_bind_by_name($stmt, ':userId', $userId);
    oci_execute($stmt);
  }

  // Close the connection
  oci_close($conn);
}
?>

      <div class="cart__summary-line">
        <span>Total:</span>
        <span class="cart__total-price">$<?php echo $arrayytot; ?></span>
      </div>
      <div class="cart__summary-line">
        <form class="form" method="post" action="cart.php">
          <label class="form__label" for="collection_date">Select a collection date:</label>
          <input class="form__input" type="date" id="collection_date" name="collection_date">
          <input type="hidden" id="hidden_collection_date" name="hidden_collection_date">
          <label class="form__label" for="collection_time">Select a collection time:</label>
          <select class="form__select" id="collection_time" name="collection_time">
            <option class="form__option" value="">Select a collection time</option>
            <option class="form__option" value="10-13">10-13</option>
            <option class="form__option" value="13-16">13-16</option>
            <option class="form__option" value="16-19">16-19</option>
          </select>
          <!-- <input type="hidden" 
          id="hidden_collection_time"
          class="hidden_collection_time"> -->
          <button 
          name="checkout-btn"
          class="cart__checkout-btn">Checkout</button>
        </form>
      </div>
     
    </div>
  </div>
</div>
<?php include 'includes/footer.php' ?>
<script src="app/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  // Set up the flatpickr date picker with options to allow only Wed, Thurs, and Fri as the collection days
  flatpickr("#collection_date", {
  dateFormat: "Y-m-d",
  minDate: "today",
  disable: [
  (date) => {
  // Disable dates that are not Wed, Thurs, or Fri
  return !(date.getDay() === 3 || date.getDay() === 4 || date.getDay() === 5);
  }
  ],
  // Set up validation to ensure that the selected date is at least 24 hours from the current date
  onChange: (selectedDates, dateStr, instance) => {
    const selectedDate = new Date(selectedDates[0]);
    const now = new Date();
    now.setHours(0, 0, 0, 0);
    const minDate = new Date(now.getTime() + (24 * 60 * 60 * 1000));

    if (selectedDate < minDate) {
    instance.setDate(minDate, false); // Set the minimum date without triggering onChange
    } else {
      // Enable the collection time select element
      document.getElementById("collection_time").removeAttribute("disabled");
      // Update the hidden input field with the selected date value
      document.getElementById("hidden_collection_date").value = dateStr;
    }
  }
  });

  // Set up the collection time select element with options to allow only 10-13, 13-16, or 16-19 as the collection time slots
  const collectionTimeSelect = document.getElementById("collection_time");
  collectionTimeSelect.addEventListener("change", () => {
  const selectedOption = collectionTimeSelect.options[collectionTimeSelect.selectedIndex];
  if (selectedOption.value !== "10-13" && selectedOption.value !== "13-16" && selectedOption.value !== "16-19") {
  selectedOption.selected = false;
  collectionTimeSelect.selectedIndex = 0;
  } 
  });

  $(document).ready(function() {
    $('.cart-item__quantity').each(function() {
        var cartProductId = $(this).data('cart-product-id');
        var incrementBtn = $(this).find('.cart-item__increment');
        var decrementBtn = $(this).find('.cart-item__decrement');
        var countInput = $(this).find('.cart-item__count');

        incrementBtn.click(function() {
            var currentCount = parseInt(countInput.val());
            var newCount = currentCount + 1;
            countInput.val(newCount);

            // Send AJAX request to update the cart and cart product tables
            console.log(cartProductId);
            updateCartProduct(cartProductId, newCount);
        });

        decrementBtn.click(function() {
            var currentCount = parseInt(countInput.val());
            var newCount = currentCount - 1;
            if (newCount >= 0) {
                countInput.val(newCount);

                // Send AJAX request to update the cart and cart product tables
                updateCartProduct(cartProductId, newCount);
            }
        });
    });

    function updateCartProduct(cartProductId, quantity) {
                $.ajax({
                    url: 'cart.php',
                    type: 'POST',
                    data: {
                        cartProductId: cartProductId,
                        quantity: quantity
                    },
                    success: function(response) {
                        // Handle the response from the server
                        if (response.status === 'success') {
                            // Update the subtotal or display a success message
                            console.log(response.message);
                        } else {
                            // Handle the error case
                            console.error(response.message);
                        }
                    },
                    error: function() {
                        // Handle errors
                        console.error('An error occurred while updating the cart.');
                    }
                });
    }
});

</script>
</body>
</html>
