<?php require('connectsession.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Trader Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Add your custom CSS effects here */

    body {
      background-color: #eef2f5;
    }

    .tip-card {
      background-color: #ffffff;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
    }

    .tip-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .tip-card h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }

    .tip-card p {
      font-size: 14px;
      color: #555555;
    }

    .dashboard-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 30px;
      color: #333333;
    }

    .dashboard-user-info {
      background-color: #ffffff;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 30px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .dashboard-user-info p {
      font-size: 16px;
      color: #555555;
    }

    .tips-section {
      margin-bottom: 30px;
    }

    .generate-report-button {
      background-color: #007bff;
      color: #ffffff;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      font-size: 16px;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .generate-report-button:hover {
      background-color: #0056b3;
    }

    .custom-button {
      display: inline-block;
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      background-color: #007bff;
      color: #fff;
      border-radius: 4px;
      transition: background-color 0.3s;
    }
    .custom-button:hover {
      background-color: #0056b3;}
  </style>
</head>
<body>

  <div class="container">
    <div class="dashboard-title">Welcome to the Trader Database Path</div>

    <div class="dashboard-user-info">
  <h2>User Information</h2>
  <div class="user-profile">
    <div class="user-avatar">
      <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="User Avatar" height="50px">
    </div>
    <div class="user-details">
      <p class="user-name">Username: <?php echo $_SESSION['fullname']; ?></p>
      <p class="user-email">Email: <?php echo $_SESSION['email']; ?></p>
      <p class="user-id">ID: <?php echo $_SESSION['id']; ?></p>
      <p class="user-id">Number Of Products: <?php $query = "SELECT COUNT(*) AS productCount FROM product WHERE user_id = {$_SESSION['id']}";
$statement = oci_parse($conn, $query);
oci_execute($statement);
$row = oci_fetch_assoc($statement);
$productCount = $row['PRODUCTCOUNT'];
echo $productCount; ?></p>
    </div>
  </div>
</div>
<a href="trader-info.php" class="custom-button">Go to Trader Info</a>
    <div class="tips-section">
      <h2>Tips for Traders</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="tip-card">
            <h3>Tip 1</h3>
            <p>Set realistic goals and stick to your trading plan. Don't let emotions drive your decisions.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="tip-card">
            <h3>Tip 2</h3>
            <p>Practice proper risk management. Only risk a small portion of your capital on each trade.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="tip-card">
            <h3>Tip 3</h3>
            <p>Stay informed about market news and events that can impact your trades.</p>
          </div>
        </div>
      </div>
    </div>

    <button class="generate-report-button" onclick="redirectToReportPage()">Generate Report</button>
  </div>
  
  <!-- Include Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
function redirectToReportPage() {
  window.open('http://localhost:8080/apex/f?p=113:LOGIN_DESKTOP:2793251165231:::::', '_blank');
}
</script>
</body>
</html>
