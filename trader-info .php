<?php include 'traderinfologic.php';
$userID = $_SESSION['id'];
if ($_SESSION['status'] == "0"){

  echo "<script>window.location.href ='tokenpage.php';</script>";


}


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../dist/main.css" />
  </head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
       
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            z-index: 9999;
        }
        .popup-active {
            display: block;
        }
    </style>
<body>
<?php include 'includes/header.php' ?>
<section class="trader-info">
      <div class="page-mode">
        <div class="acc-details-mode mode">
          <p>Account Details</p>
        </div>
        <div class="products-mode mode">
          <p>Products</p>
        </div>
        <div class="update-mode mode">
          <p>Update Product</p>
        </div>
        <div class="add-mode mode">
          <p>Add Product</p>
        </div>
      </div>
      <div class="trader-update-product">
      <!-- <div class="image-container">
        <img src="./assets/img/bakery.jpg" alt="image" class="product-img" />
      </div> -->
      <div class="image-upload">
        <div class="upload-preview">
        <label for="image-upload-field-update" class="upload-button"><img src="./assets/icons/upload.png" alt="Upload Preview">
          </label>
        </div>
        <input type="file" name="uimgurl" id="image-upload-field-update" class="input-field update" accept="image/*">
        <div class="upload-status">
          <span class="status-message-update">No file selected</span>
          <span class="status-icon-update"><i class="fas fa-times"></i></span>
        </div>
      </div>

      <form class="update-product-form" method="post" action="trader-info.php">
        <label for="uproductname-field">Product Name</label>
        <input type="text" id="uproductname-field" 
        value="<?php echo $productName; ?>" class="input-field" name="uproductname" />
        <label for="uallergy-info-field">Allergy info</label>
        <input type="text" 
        name="uallergy-info"
        id="uallergy-info-field" 
        value="<?php echo $allergyInfo; ?>"
        class="input-field" />
        <div class="price-quantity-container">
          <div class="price-container sec-container">
            <label for="productprice-field">Price</label>
            <input type="text" 
            id="productprice-field"
            class="input-field"
            value="<?php echo $productPrice; ?>"
            name="uproductprice" />
          </div>
          <div class="quantity-container sec-container">
            <label for="productqty-field">Quantity per item</label>
            <input type="text" id="productqty-field" 
            value="<?php echo $productQty; ?>"
            name="uproductqty" class="input-field" />
          </div>
        </div>
        <label for="categories-field">Category</label>
        <input type="text" id="categories-field" class="input-field" value="<?php echo $category; ?>" disabled name="ucategory" />
        <label for="productdetail-field">Product Details</label>
          <textarea id="productdetail-field" name="uproductdetail" class="input-field prod-detail"><?php echo $productDetail; ?></textarea>
        <div class="checkbox-container">
          <input type="checkbox" id="show-checkbox" name="ucheckbox" />
          <label for="show-checkbox">Show On Store</label>
        </div>
        <input type="submit" class="update-btn" value="Update" name="updatebtn" />
      </form>
      </div>
      <div class="trader-add-product">
      <!-- <div class="image-container">
        <img src="./assets/img/bakery.jpg" alt="image" class="product-img" />
      </div> -->
      <form method="post" action="trader-info.php" class="image-upload">
        <div class="upload-preview">
        <label for="image-upload-field-add" class="upload-button"><img src="./assets/icons/upload.png" alt="Upload Preview">
          </label>
        </div>
        <input type="file" id="image-upload-field-add" class="input-field add" name="aimgurl" accept="image/*">
        <div class="upload-status">
          <span class="status-message-add">No file selected</span>
          <span class="status-icon-add"><i class="fas fa-times"></i></span>
        </div>
      </form>

      <form class="add-product-form" method="post" action="trader-info.php">
      <label for="aproductname">Product Name</label>
        <input type="text" class="input-field" name="aproductname" />
        <label for="allergy-info-field">Allergy info</label>
        <input type="text" id="allergy-info-field" class="input-field" 
        name="aallergy-info"
        />
        <div class="price-quantity-container">
          <div class="price-container sec-container">
            <label for="productprice">Price</label>
            <input type="text" class="input-field" name="aproductprice" />
          </div>
          <div class="quantity-container sec-container">
          <label for="productqty">Quantity per item</label>
            <input type="text" name="aproductqty" class="input-field" />
          </div>
        </div>
        <label for="categories-field">Category</label>
        <input type="text" id="categories-field" class="input-field" name="acategory" value="<?php echo $category; ?>" disabled />
        <label for="productdetail">Product Details</label>
          <textarea name="aproductdetail" class="input-field prod-detail"></textarea>
        <div class="checkbox-container">
          <input type="checkbox" id="show-checkbox" name="acheckbox" />
          <label for="show-checkbox">Show On Store</label>
        </div>
        <input type="submit" class="add-btn" value="Add" name="addbtn" />
      </form>
      </div>
      <div class="trader-details-container">
        <div class="heading-container">
          <div>
            <p class="heading1">Hello Trader,</p>
            <p class="heading2">Logged in as: <?php echo $_SESSION['email'];  ?></p>
          </div>
        </div>
        <div class="form-container">
  <!-- Trader Info Update Form -->
  <form class="details-form" method="post" action="trader-info.php">
    <div class="trader-info-update-container">
      <p class="heading3">Edit Profile:</p>
      <label for="name-field">Name</label>
      <input name="fullname" type="text" id="name-field" class="input-field" value="<?php echo $_SESSION['fullname']; ?>" />
      <label for="username-field">Username</label>
      <input type="text" name="username" id="username-field" class="input-field" value="<?php echo $_SESSION['username']; ?>" />
      <label for="email-field">Email</label>
      <input type="email" id="email-field" class="input-field" name="email" value="<?php echo $_SESSION['email']; ?>" />
      <label for="contact-no-field">Contact Number</label>
      <input type="text" name="contact_no" id="contact-no-field" class="input-field" value="<?php echo $_SESSION['contactnumber']; ?>" />
      <!-- <label for="address-field">Address</label>
      <input type="text" id="address-field" class="input-field" name= "address" value="Default Address 123" /> -->
      <label for="dob-field">Date of Birth(D.O.B)</label>
      <input name="dob" type="date" id="dob-field" class="input-field" value="<?php echo date('Y-m-d', strtotime($_SESSION['dob'])); ?>" />
      <input type="submit" class="save-btn" value="Save Changes" name="savebtn" />
    </div>
  </form>
  <?php
