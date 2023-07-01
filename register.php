<?php 
include 'registerlogic.php';
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
  <section class="register">
  <div class="register_body">
  <div class="register_left">
    <img src="https://cdn.pixabay.com/photo/2015/07/10/16/15/bag-839602_1280.jpg" alt="Register image" />
  </div>
  <div class="register_right">
      <h3>Create an Account</h3>
      <p>Please fill out the form below to get started.</p>
      <div class="register_options">
        <a href="#" id="active">Sign up with Customer</a>
        <a href="#" id="">Sign up with Trader</a>
      </div>

      <div id="customer_signup_form">
        <form method="post" action="register.php">
          <label for="cname">Name</label>
          <span class="v-error">
                                    <?php
                                    if (isset($_POST['toregister'])) {
                                        if (!empty($namesperror)) {
                                            echo  $namesperror;
                                        }
                                    }
                                    ?>
          </span>
          <input type="text" id="cname" name="cname" required>

          <label for="cusername">Username</label>
          <input type="text" id="cusername" name="cusername" required>

          <label for="cemail">Email</label>
          <input type="email" id="cemail" name="cemail" required>

          <label for="cpassword">Password</label>
          <span class="v-error">
                                    <?php
                                    if (isset($_POST['toregister'])) {
                                        if (!empty($pwerror)) {
                                            echo  $pwerror;
                                        }
                                    }
                                    ?>
                                </span>
          <input type="password" id="cpassword" name="cpassword" required>

          <label for="cconfirm_password">Confirm Password</label>
          <input type="password" id="cconfirm_password" name="cconfirm_password" required>

          <label for="ccontact_number">Contact Number</label>
            <span class="v-error">
                                    <?php
                                    if (isset($_POST['contact_number'])) {
                                        if (!empty($limit)) {
                                            echo  $limit;
                                        }
                                    }
                                    ?>
                                </span>
            <input type="text" id="contact_number" maxlength="10" name="ccontact_number" required>

            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="cdob" required>

          <div class="terms_and_conditions">
            <input type="checkbox" id="cterms_and_conditions" name="cterms_and_conditions" required>
            <label for="cterms_and_conditions">Creating an account means you're okay with our <a href="#">Terms of Service</a>, <a href="#">Privacy Policy</a>, and our default <a href="#">Notification Settings.</a></label>
          </div>
          <button class="create_account--btn" type="submit" name="toregister">Create Account</button>
        </form>
       </div>
       <div id="trader_signup_form">
          <form class="trader_signup_part_1" method="post" action="register.php">
            <label for="tname">Name</label>
            <input type="text" id="tname" name="tname" required>

            <label for="tusername">Username</label>
            <input type="text" id="tusername" name="tusername" required>

            <label for="temail">Email</label>
            <input type="email" id="temail" name="temail" required>

            <label for="contact_number">Contact Number</label>
            <span class="v-error">
                                    <?php
                                    if (isset($_POST['contact_number'])) {
                                        if (!empty($limit)) {
                                            echo  $limit;
                                        }
                                    }
                                    ?>
                                </span>
            <input type="text" id="contact_number" name="contact_number" maxlength="10" required>

            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" required>
          
            <label for="tpassword">Password</label>
            <input type="password" id="tpassword" name="tpassword" required>

            <label for="tconfirm_password">Confirm Password</label>
            <input type="password" id="tconfirm_password" name="tconfirm_password" required>

            <!-- <label for="owned-shops">Shop Name</label>
            <input type="text" id="owned-shops" name="owned-shops" required> -->
            <label for="owned-shops">Shop Name</label>
            <input type="text" id="owned-shops" name="owned-shops[]">
            <button type="button" id="add-shop-btn">Add</button>
            <div id="added-shops"></div>

            <div class="gender-dropdown">
              <label for="trader-gender">Gender</label>
              <select id="trader-gender" name="tgender" required>
                <option value="">Select gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>

            <label for="company_address">Address</label>
            <input type="text" id="company_address" name="company_address" required>

            <label for="company_post_code">Post Code</label>
            <input type="text" id="company_post_code" name="company_post_code" required>

            <label for="shoptype">Shop Type</label>
            <input type = "text" id="tshop_type" name="shoptype" required>
            <div class="terms_and_conditions">
            <input type="checkbox" id="tterms_and_conditions" name="tterms_and_conditions" required>
            <label for="terms_and_conditions">Creating an account means you're okay with our <a href="#">Terms of Service</a>, <a href="#">Privacy Policy</a>, and our default <a href="#">Notification Settings.</a></label>
          </div>
          <button class="create_account--btn" type="submit" name="toregister">Create Account</button>
      </form>
