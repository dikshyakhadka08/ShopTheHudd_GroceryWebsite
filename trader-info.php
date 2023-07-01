<?php 
include 'traderinfologic.php';
include 'connection.php';
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
    <style>
      
        .site-navbar {
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
<?php include 'includes/header.php' ?>
<nav class="site-navbar">
  <div class="navbar-container">
    <ul class="navbar-menu">
      <li class="navbar-item">
        <a href="traderreport.php" class="navbar-link">Go to Trader Report</a>
      </li>
      <li class="navbar-item">
        <a href="tradershops.php" class="navbar-link">Go to Trader Shops</a>
      </li>
    </ul>
  </div>
</nav>
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
      <form method="post" action="trader-info.php">
      <div class="trader-update-product">
      <!-- <div class="image-container">
        <img src="./assets/img/bakery.jpg" alt="image" class="product-img" />
      </div> -->
      <div class="image-upload">
        <div class="upload-preview">
          <label for="image-upload-field-update" class="upload-button">
            <img src="./assets/icons/upload.png" alt="Upload Preview">
          </label>
        </div>
        <input style="padding: 6px; border-radius: 5px;" type="text" name="uimgurl" class="input-field update-url" placeholder="Enter image url">
    </div>
        <div class="update-product-form">
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
        </div>
      </form>
      </div>
      <form  method="post" action="trader-info.php">
      <div class="trader-add-product">
      <!-- <div class="image-container">
        <img src="./assets/img/bakery.jpg" alt="image" class="product-img" />
      </div> -->
      <div class="image-upload">
        <div class="upload-preview">
          <label for="image-upload-field-update" class="upload-button">
          <img src="./assets/icons/upload.png" alt="Upload Preview">
        </label>
      </div>
        <input style="padding: 6px; border-radius: 5px;" type="text" name="aimgurl" class="input-field add-url" placeholder="Enter image url">
      </div>
      <div class="add-product-form">
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
        <label for="categories-field">Shop</label>
        <?php 
        $shop1  = $_SESSION['shopname1'];
        $shop2  = $_SESSION['shopname2'];
        ?>
        <select id="shop_dropdown" name="shop">
    <option value="">Select a shop</option>
    <option value="<?php echo $shop1; ?>"><?php echo $shop1; ?></option>
    <option value="<?php echo $shop2; ?>"><?php echo $shop2; ?></option>
  </select>
        <label for="productdetail">Product Details</label>
          <textarea name="aproductdetail" class="input-field prod-detail"></textarea>
        <div class="checkbox-container">
          <input type="checkbox" id="show-checkbox" name="acheckbox" />
          <label for="show-checkbox">Show On Store</label>
        </div>
        <input type="submit" class="add-btn" value="Add" name="addbtn" />
        </div>
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
          <form class="details-form" method="post" action="trader-info.php">
            <div class="trader-info-update-container">
              <p class="heading3">Edit Profile:</p>
              <label for="name-field">Name</label>
              <input name="fullname" type="text" id="name-field" class="input-field" value="<?php echo $_SESSION['fullname'];  ?>" />
              <label for="username-field">Username</label>
              <input type="text" name="username" id="username-field" class="input-field" value="<?php echo $_SESSION['username'];  ?>" />
              <label for="email-field">Email</label>
              <input type="text" id="email-field" class="input-field" name="email" value="<?php echo $_SESSION['email'];  ?>" />
              <label for="contact-no-field">Contact Number</label>
              <input type="text" name="contact_no" id="contact-no-field" class="input-field" value="<?php echo $_SESSION['contactnumber'];  ?>" />
              <label for="address-field">Address</label>
              <input type="text" id="address-field" class="input-field" value="Default Address 123" />
              <label for="dob-field">Date of Birth(D.O.B)</label>
              <input name="dob" type="date" id="dob-field" class="input-field"  value="<?php echo date('Y-m-d', strtotime($_SESSION['dob'])); ?>" />
              <input type="submit" class="delete-acc-btn" value="Delete Account" name="deleteaccbtn" />
            <input type="submit" class="save-btn" value="Save Changes" name="savechangesbtn" />
            </div>
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
          </div>
          </form>
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
             <a href="trader-info.php?editProductId=<?php echo $row['PRODUCT_ID']; ?>">
            <img src="./assets/icons/edit-icon.png" class="edit-icon"></img>
            </a>
            <a href="trader-info.php?deleteProductId=<?php echo $row['PRODUCT_ID']; ?>">
            <img src="./assets/icons/delete-icon.png" class="delete-icon"></img>
            </a>
          </div>
        </div>

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

  
//   const updateUrl =document.querySelector('.update-url');
//   const addUrl =document.querySelector('.add-url');
//   let imageUrl;

//   const handleUrlChange = (e) => {
//   const imageUrl = e.target.value;
//   console.log(imageUrl);

//   // Create an XMLHttpRequest object
//   const xhr = new XMLHttpRequest();

//   // Specify the PHP script URL and set the HTTP method to POST
//   const url = 'traderinfologic.php';
//   xhr.open('POST', url, true);

//   // Set the Content-Type header
//   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

//   // Construct the data to be sent to the server
//   const data = 'imageUrl=' + encodeURIComponent(imageUrl);

//   console.log(data);

//   // Send the HTTP request with the data
//   xhr.send(data);
// };
//   updateUrl.addEventListener('change', handleUrlChange);
//   addUrl.addEventListener('change', handleUrlChange);
//   console.log(document.querySelector('.upload-preview img'));
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>