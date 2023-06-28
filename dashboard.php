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
  <div class="dashboard-title"><img src="" alt=""> DASHBOARD</div>
  <div class="dashboard-overview">
    <div class="dashboard-overview--item">
      <img src="assets/img/icons/order.png" alt="">
      <h3>ORDERS<br/><span>351</span></h3>
      <span class="viewall--btn">VIEW ALL</span>
    </div>
    <div class="dashboard-overview--item">
      <img src="assets/img/icons/customer.png" alt="">
      <h3>CUSTOMERS<br/><span>351</span></h3>
      <span class="viewall--btn">VIEW ALL</span>
    </div>
    <div class="dashboard-overview--item">
      <img src="assets/img/icons/review-db.png" alt="">
      <h3>REVIEWS<br/><span>351</span></h3>
      <span class="viewall--btn">VIEW ALL</span>
    </div>
    <div class="dashboard-overview--item">
      <img src="assets/img/icons/cancelled-order.png" alt="">
      <h3>CANCELLED ORDERS<br/><span>351</span></h3>
      <span class="viewall--btn">VIEW ALL</span>
    </div>
  </div>
  <section class="dashboard-main">
    <div class="dashboard-chart">

    </div>
    <div class="dashboard-pending">
      <h4>ORDERS <span>145</span></h4>
      <h4>RETURN EXCHANGE <span>27</span></h4>
      <h4>ABANDONED CART <span>196</span></h4>
      <h4>OUT OF STOCK PRODUCTS <span>71</span></h4>
    </div>
    <div class="dashboard-buyers">
      <div class="dashboard-buyers--info">
        <img src="" alt="">
        <span>BUYER NAME</span>
        <h4>Price</h4>
      </div>
      <div class="dashboard-buyers--info">
        <img src="" alt="">
        <span>BUYER NAME</span>
        <h4>Price</h4>
      </div>
      <div class="dashboard-buyers--info">
        <img src="" alt="">
        <span>BUYER NAME</span>
        <h4>Price</h4>
      </div>
      <div class="dashboard-buyers--info">
        <img src="" alt="">
        <span>BUYER NAME</span>
        <h4>Price</h4>
      </div>
    </div>
  </section>
<?php include 'includes/footer.php' ?>
<script src="app/js/script.js"></script>
</body>
</html>