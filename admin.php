<?php include 'connectsession.php';
error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/main.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    
    body {
      background-color: white;
      color: white;
    }

    .switch {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 20px;
    margin: 0;
  }

 
    .navbar {
      background-color: #f8f9fa;
      padding: 10px 20px;
      margin-bottom: 20px;
    }
    .navbar-button {
      color: #333;
      font-weight: bold;
      text-decoration: none;
      padding: 8px 15px;
      border: 2px solid #333;
      border-radius: 4px;
      transition: background-color 0.3s, color 0.3s;
    }
    .navbar-button:hover {
      background-color: #333;
      color: #fff;
    }
  
  
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #4CAF50; /* Default color: green */
    transition: .4s;
  }
  
  .slider:before {
    position: absolute;
    content: "";
    height: 14px;
    width: 14px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
  }
  
  input[type='checkbox'] {
    display: none;
  }
  
  input:checked + .slider {
    background-color: white; /* Checked color: white */
  }
  
  input:checked + .slider:before {
    transform: translateX(20px);
    background-color: #4CAF50; /* Checked color: green */
  }
    .center-button {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 90px;
      background-color: rosybrown;
    }

    /* Style the button */
    .center-button button {
      padding: 10px 20px;
      font-size: 18px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }

    .center-button button:hover {
      background-color: red;
    }

    .sidebar {
      background-color: #AD974F;
      color: white;
      min-height: 100vh;
      padding: 20px;
    }

    .content {
      margin-top: 30px;
    }

    .dashboard-card {
      background-color: white;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      color: black;
    }

    .dashboard-card h3 {
      margin-top: 0;
    }

    .dashboard-card p {
      margin-bottom: 0;
    }

    .nav-link {
      color: white;
    }

    .nav-link.active {
      font-weight: bold;
    }

    .box {
      background-color: white;
      border-radius: 10px;
      border: 2px solid black;
      color: black;
    }

    table {
      background-color: white;
      border: 2px solid black;
    }

    th {
      background-color: mintcream;
    }

    td {
      color: black;
    }
  </style>
</head>

<body>
  <?php include('includes/header.php'); ?>
  <nav class="navbar">
    <a href="http://localhost:8080/apex/f?p=113:LOGIN_DESKTOP:2793251165231:::::" class="navbar-button">Go to Report</a>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-2 sidebar" style="background-color: black; color: white; font-size: 18px; padding: 4rem 0 1rem 2rem;">
  <h3>Admin Dashboard</h3>
  <ul class="nav flex-column mt-4">
    <li class="nav-item">
      <a class="nav-link trader-link" href="#traders"><span style="color: white;">Traders</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><span style="color: white;">Users</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><span style="color: white;">Products</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><span style="color: white;">Shops</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><span style="color: white;">Reviews</span></a>
    </li>
  </ul>
</div>
      <?php    
        $usersqry = "SELECT * FROM USERR";
        $statementt = oci_parse($conn, $usersqry);
        oci_execute($statementt);
        $usersvalue = 0;
        while ($row = oci_fetch_array($statementt, OCI_ASSOC)) {
          $usersvalue++;
        }
      ?>
      <!-- Main Content -->
      <div class="col-10 content traders-section">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
        <div class="dashboard-card">
          <h3>Total Users: </h3>
          <p><?php echo $usersvalue; ?></p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="dashboard-card">
        <?php
// Assuming you have a valid database connection $conn

// Prepare the COUNT query
$count_query = oci_parse($conn, "SELECT COUNT(*) AS total_orders FROM ORDERR");

// Execute the query
oci_execute($count_query);

// Fetch the result
$count_row = oci_fetch_assoc($count_query);
$total_orders = $count_row['TOTAL_ORDERS'];

?>

