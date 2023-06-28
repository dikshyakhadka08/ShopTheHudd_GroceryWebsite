<?php require('connectsession.php');
error_reporting(0);
?>

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
    <style>.site-navbar {
  background-color: #f2f2f2;
  padding: 10px;
}

.navbar-container {
  display: flex;
  justify-content: flex-end;
}

.navbar-menu {
  list-style: none;
  padding: 0;
  margin: 0;
}

.navbar-item {
  display: inline-block;
  margin-right: 10px;
}

.navbar-link {
  color: #333;
  text-decoration: none;
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.navbar-link:hover {
  background-color: #ccc;
}
</style>
  </head>
<body>
<?php include 'includes/header.php';


$userId = $_SESSION['id'];
$userdataId = $_SESSION['id'];
$userr = $_SESSION['id'];

$selectOrder = 'SELECT order_id FROM orderr WHERE user_id = :userId';
$orderStmt = oci_parse($conn, $selectOrder);
oci_bind_by_name($orderStmt, ':userId', $userId);
oci_execute($orderStmt);

$count = 0;

$selectUser = 'SELECT * FROM USERR WHERE USER_ID = :userId';
$userStmt = oci_parse($conn, $selectUser);
oci_bind_by_name($userStmt, ':userId', $userId);
oci_execute($userStmt);

$user = oci_fetch_array($userStmt, OCI_ASSOC);
$firstName = $user['FULLNAME'];
$username = $user['USERNAME'];
$email = $user['EMAIL'];
$phone = $user['CONTACT_NO'];



while ($row = oci_fetch_array($orderStmt, OCI_ASSOC)) {
  $count++;
}
?>
<nav class="site-navbar">
  <div class="navbar-container">
    <ul class="navbar-menu">
      <li class="navbar-item">
        <a href="cart.php" class="navbar-link">Go to Cart</a>
      </li>
      <li class="navbar-item">
        <a href="wishlist.php" class="navbar-link">Go to Wishlist</a>
      </li>
    </ul>
  </div>
</nav>
<?php 
  if (isset($_POST['submitt'])) {

    if (isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['change-username']) && isset($_POST['add-new-email']) ){
    $newFirstName = $_POST['first-name'];
    $newUsername = inputdata($_POST['change-username']);
    $newEmail = $_POST['add-new-email'];
    $newPhone = $_POST['add-new-phone'];

    
    // Update the user profile in the database
    $updateUser = 'UPDATE USERR SET FULLNAME = :fullname, USERNAME = :username, EMAIL = :email, CONTACT_NO = :phone WHERE USER_ID = :userId';
    $updateStmt = oci_parse($conn, $updateUser);
    oci_bind_by_name($updateStmt, ':fullname', $newFirstName);
    oci_bind_by_name($updateStmt, ':username', $newUsername);
    oci_bind_by_name($updateStmt, ':email', $newEmail);
    oci_bind_by_name($updateStmt, ':phone', $newPhone);
    oci_bind_by_name($updateStmt, ':userId', $userr);

    $updateResult = oci_execute($updateStmt);
    if ($updateResult) {
      echo '<script>alert("Profile updated successfully")</script>';
      header('Location: customer-info.php');
      exit();
    } else {
      echo '<script>alert("Profile update failed")</script>';
    }
    }}