// Retrieve the form data
if(isset($_POST['savebtn'])){
$fullname = inputdata($_POST['fullname']);
$username = inputdata($_POST['username']);
$email = $_POST['email'];
$contact_no = $_POST['contact_no'];
$address = $_POST['address'];
$dob = date('Y-m-d',strtotime($_SESSION['dob']));

// Prepare the UPDATE statement
$sql = "UPDATE USERR
        SET FULLNAME = :fullname,
            USERNAME = :username,
            EMAIL = :email,
            CONTACT_NO = :contact_no,
            DOB = TO_DATE(:dob, 'YYYY-MM-DD')
        WHERE USER_ID = :user_id";

// Prepare the statement
$stmt = oci_parse($conn, $sql);

// Bind the parameters
oci_bind_by_name($stmt, ":fullname", $fullname);
oci_bind_by_name($stmt, ":username", $username);
oci_bind_by_name($stmt, ":email", $email);
oci_bind_by_name($stmt, ":contact_no", $contact_no);
oci_bind_by_name($stmt, ":dob", $dob);
oci_bind_by_name($stmt, ":user_id", $_SESSION['id']);

// Execute the statement
$result = oci_execute($stmt);

if ($result) {
    // Update successful
    echo "<script>alert('Profile updated successfully.');
          window.location.href = 'trader-info.php';</script>";
} else {
    // Update failed
    $error = oci_error($stmt);
    echo "Profile update failed: " . $error['message'];
}

// Clean up
oci_free_statement($stmt);
oci_close($conn);

if ($result) {
  // Update successful
  $_SESSION['fullname'] = $fullname;
  $_SESSION['username'] = $username;
  $_SESSION['email'] = $email;
  $_SESSION['contactnumber'] = $contact_no;
  $_SESSION['dob'] = $dob;

  echo "Profile updated successfully.";
} else {
  // Update failed
  $error = oci_error($stmt);
  echo "Profile update failed: " . $error['message'];
}
}
?>

  <!-- Change Password Form -->
  <form class="details-form" method="post" action="trader-info.php">
    <div class="changepw-container">
      <h3 style="margin-bottom: 3rem;" class="change-password-heading">Change Password:</h3>
      <label for="current-password-field">Current Password</label>
      <input
        type="password"
        name="current-pwd"
        id="current-password-field"
        class="input-field"
      />
      <label for="new-password-field">New Password</label>
      <input
        name="new-pwd"
        type="password"
        id="new-password-field"
        class="input-field"
      />
      <label for="confirm-password-field">Confirm Password</label>
      <input
        name="confirm-pwd"
        type="password"
        id="confirm-password-field"
        class="input-field"
      />
      <input type="submit" class="save-btn" value="Change Password" name="changepw" />
    </div>
  </form>
  <?php
