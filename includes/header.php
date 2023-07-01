<?php include 'connectsession.php' ?>

<section class="header">
  <div class="topnav">
    <div class="topnav_left">
      <?php if(isset($_SESSION['username'])): ?>
        <div class="profile-dropdown">
          <img src="assets/icons/profile.png" alt="" class="profile-icon">
          <div class="profile-dropdown-content">
            <a href="<?php echo $_SESSION['role'] === 'Trader' ? 'trader-info.php' : 'customer-info.php'; ?>">User Info</a>
            <a href="logout.php">Logout</a>
          </div>
       </div>
      <?php else: ?>
      <a href="login.php" class="topnav_signin">SIGN IN</a>
      <span> | </span>
      <a href="register.php" class="topnav_register">REGISTER</a>
      <a href="" class="topnav_helpcenter">HELP CENTER</a>
      <?php endif; ?>
    </div>
    <div class="topnav_right">
      <img src="assets/icons/location.svg" alt="Location icon" class="topnav_icon" />
      <a href="" class="topnav_storefinder">STORE FINDER</a>
      <a href="wishlist.php" class="topnav_wishlist">WISHLIST</a>
    </div>
  </div>
  <nav class="mainnav">
    <div class="mainnav_logo__cnt">
      <img class="mainnav_logo" src="assets/logo/logo.png" alt="Logo" />
    </div>
    <ul class="mainnav_navlinks">
      <li class="mainnav_navlink"><a href="home.php">HOME</a></li>
      <li class="mainnav_navlink"><a href="about.php">ABOUT US</a></li>
      <li class="mainnav_navlink"><a href="products-page.php">PRODUCT</a></li>
      <li class="mainnav_navlink"><a href="">CATEGORY</a></li>
      <li class="mainnav_navlink"><a href="">SHOP</a></li>
    </ul>
    <div class="mainnav_icons">
      <label class="search_label" for="mainnav_icons_search">Search</label>
      <input type="text" id="mainnav_icons_search" />
      <img class="search_icon" src="assets/icons/search.svg" alt="Search Icon">
      <div class="cart_icon_container">
  <a href="http://localhost/shophud/src/cart.php" >
    <img class="cart_icon" src="assets/icons/cart.svg" alt="Cart Icon">
    <!-- <span class="cart_count">0</span> -->
  </a>
</div>
    </div>
  </nav>
  <div class="mobile_nav_button" id="nav_btn">
      <span id="1"></span>
      <span id="2"></span>
      <span id="3"></span>
    </div>
</section>