<h3>Total Orders</h3>
<p><?php echo $total_orders; ?></p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 box">
        <div class="row">
          <div class="col-5"></div>
          <div class="col-4 h2" id="traders">
            Trader List
          </div>
          <?php
            $tradquery = "SELECT * FROM USERR WHERE ROLE = 'Trader'";
            $statement = oci_parse($conn, $tradquery);
            oci_execute($statement);
          ?>
          <table class="table">
            <tr>
              <th>User</th>
              <th>Email</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            <?php
              while ($row = oci_fetch_array($statement, OCI_ASSOC)) { ?>
                <form method="get" action="switchtrader.php">
                  <tr>
                    <td><?php echo $row['USERNAME']; ?></td>
                    <td><?php echo $row['EMAIL']; ?></td>
                    <td><?php echo $row['STATUS']; ?></td>
                    <td>
                      <a href="switchtrader.php?id=<?php echo $row['USER_ID']; ?>" class="btn btn-secondary" name="id">Turn ON</a>
                      &nbsp;
                      <a href="reverseswitchtrader.php?id=<?php echo $row['USER_ID']; ?>" class="btn btn-primary" name="idd">Turn OFF</a>
                    </td>
                  </tr>
                <?php } ?>
              </form>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-10 content users-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="dashboard-card">
          <h3>Users</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Role</th>
                <th>Date of Birth</th>
                <th>Restrict</th>
                <th>Unrestrict</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $usersqry = "SELECT * FROM USERR WHERE ROLE = 'Customer'";
              $statement = oci_parse($conn, $usersqry);
              oci_execute($statement);

              while ($row = oci_fetch_array($statement, OCI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['USER_ID'] . "</td>";
                echo "<td>" . $row['USERNAME'] . "</td>";
                echo "<td>" . $row['FULLNAME'] . "</td>";
                echo "<td>" . $row['EMAIL'] . "</td>";
                echo "<td>" . $row['CONTACT_NO'] . "</td>";
                echo "<td>" . $row['ROLE'] . "</td>";
                echo "<td>" . $row['DOB'] . "</td>";
                
                if ($row['STATUS'] == 'Restricted') {
                  echo "<td><span style='text-decoration: none; color: #990000;'>&#9888;</span></td>";
    
                  echo "<td><button class='btn btn-danger' onclick='unrestrictUser(" . $row['USER_ID'] . ", this)'>Unrestrict</button></td>";
                } else if ($row['STATUS'] == 'Unrestricted') {
     
                  echo "<td><button class='btn btn-danger' onclick='restrictUser(" . $row['USER_ID'] . ", this)'>Restrict</button></td>";
                  echo "<td></td>";
                } else {
                  echo "<td><button class='btn btn-danger' onclick='restrictUser(" . $row['USER_ID'] . ", this)'>Restrict</button></td>";
                  echo "<td><button class='btn btn-danger' onclick='unrestrictUser(" . $row['USER_ID'] . ", this)'>Unrestrict</button></td>";

                }
                
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function restrictUser(userId, buttonElement) {
    var confirmation = confirm("Are you sure you want to restrict this user?");
    if (confirmation) {
      // Change the background color of the row to a lighter red shade
      buttonElement.closest('tr').style.backgroundColor = '#ffcccc';
      // Disable the clicked restrict button
      buttonElement.disabled = true;
      // Enable the corresponding unrestrict button
      buttonElement.parentNode.nextElementSibling.querySelector('button').disabled = false;
    }
  }
  
  function unrestrictUser(userId, buttonElement) {
    var confirmation = confirm("THIS IS OF NO USE IF IT IS NOT RESTRICTED EVEN IF PRESSED.\nAre you sure you want to unrestrict this user?");
    if (confirmation) {
      // Change the background color of the row to a lighter green shade
      buttonElement.closest('tr').style.backgroundColor = '#ccffcc';
      // Disable the clicked unrestrict button
      buttonElement.disabled = true;
      // Enable the corresponding restrict button
      buttonElement.parentNode.previousElementSibling.querySelector('button').disabled = false;
    }
  }
</script>

<div class="col-10 content products-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="dashboard-card">
          <h3>Products</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Product Detail</th>
                <th>Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $productsqry = "SELECT PRODUCT_ID, PRODUCT_NAME, PRICE, QUANTITY, PRODUCT_DETAIL, CATEGORY_NAME FROM PRODUCT";
              $statement = oci_parse($conn, $productsqry);
              oci_execute($statement);

              while ($row = oci_fetch_array($statement, OCI_ASSOC)) {
                echo "<tr id='product_" . $row['PRODUCT_ID'] . "'>";
                echo "<td>" . $row['PRODUCT_ID'] . "</td>";
                echo "<td>" . $row['PRODUCT_NAME'] . "</td>";
                echo "<td>" . $row['PRICE'] . "</td>";
                echo "<td>" . $row['QUANTITY'] . "</td>";
                echo "<td>" . $row['PRODUCT_DETAIL'] . "</td>";
                echo "<td>" . $row['CATEGORY_NAME'] . "</td>";
                echo "<td><button class='delete-btn' onclick='deleteProduct(" . $row['PRODUCT_ID'] . ", this)'>Delete</button></td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function deleteProduct(productId, buttonElement) {
    var confirmation = confirm("Are you sure you want to delete this product?");
    if (confirmation) {
      // Change the text color and background of the deleted row
      var row = buttonElement.closest('tr');
      row.style.backgroundColor = '#FFCCCC'; // Set background color to a light red shade
      row.style.color = '#990000'; // Set text color to a dark red shade
      row.style.textDecoration = 'line-through'; // Add a line-through style to the text
    }
  }
</script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Handle delete button click
    $('.delete-btn').on('click', function() {
      var productId = $(this).data('productid');
      deleteProduct(productId, $(this));
    });

    // Delete product via AJAX
    function deleteProduct(productId, buttonElement) {
      $.ajax({
        url: 'delete_product.php',
        method: 'POST',
        data: { productId: productId },
        success: function(response) {
          // Remove the deleted row from the table
          if (response === 'success') {
            buttonElement.closest('tr').fadeOut(500, function() {
              $(this).remove();
            });
          }
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    }
  });
</script>



<div class="col-10 content shops-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="dashboard-card">
          <h3>Shops</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Shop ID</th>
                <th>Shop Name</th>
                <th>Trader Type</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $shopsqry = "SELECT SHOP_ID, SHOP_NAME, TRADER_TYPE FROM SHOP";
              $statement = oci_parse($conn, $shopsqry);
              oci_execute($statement);

              while ($row = oci_fetch_array($statement, OCI_ASSOC)) {
                $shopId = $row['SHOP_ID'];
                $status = isset($_COOKIE['status_' . $shopId]) ? $_COOKIE['status_' . $shopId] : 'Not Verified';

                echo "<tr>";
                echo "<td>" . $row['SHOP_ID'] . "</td>";
                echo "<td>" . $row['SHOP_NAME'] . "</td>";
                echo "<td>" . $row['TRADER_TYPE'] . "</td>";
                echo "<td>";
                echo "<label for='status_" . $shopId . "' class='switch'>";
                echo "<input type='checkbox' id='status_" . $shopId . "' onclick='toggleStatus(" . $shopId . ")' " . ($status === 'Verified' ? 'checked' : '') . ">";
                echo "<span class='slider'></span>";
                echo "</label>";
                echo "</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function toggleStatus(shopId) {
    var statusElement = document.getElementById('status_' + shopId);
    var currentStatus = statusElement.checked;

    if (currentStatus) {
      statusElement.checked = false;
      localStorage.setItem('status_' + shopId, 'Not Verified');
    } else {
      statusElement.checked = true;
      localStorage.setItem('status_' + shopId, 'Verified');
    }
  }

  // Update checkbox status on page load
  window.addEventListener('DOMContentLoaded', function() {
    <?php
    $statement = oci_parse($conn, $shopsqry);
    oci_execute($statement);
  
    while ($row = oci_fetch_array($statement, OCI_ASSOC)) {
      $shopId = $row['SHOP_ID'];
      $status = isset($_COOKIE['status_' . $shopId]) ? $_COOKIE['status_' . $shopId] : 'Not Verified';
  
      echo "document.getElementById('status_" . $shopId . "').checked = " . ($status === 'Verified' ? 'true' : 'false') . ";";
  
      // Update local storage with the initial status
      echo "localStorage.setItem('status_" . $shopId . "', '" . $status . "');";
    }
    ?>
  });
</script>


<div class="col-10 content reviews-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="dashboard-card">
          <h3>Review</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Review ID</th>
                <th>Comment</th>
                <th>Product ID</th>
                <th>User ID</th>
      
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $reviewsqry = "SELECT REVIEW_ID, COMMENTT, RATING, PRODUCT_ID, USER_ID FROM REVIEW";
              $statement = oci_parse($conn, $reviewsqry);
              oci_execute($statement);

              while ($row = oci_fetch_array($statement, OCI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['REVIEW_ID'] . "</td>";
                echo "<td>" . $row['COMMENTT'] . "</td>";
                echo "<td>" . $row['PRODUCT_ID'] . "</td>";
                echo "<td>" . $row['USER_ID'] . "</td>";
                // echo "<td>" . $row['USER_NAME'] . "</td>";
                echo "<td><button class='btn btn-danger delete-review' data-reviewid='" . $row['REVIEW_ID'] . "'>Delete</button></td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-review');

    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        const reviewId = button.getAttribute('data-reviewid');

        // Perform an AJAX request to delete the review using the reviewId
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_review.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          if (xhr.status === 200) {
            // Review deleted successfully, you can update the table dynamically or display a success message
            button.closest('tr').remove();
          } else {
            // Error occurred while deleting the review
            console.error('Error deleting review. Status:', xhr.status);
          }
        };
        xhr.onerror = function() {
          console.error('Error deleting review. Please try again later.');
        };
        xhr.send('reviewId=' + reviewId);
      });
    });
  });