if (isset($_POST['changepw'])) {
  $currentPassword = $_POST['current-pwd'];
  $newPassword = $_POST['new-pwd'];
  $confirmPassword = $_POST['confirm-pwd'];

  // Check if the new password and confirm password match
  if ($newPassword !== $confirmPassword) {
      echo "<script>alert('New password and confirm password do not match.');</script>";
      return; // Stop further execution
  }

  // Check if the current password matches the one in the database
  $query = "SELECT PASSWORD FROM USERR WHERE USER_ID = :user_id";
  $stmt = oci_parse($conn, $query);
  oci_bind_by_name($stmt, ":user_id", $_SESSION['id']);
  oci_execute($stmt);

  $row = oci_fetch_assoc($stmt);
  $dbPassword = $row['PASSWORD'];

  // Compare passwords using MD5 hash
  if (md5($currentPassword) !== $dbPassword) {
      echo "<script>alert('Current password is incorrect.');</script>";
      return; // Stop further execution
  }

  // Hash the new password using MD5
  $hashedPassword = md5($newPassword);

  // Update the password in the database
  $updateQuery = "UPDATE USERR SET PASSWORD = :password WHERE USER_ID = :user_id";
  $updateStmt = oci_parse($conn, $updateQuery);
  oci_bind_by_name($updateStmt, ":password", $hashedPassword);
  oci_bind_by_name($updateStmt, ":user_id", $_SESSION['id']);

  if (oci_execute($updateStmt)) {
      echo "<script>alert('Password changed successfully.');</script>";
  } else {
      $error = oci_error($updateStmt);
      echo "<script>alert('Failed to change password: " . $error['message'] . "');</script>";
  }
}

?>

</div>


        </div>
      </div>
      <div class="trader-view-products">
          <div class="search-bar">
        <input type="text" placeholder="Search for products...">
      </div>
      <div class="product-list">
      <?php
        $selectallprods = "SELECT * FROM PRODUCT WHERE USER_ID = $userID ";
        $proddisplayexecute = oci_parse($conn, $selectallprods);
        oci_execute($proddisplayexecute);
        while ($row = oci_fetch_array($proddisplayexecute, OCI_ASSOC)) { ?>
        <div class="product-item">
          <div class="product-select">
            <input type="checkbox">
          </div>
          <div class="product-image">
            <img src="<?php echo $row['PRODUCT_IMG']; ?>" alt="Product Image">
          </div>
          <div class="product-details">
            <div class="product-name">
            <?php echo $row['PRODUCT_NAME']; ?>
            </div>
            <div class="product-key">
              Product Category: <?php echo $row['CATEGORY_NAME']; ?>
            </div>
            <div class="shop-name">
              Shop ID: <?php echo $row['SHOP_ID']; ?>
            </div>
          </div>
          <div class="product-price">
          </div>
          <div class="product-actions">
            <form action="trader-info.php" method="post">
             <a href="trader-info.php?editProductId=<?php echo $row['PRODUCT_ID']; ?>">
            <img src="./assets/icons/edit-icon.png" class="edit-icon"></img>
            </a>
        </form>
            <a href="trader-info.php?deleteProductId=<?php echo $row['PRODUCT_ID']; ?>">
            <img src="./assets/icons/delete-icon.png" class="delete-icon"></img>
            </a>
          </div>
        </div>
   
        <?php

if (!empty($_GET['editProductId'])) {
    $editProductId = $_GET['editProductId'];

    // Fetch the product details from the PRODUCT table
    $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :product_id";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ":product_id", $editProductId);
    oci_execute($stmt);

    $product = oci_fetch_assoc($stmt);

    if ($product) {
        // Product found, display the popup box
        ?>
        <!-- Popup box -->
        <div id="popupBox" class="popup">
            <form method="post" action="trader-info.php">
                <input type="hidden" name="editProductId" value="<?php echo $product['PRODUCT_ID']; ?>">
                <label for="productName">Product Name:</label>
                <input type="text" name="productName" id="productName" value="<?php echo $product['PRODUCT_NAME']; ?>"><br>
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" value="<?php echo $product['PRICE']; ?>"><br>
                <label for="productDetail">Product Detail:</label>
                <textarea name="productDetail" id="productDetail"><?php echo $product['PRODUCT_DETAIL']; ?></textarea><br>
                <input type="submit" name="updateProduct" value="Update">
            </form>
        </div>

        <!-- jQuery script to handle the popup box -->
        <script>
            $(document).ready(function() {
                // Show the popup box
                $('#popupBox').addClass('popup-active');
            });
        </script>
        <?php
    } else {
        // Product not found
        echo "Product not found.";
    }
}

// Update the product details if the update form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProduct'])) {
    $editProductId = $_POST['editProductId'];
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $productDetail = $_POST['productDetail'];

    // Update the product details in the PRODUCT table
    $query = "UPDATE PRODUCT SET PRODUCT_NAME = :product_name, PRICE = :price, PRODUCT_DETAIL = :product_detail WHERE PRODUCT_ID = :product_id";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ":product_name", $productName);
    oci_bind_by_name($stmt, ":price", $price);
    oci_bind_by_name($stmt, ":product_detail", $productDetail);
    oci_bind_by_name($stmt, ":product_id", $editProductId);

    if (oci_execute($stmt)) {
        $rowsAffected = oci_num_rows($stmt);
        if ($rowsAffected > 0) {
            // Product details updated successfully
            $_SESSION['productUpdated'] = true;
            echo '<script>window.location.href = "trader-info.php";</script>';

           
            exit;
        } else {
            // No changes made, no need to display the message
        }
    } else {
        $error = oci_error($stmt);
        echo '<script>alert("Failed to update product details: ' . $error['message'] . '");</script>';
        exit;
    }
}