?>
<section class="customer-profile">
  <div class="customer-profile__container">
    <div class="customer-profile__titles">
      <h3 class="customer-profile__title">My account</h3>
      <h3 class="customer-profile__title">My orders</h3>
      <h3 class="customer-profile__title">Modify Account</h3>
      <h3 class="customer-profile__title">Purchase History</h3>
    </div>
    <div class="customer-profile__body">
      <div class="myaccount">
        <div class="myaccount-titles">
          <h2>Hello Customer,</h2>
          <h4>Logged in as: <span><?php echo$_SESSION['email']; ?></span></h4>
        </div>
        <div class="myaccount-body">
          <div class="myaccount-item">
            <img src="assets/icons/box.png" alt="">
            <h4>Orders placed <span><?php echo $count; ?></span></h4>
          </div>
          <div class="myaccount-item">
  <img src="assets/icons/cart-bg.png" alt="">
  <h4>Cart Items <span>
    <?php
    // Assuming you have a database connection established

    // Query to fetch the count of cart items
    $query = "SELECT COUNT(CART_ID) AS cart_count
              FROM CART
              WHERE USER_ID = :user_id";

    // Prepare the statement
    $cartItems = oci_parse($conn, $query);

    // Bind the user_id parameter
    $user_id = $_SESSION['id']; // Replace with the actual user ID
    oci_bind_by_name($cartItems, ':user_id', $user_id);

    // Execute the statement
    oci_execute($cartItems);

    // Fetch the cart count
    $row = oci_fetch_array($cartItems, OCI_ASSOC);
    $cart_count = $row['CART_COUNT'];

    // Display the cart count
    echo $cart_count;
    ?>
  </span></h4>
</div>
          <div class="myaccount-item">
            <img src="assets/icons/heart.png" alt="">
            <h4>Wishlist <span>ON</span></h4>
          </div>
          <div class="myaccount-item">
            <img src="assets/icons/box-tick.png" alt="">
            <h4>Completed Orders <span><?php echo $count; ?></span></h4>
          </div>
          <div class="myaccount-item">
  <img src="assets/icons/review.png" alt="">
  <h4>Reviews <span>
    <?php
    // Assuming you have a database connection established

    // Query to fetch the count of reviews
    $reviewCountQuery = "SELECT COUNT(review_id) AS review_count
                         FROM review
                         WHERE user_id = :user_id";

    // Prepare the statement
    $reviewCountStmt = oci_parse($conn, $reviewCountQuery);

    // Bind the user_id parameter
    $user_id = $_SESSION['id']; // Replace with the actual user ID
    oci_bind_by_name($reviewCountStmt, ':user_id', $user_id);

    // Execute the statement
    oci_execute($reviewCountStmt);

    // Fetch the review count
    $reviewCountRow = oci_fetch_array($reviewCountStmt, OCI_ASSOC);
    $review_count = $reviewCountRow['REVIEW_COUNT'];

    // Display the review count
    echo $review_count;
    ?>
  </span></h4>
</div>

          <div class="myaccount-item">
  <img src="assets/icons/purchase-points.png" alt="">
  <h4>Purchase Points <span>
    <?php
    // Assuming you have a database connection established

    // Query to fetch the cart count
    $cartCountQuery = "SELECT COUNT(CART_ID) AS cart_count
                       FROM CART
                       WHERE USER_ID = :user_id";

    // Prepare the statement
    $cartCountStmt = oci_parse($conn, $cartCountQuery);

    // Bind the user_id parameter
    $user_id = $_SESSION['id']; // Replace with the actual user ID
    oci_bind_by_name($cartCountStmt, ':user_id', $user_id);

    // Execute the statement
    oci_execute($cartCountStmt);

    // Fetch the cart count
    $cartCountRow = oci_fetch_array($cartCountStmt, OCI_ASSOC);
    $cart_count = $cartCountRow['CART_COUNT'];

    // Calculate the purchase points
    $purchasePoints = $cart_count * 95;

    // Display the purchase points
    echo $purchasePoints;
    ?>
  </span></h4>
</div>

        </div>
      </div>
      <div class="myorders">


<?php
$userrId = $_SESSION['id']; 

// Fetch orders for the user from the database
$selectOrders = 'SELECT * FROM orderr WHERE user_id = :userId';
$ordersStmt = oci_parse($conn, $selectOrders);
oci_bind_by_name($ordersStmt, ':userId', $userrId);
oci_execute($ordersStmt);