</script>


</div>
</div>
<div class="center-button">
    <a href="logout.php"><button>Logout</button></a>
  </div>
<?php include('includes/footer.php'); ?>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
<script>
  const navLinks = document.querySelectorAll('.nav-link');
  const traderLink = document.querySelector('.trader-link');
  const userSection = document.querySelector('.users-section');
  const traderSection = document.querySelector('.traders-section');
  const productSection = document.querySelector('.products-section');
  const shopsSection = document.querySelector('.shops-section');
  const reviewsSection = document.querySelector('.reviews-section');

  function hideAll() {
  userSection.style.display = "none";
  traderSection.style.display = "none";
  productSection.style.display = "none";
  shopsSection.style.display = "none";
  reviewsSection.style.display = "none"; // Add this line
}
  hideAll();
  traderSection.style.display = "block";
  traderLink.classList.add('active');

  navLinks.forEach((link) => {
    link.addEventListener('click', () => {
      navLinks.forEach((link) => link.classList.remove('active'));
      link.classList.add('active');

     if (link.textContent === 'Users') {
        hideAll();
        userSection.style.display = "block";
      } else if (link.textContent === 'Traders') {
        hideAll();
        traderSection.style.display = "block";
     } else if (link.textContent === 'Products') {
        hideAll();
        productSection.style.display = "block";
        
      } else if (link.textContent === 'Shops') {
        hideAll();
        shopsSection.style.display = "block";
      }
      else if (link.textContent === 'Reviews') { // Add this condition
  hideAll();
  reviewsSection.style.display = "block";
}
    });
  })
  

</script>
</html>