// Display success message if product details updated
if (!empty($_SESSION['productUpdated'])) {
    echo '<script>alert("Product details updated successfully.");</script>';
    unset($_SESSION['productUpdated']);
}
?>







   

   
    
    
    

    

        <?php } ?>
      </div>
      </div>
    </section>
<?php include 'includes/footer.php' ?>
<script src="app/js/script.js"></script>
<script>
  const modes = document.querySelectorAll(".mode");
  const accDetails = document.querySelector(".acc-details-mode");
  const traderDetailCnt = document.querySelector(".trader-details-container");
  const traderAddProduct = document.querySelector(".trader-add-product");
  const traderViewProducts = document.querySelector(".trader-view-products");
  const traderUpdateProduct = document.querySelector(".trader-update-product");

  const editIcon = document.querySelectorAll('.product-actions a');
        

  accDetails.classList.add("active");
  function hideAll() {
    traderDetailCnt.style.display = "none";
    traderAddProduct.style.display = "none";
    traderViewProducts.style.display = "none";
    traderUpdateProduct.style.display = "none";
  }
  function removeActive() {
    modes.forEach((mode) => {
      mode.classList.remove("active");
    });
  }
  hideAll();
  traderDetailCnt.style.display = "block";

  editIcon.forEach((icon) => {
    icon.addEventListener('click', (e) => {
      removeActive();
      hideAll();
      traderUpdateProduct.style.display = "flex";
      document.querySelector('.update-mode').classList.add('active');
    })
  })


  modes.forEach((mode) => {
    mode.addEventListener("click", () => {
      removeActive();
      mode.classList.add("active");
      hideAll();
   
      if (mode.classList.contains("acc-details-mode")) {
        traderDetailCnt.style.display = "block";
      } else if (mode.classList.contains("products-mode")) {
        traderViewProducts.style.display = "block";
      } else if (mode.classList.contains("update-mode")) {
        traderUpdateProduct.style.display = "flex";
      } else if (mode.classList.contains("add-mode")) {
        traderAddProduct.style.display = "flex";
      }
    });
  });

  // Get the file input element
const fileInputAdd = document.querySelector('.add');
const fileInputUpdate = document.querySelector('.update');


// Add an event listener for the 'change' event
fileInputAdd.addEventListener('change', handleFileChange);
fileInputUpdate.addEventListener('change', handleFileChange);


// Function to handle the file change event
function handleFileChange(event) {
  // Get the selected file
  const selectedFile = event.target.files[0];

  // Get the upload status elements
  const statusMessageUpdate = document.querySelector('.status-message-update');
  const statusIconUpdate = document.querySelector('.status-icon-update');
  const statusMessageAdd = document.querySelector('.status-message-add');
  const statusIconAdd = document.querySelector('.status-icon-add');
  console.log(event.target);

  if (selectedFile) {

    let fileName;

    // Shorten the file name to 7 characters max 
    if (selectedFile.name.length > 10) {
      fileName = selectedFile.name.split('.')[0].substring(0, 7) + '...';
    } else {
      fileName = selectedFile.name;
    }

    if (event.target.classList.contains('update')) {
      // Update the status message with the file name
      statusMessageUpdate.textContent = fileName;

      statusIconUpdate.innerHTML = '<i class="fas fa-check"></i>';
    } else if (event.target.classList.contains('add')) {
      console.log("HEY");
      // Update the status message with the file name
      statusMessageAdd.textContent = fileName;

      statusIconAdd.innerHTML = '<i class="fas fa-check"></i>';
    }
  } else {
    // If no file is selected, revert back to the default message and icon
    statusMessageUpdate.textContent = 'No file selected';
    statusMessageAdd.textContent = 'No file selected';
    statusIconUpdate.innerHTML = '<i class="fas fa-times"></i>';
    statusIconAdd.innerHTML = '<i class="fas fa-times"></i>';
  }
}

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>