// Generate HTML for each order item
$orderItemsHtml = '';
while ($order = oci_fetch_array($ordersStmt, OCI_ASSOC)) {
  $orderNo = $order['ORDER_ID']; 
  $totalItems = $order['TOTAL_ITEM']; 
  $takeawayDate = $order['ORDER_DATE'];
  $serialNo =  rand(1, 999) + rand(999, 9999) + rand(9999, 999999);

  // Generate HTML for the current order item
  $orderItemHtml = '
    <div class="myorders-item">
      <div class="myorders-item__top">
        <h4>Order No: <span>' . $orderNo . '</span></h4>
        <h4>Total Products: <span>' . $totalItems . '</span></h4>
        <span>Serial Number</span>
        <span>' . $serialNo .  '</span>
      </div>
      <div class="myorders-item__bottom">
        <h4>Your ordered date: </h4>
        <span>' . $takeawayDate . '</span>
        <button class="btn-order__details">View Details</button>
      </div>
    </div>';

  // Append the current order item HTML to the overall HTML
  $orderItemsHtml .= $orderItemHtml;
}

// Clean up

?>

<div class="myorders-container">
  <?php echo $orderItemsHtml; ?>
</div>

      </div>
      <div class="purchasehistory">
  <h3>Purchase History</h3>
  <div class="purchasehistory__titles">
    <h4>Payment Date <img src="assets/icons/arrows.png" alt=""></h4>
    <h4>Payment Amount <img src="assets/icons/arrows.png" alt=""></h4>
    <h4>Order ID <img src="assets/icons/arrows.png" alt=""></h4>
  </div>
  <div class="purchasehistory__items">
    <?php
    // Assuming you have a database connection established

    // Query to fetch the purchase history data
    $query = "SELECT py.PAY_DATE, py.PAY_AMOUNT, py.ORDER_ID
              FROM ORDERR o
              JOIN PAYMENT py ON o.ORDER_ID = py.ORDER_ID
              WHERE o.USER_ID = :user_id";

    // Prepare the statement
    $purHistory = oci_parse($conn, $query);

    // Bind the user_id parameter
    $user_id = $_SESSION['id']; // Replace with the actual user ID
    oci_bind_by_name($purHistory, ':user_id', $user_id);

    // Execute the statement
    oci_execute($purHistory);

    // Fetch and display the purchase history data
    while ($row = oci_fetch_array($purHistory, OCI_ASSOC)) {
      echo '<div class="purchasehistory__item">';
      echo '<span>' . $row['PAY_DATE'] . '</span>';
      echo '<span>' . $row['PAY_AMOUNT'] . '</span>';
      echo '<span>' . $row['ORDER_ID'] . '</span>';
      echo '</div>';
    }
    ?>
  </div>
</div>

      <section class="modify-account-section">
  <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save-changes'])) {
      $newFirstName = $_POST['first-name'];
      $newUsername = $_POST['change-username'];
      $newEmail = $_POST['add-new-email'];
      $newPhone = $_POST['add-new-phone'];

      // Update the user profile in the database
      $updateUser = 'UPDATE USERR SET FULLNAME = :fullname, USERNAME = :username, EMAIL = :email, CONTACT_NO = :phone WHERE USER_ID = :userId';
      $updateStmt = oci_parse($conn, $updateUser);
      oci_bind_by_name($updateStmt, ':fullname', $newFirstName);
      oci_bind_by_name($updateStmt, ':username', $newUsername);
      oci_bind_by_name($updateStmt, ':email', $newEmail);
      oci_bind_by_name($updateStmt, ':phone', $newPhone);
      oci_bind_by_name($updateStmt, ':userId', $userId);

      $updateResult = oci_execute($updateStmt);
      if ($updateResult) {
        
        // Optionally, you can update the session variables with the new values
        $_SESSION['fullname'] = $newFirstName;
        $_SESSION['username'] = $newUsername;
        $_SESSION['email'] = $newEmail;
        $_SESSION['phone'] = $newPhone;
        
      } else {
        $errorMessage = 'Error in updating details';
      }
    }
  ?>

  <div class="left-section">
    <h2>Edit Profile:</h2>
    <form method="post" action="">
      <div class="input-group">
        <label for="first-name">Change Full Name:</label>
        <input type="text" name="first-name" value="<?php echo $firstName; ?>" required>
      </div>
      <div class="input-group">
        <label for="change-username">Change Username:</label>
        <input type="text" name="change-username" value="<?php echo $username; ?>" required>
      </div>
      <div class="input-group">
        <label for="add-new-email">Add New Email:</label>
        <input type="email" name="add-new-email" value="<?php echo $email; ?>" required>
      </div>
      <div class="input-group">
        <label for="add-new-phone">Add New Phone Number:</label>
        <input type="tel" name="add-new-phone" maxlength="10" value="<?php echo $phone; ?>" required>
      </div>
      <div class="input-group">
        <input type="submit" name="save-changes" value="Save Changes" class="csmodify-btn">
      </div>
    </form>
  </div>