</div>
<div class="register_linebreak">
    <hr />
    <p>or Continue With</p>
    <hr />
  </div>
  <div class="register_social">
    <a href="#">
      <img src="assets/icons/facebookC.png" alt="Facebook" />
    </a>
    <a href="#">
      <img src="assets/icons/googleC.png" alt="Google" />
    </a>
    <a href="#">
      <img src="assets/icons/twitterC.png" alt="Twitter" />
    </a>
  </div>
  </div>
  </div>
</section>
<?php include 'includes/footer.php' ?>
<script src="app/js/script.js"></script>
<script>
  
  const signupCustomerBtn = document.getElementById('customer_signup');
  const signupTraderBtn = document.getElementById('trader_signup');
  const signupBtns = document.querySelectorAll('.register_options a');
  const customerForm = document.getElementById('customer_signup_form');
  const traderForm =document.getElementById('trader_signup_form');
  const traderForm1 = document.querySelector('.trader_signup_part_1');
  const traderForm2 = document.querySelector('.trader_signup_part_2');
  const createAccBtn = document.querySelector('.create_account--btn');

  traderForm.style.display = 'none';

  signupBtns.forEach((btn) => {
  btn.addEventListener('click', (e) => {
      e.preventDefault();
      signupBtns.forEach((btn) => {
        btn.removeAttribute('id');
      }) ;
      btn.setAttribute('id', 'active');
      const signupAs = btn.textContent.split(' ')[3].toLowerCase();
      if (signupAs === 'customer') {
        console.log("HELLO");
        customerForm.style.display = 'block';
        traderForm.style.display = 'none';
      } else if (signupAs === 'trader') {
        traderForm.style.display = 'block';
        customerForm.style.display = 'none';
      }
  })
  })

  const inputFields = document.querySelectorAll('input');

  createAccBtn.addEventListener('click', (e) => {
    const vErrors =document.querySelectorAll('.v-error');
    vErrors.forEach((err) => {
      if (err.style.display = 'block') {

      }
    })

  })

 // Get the input field, add button, and the container for added shops
  const addBtn = document.getElementById('add-shop-btn');
  const ownedShopsInput = document.getElementById('owned-shops');
  const addedShopsContainer = document.getElementById('added-shops');

   // Keep track of added shop names
   const addedShops = [];


  // Add a listener for the input field's blur event
  addBtn.addEventListener('click', function() {
    console.log("HEY");
    const newShopName = ownedShopsInput.value.trim();

    // Check if the shop name is not empty and not already added
    if (newShopName !== '' && !addedShops.includes(newShopName)) {
      if (addedShops.length === 2) {
        alert('You can only add up to 2 shops');
        return;
      }
      // Add the shop name to the array
      addedShops.push(newShopName);

      // Create a new element to display the shop name
      const shopLabelElement = document.createElement('label');
      const shopNameElement = document.createElement('input');
      shopLabelElement.textContent = 'Shop Name';
      shopNameElement.textContent = newShopName;
      shopNameElement.setAttribute('name', 'owned-shop');
      shopNameElement.setAttribute('type', 'text');
      shopNameElement.setAttribute('value', newShopName);
      shopNameElement.setAttribute('disabled', 'true');

      // Append the shop name element to the container
      addedShopsContainer.appendChild(shopLabelElement);
      addedShopsContainer.appendChild(shopNameElement);

      // Clear the input field
      ownedShopsInput.value = '';
    }
  });

  // Append the added shop names to a hidden input field before submitting the form
  document.querySelector('.trader_signup_part_1').addEventListener('submit', function() {
    const hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'added-shops');
    hiddenInput.setAttribute('value', addedShops.join(','));

    this.appendChild(hiddenInput);
  });
</script>
</body>
</html>