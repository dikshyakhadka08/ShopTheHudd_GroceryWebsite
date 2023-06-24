<?php
require('connectsession.php');
require('commonfunctions.php');
session_start();

// Get the user_id from the session
$user_id = $_SESSION['id'];

$category_query = oci_parse($conn, "SELECT TRADER_TYPE, SHOP_ID FROM SHOP WHERE USER_ID = :user_id");
oci_bind_by_name($category_query, ":user_id", $user_id);
oci_execute($category_query);

$category_row = oci_fetch_assoc($category_query);
$category_name = $category_row['TRADER_TYPE'];
$shop_id = $category_row['SHOP_ID'];

echo $category_name;

$idrandom = rand(0,100) + rand(100,1000) + rand(0,99);
if (isset($_POST['addproduct'])){
// Query the SHOP table to get the category_name based on the user_id


// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $product_name = inputdata($_POST['product_name']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $stock_status = $_POST['stock_status'];
    $min_order = 0;
    $max_order = 95;
    $product_detail = inputdata($_POST['product_detail']);
    $allergy_info = $_POST['allergy_info'];
    $product_img = $_POST['product_img'];

    // Prepare the INSERT statement
    $insert_query = oci_parse($conn, "INSERT INTO PRODUCT (
        PRODUCT_ID,
        PRODUCT_NAME,
        PRICE,
        QUANTITY,
        STOCK_STATUS,
        MIN_ORDER,
        MAX_ORDER,
        PRODUCT_DETAIL,
        ALLERGY_INFO,
        PRODUCT_IMG,
        SHOP_ID,
        USER_ID,
        CATEGORY_NAME
    ) VALUES (
        :product_id,
        :product_name,
        :price,
        :quantity,
        :stock_status,
        :min_order,
        :max_order,
        :product_detail,
        :allergy_info,
        :product_img,
        :shop_id,
        :user_id,
        :category_name
    )");

    // Generate a random product ID
    $product_id = rand(1000, 9999);

    // Bind the parameters
    oci_bind_by_name($insert_query, ":product_id", $product_id);
    oci_bind_by_name($insert_query, ":product_name", $product_name);
    oci_bind_by_name($insert_query, ":price", $price);
    oci_bind_by_name($insert_query, ":quantity", $quantity);
    oci_bind_by_name($insert_query, ":stock_status", $stock_status);
    oci_bind_by_name($insert_query, ":min_order", $min_order);
    oci_bind_by_name($insert_query, ":max_order", $max_order);
    oci_bind_by_name($insert_query, ":product_detail", $product_detail);
    oci_bind_by_name($insert_query, ":allergy_info", $allergy_info);
    oci_bind_by_name($insert_query, ":product_img", $product_img);
    oci_bind_by_name($insert_query, ":shop_id", $shop_id);
    oci_bind_by_name($insert_query, ":user_id", $user_id);
    oci_bind_by_name($insert_query, ":category_name", $category_name);

    // Execute the INSERT statement
    $insert_result = oci_execute($insert_query);

    if ($insert_result) {
        echo '<script>alert("Product inserted successfully.");</script>';
    } else {
        $error_message = oci_error($insert_query);
        echo '<script>alert("Failed to insert product: ' . $error_message['message'] . '");</script>';
    }
}

// Close the OCI connection
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
    <link rel="stylesheet" href="../dist/main.css" />
  </head>
<body>
<?php include 'includes/header.php' ?>
<div class="container">
        <h2>Add Product</h2>
        <form method="POST" action="addprod.php">
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" maxlength="100" required>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" name="price" maxlength="50" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="text" name="quantity">
            </div>

            <div class="form-group">
                <label for="stock_status">Stock Status:</label>
                <input type="text" name="stock_status">
            </div>

            <div class="form-group">
                <label for="product_detail">Product Detail:</label>
                <input type="text" name="product_detail" maxlength="1000" required>
            </div>

            <div class="form-group">
                <label for="allergy_info">Allergy Info:</label>
                <input type="text" name="allergy_info">
            </div>

            <div class="form-group">
                <label for="product_img">Product Image:</label>
                <input type="url" name="product_img" style="width: 500px;" required>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" value="Add Product" name="addproduct">
            </div>
        </form>
    </div>



</body>
<html>
addprod.php
6 KB