<!-- </section>

<section class="change-password-section"> -->
  <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change-password'])) {
      $currentPassword = $_POST['current-password'];
      $newPassword = $_POST['new-password'];
      $confirmPassword = $_POST['confirm-password'];

      // Verify if the current password matches the one in the database
      $verifyPasswordQuery = "SELECT PASSWORD FROM USERR WHERE USER_ID = :userId";
      $verifyPasswordStmt = oci_parse($conn, $verifyPasswordQuery);
      oci_bind_by_name($verifyPasswordStmt, ':userId', $userId);
      oci_execute($verifyPasswordStmt);
      $row = oci_fetch_assoc($verifyPasswordStmt);
      $storedPassword = $row['PASSWORD'];

      if (md5($currentPassword) == $storedPassword) {
        // Update the password in the database
        $hashedPassword = md5($newPassword);
        $updatePasswordQuery = "UPDATE USERR SET PASSWORD = :password WHERE USER_ID = :userId";
        $updatePasswordStmt = oci_parse($conn, $updatePasswordQuery);
        oci_bind_by_name($updatePasswordStmt, ':password', $hashedPassword);
        oci_bind_by_name($updatePasswordStmt, ':userId', $userId);
        oci_execute($updatePasswordStmt);
        // echo "Password changed successfully";
      }
    }
  ?>

  <div class="right-section">
    <h2>Change Password:</h2>
    <form method="post" action="">
      <div class="input-group">
        <label for="current-password">Current Password:</label>
        <input type="password" name="current-password" required>
      </div>
      <div class="input-group">
        <label for="new-password">New Password:</label>
        <input type="password" name="new-password" required>
      </div>
      <div class="input-group">
        <label for="confirm-password">Confirm Password:</label>
        <input type="password" name="confirm-password" required>
      </div>
      <div class="input-group">
        <input type="submit" name="change-password" value="Change Password" class="csmodify-btn">
      </div>
    </form>
  </div>
</section>
    </div>
  </div>
</section>
<form method="POST" action="delete_user.php">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
    <button type="submit" name="delete_user">Delete User</button>
</form>
<?php include 'includes/footer.php' ?>
<script src="app/js/script.js"></script>
<script>
  const myaccount = document.querySelector('.myaccount');
  const myorders = document.querySelector('.myorders');
  const purchasehistory = document.querySelector('.purchasehistory');
  const modifyaccount = document.querySelector('.modify-account-section');
  const myaccountTitle = document.querySelectorAll('.customer-profile__title');
  const saveChangesBtn =document.getElementById('#save-changes');

  // Conditionally render each of the above sections when clicked
  myaccountTitle.forEach((title) => {
    title.addEventListener('click', (e) => {
    const currentEl = e.target.innerHTML;
    myaccount.style.display = "none";
    myorders.style.display = "none";
    purchasehistory.style.display = "none";
    modifyaccount.style.display = "none";
   
    if (currentEl === 'My account') {
      myaccount.style.display = "block";
    } else if (currentEl === 'My orders') {   
      myorders.style.display = 'grid';
    } else if (currentEl === 'Purchase History') {
      purchasehistory.style.display = "block";
    } else if (currentEl === 'Modify Account') {
      modifyaccount.style.display = "flex";
    }
  });
  })
  
  saveChangesBtn.addEventListener('click', (e) => {
    e.preventDefault();
    // Send the data to the database
    
    alert('Changes saved successfully!');
  })

</script>
</body>
</html>