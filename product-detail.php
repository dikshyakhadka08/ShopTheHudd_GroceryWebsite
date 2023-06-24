<?php require('productdetaillogic.php'); ?>
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
    <link rel="stylesheet" href="../star-rating/starability.css">
    <link rel="stylesheet" href="../dist/main.css" />
  </head>

  <body>
  <?php include 'includes/header.php' ?>
  <section class="product-detail">
    <a class="goback-btn" href="products-page.php"><img src="assets/icons/back-arrow.png" alt=""> Go Back</a>
    <div class="product-detail__header">
      <h3>Product Name</h3>
      <div class="product-detail__img--box">
        <img src="<?php echo $image; ?>" alt="">
      </div>
    </div>
    <div class="product-detail__body">
      <div class="product-detail__overview">
        <h4>Overview</h4>
        <p><?php echo $productdetails;?></p>
      </div>
      <div class="star-rating">
        <input type="radio" id="star5" name="rating" value="5" />
        <label for="star5">&#9733;</label>
        <input type="radio" id="star4" name="rating" value="4" />
        <label for="star4">&#9733;</label>
        <input type="radio" id="star3" name="rating" value="3" />
        <label for="star3">&#9733;</label>
        <input type="radio" id="star2" name="rating" value="2" />
        <label for="star2">&#9733;</label>
        <input type="radio" id="star1" name="rating" value="1" />
        <label for="star1">&#9733;</label>
      </div>
      <div class="product-detail__summary">
        <div class="product-detail__summary--info">
          <img src="assets/icons/verify.png" alt="">
          <span>Good Quality</span>
        </div>
        <div class="product-detail__summary--info">
          <img src="assets/icons/verify.png" alt="">
          <span>This item is non-returnable</span>
        </div>
        <div class="product-detail__summary--info">
          <img src="assets/icons/verify.png" alt="">
          <span>Top choice</span>
        </div>
        <form action="product-detail.php?product=<?php echo $_SESSION['productID']; ?>" method="post" class="pd-form">
          <label for="p_quantity">Quantity:</label>
          <select id="quantity" name="p_quantity"></select>
          <span>Shop name: <?php echo $shopName;?></span>
          <span id="price">Price: $<?php echo $price;?></span>
          <div class="product-detail__summary--btn">
            <button name="add_to_cart" type="submit">Add to Cart</button>
            <button 
            type="submit"
            name="add_to_wishlist">Add to Wishlist</button>
            <button>Buy now</button>
          </div>
        </form>
      </div>
    </div>
    <?php
      $UID = $_SESSION['id'];
      $PID = $_SESSION['productID'];
      $commentsQuery = "SELECT * FROM REVIEW WHERE USER_ID = :user_id AND PRODUCT_ID = :product_id";
      $commentsStatement = oci_parse($conn, $commentsQuery);
      oci_bind_by_name($commentsStatement, ':user_id', $UID);
      oci_bind_by_name($commentsStatement, ':product_id', $PID);
      oci_execute($commentsStatement);
    ?>
    <form method="post" action="product-detail.php">
    <div class="product-detail__review">
      <h4>Review this product</h4>
      <textarea name="review" id="review" cols="30" rows="10"></textarea>
      <button name="itemsubmit" type="submit">Comment</button>
    </div>
</form>
  <?php 
    while ($row = oci_fetch_array($commentsStatement, OCI_ASSOC)) :
  ?>
  <div class="product-comment">
      <div class="product-comment__user">
        <div class="product-comments__userinfo">
        <img class="product-comment__icon" src="assets/icons/profile.png" />
        <p><?php echo $_SESSION['username']; ?></p>
        </div>
        <div class="product-comment__actions">
          <img src="assets/icons/edit-icon.png" alt="">
          <img src="assets/icons/delete-icon.png" alt="">
        </div>
      </div>
      <p class="product-comment__location">
        Reviewed in the Location <strong>Nepal</strong> on Date <strong><?php echo date("l jS \of F Y") . "<br>"; ?></strong>
      </p>
      <span class="product-comment__verified">
        Verified Purchase
      </span>
      <p class="product-comment__comment">
        <?php echo $row['COMMENTT']; ?>
      </p>
      <p class="product-comment__useful">
        How many people find it helpful
      </p>
      <div class="product-comment__review">
        <button>Helpful</button>
        <span>Report abuse</span>
      </div>
    </div>
  <?php endwhile; ?>
  </section>
<?php include 'includes/footer.php' ?>
<script src="app/js/script.js"></script>
<script>
  // Get the quantity dropdown element
const quantityDropdown = document.getElementById("quantity");

// Add options for quantities from 1 to 20
for (let i = 1; i <= 20; i++) {
  let option = document.createElement("option");
  option.text = i;
  quantityDropdown.add(option);
}

const starRating = document.querySelector('.star-rating');

starRating.addEventListener('click', (event) => {
  const selectedRating = event.target.getAttribute('for');
  console.log('Selected rating:', selectedRating);
});

  // Get the necessary elements
  const quantitySelect = document.getElementById('quantity');
  const priceSpan = document.getElementById('price');
  const originalPrice = <?php echo $price; ?>; // Get the original price from PHP

  // Add event listener to the quantity select element
  quantitySelect.addEventListener('change', function() {
    // Get the selected quantity
    const selectedQuantity = parseInt(this.value);

    // Calculate the updated price based on the selected quantity
    const updatedPrice = originalPrice * selectedQuantity;

    // Update the price displayed on the page
    priceSpan.textContent = 'Price: $' + updatedPrice;
  });

</script>
</body>
</html>
