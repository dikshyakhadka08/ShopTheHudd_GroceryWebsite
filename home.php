<?php require('connection.php') ?>
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
  <div class="modal_wrapper">
  <div class="modal">
    <button class="modal_close--btn">&times;</button>
    <div class="modal_images">
        <img class="modal_img" src="assets/img/card-img/butcher1.jpg" alt="Behind-the-scenes photo of butchers at work">
          <img class="modal_img" src="assets/img/card-img/butcher.jpg" alt="Behind-the-scenes photo of butchers at work">
      </div>
    <div class="modal_content">
    <h2>Butchers</h2>
    <p>Brief history: Established in 1965, our family-owned butcher shop has been providing quality meats to our community for over 50 years. Our founder, John Smith, learned the art of butchery from his father and passed the tradition down to his son, who now runs the shop.</p>
    <p>Locally sourced meats: All of our meats come from local farms within a 50-mile radius of our shop. We believe in supporting our local farmers and providing our customers with the freshest, highest quality meats.</p>
    <p>Recipe tip: Our bone-in ribeye steak is a customer favorite. For the perfect steak, let it rest at room temperature for 30 minutes before cooking. Season generously with salt and pepper, then sear on high heat for 2-3 minutes per side. Let the steak rest for 5-10 minutes before slicing.</p>
    </div>
  </div>
</div>
</div>
<section class="main_body">
      <?php include 'includes/header.php' ?>
    <div class="main_banner__cnt">
        <div class="main_banner">
          <!-- <img class="main_banner__img" src="assets/img/banner1.webp" alt=""> -->
        </div>
      <div class="banner_content">
        <!-- Make this a slideshow -->
  <h3>Support Independent Businesses: <br/> Shop Online with Us Today</h3>
  <a href="#" class="btn__home">Shop Now</a>
      </div>
    </div>
      <div class="trader_cards__heading--cnt">
        <h1 class="trader_cards__heading">
          WHAT WE OFFER?
        <!-- Add a background image with linear gradient like the natours home page top section to make this text look better -->
        </h1>
      </div>
      <div class="trader_cards">
        <div class="trader_card ">
          <div class="trader_card__side trader_card__side--front trader1">
            <h3>BUTCHER</h3>
          </div>
          <div class="trader_card__side trader_card__side--back">
            <h3>OVERVIEW</h3>
            <p>
            A butcher is a person who prepares and sells meat products such as beef, pork, lamb, and chicken. Butchers often have a wide range of cuts of meat available, including steaks, roasts, and ground meats. They may also sell other meat products such as sausages, bacon, and deli meats.
            </p>
            <a id="btn__butcher" class="btn__card btn__card--animated" href="#">About the trader</a>
          </div>
        </div>  
        <div class="trader_card ">
          <div class="trader_card__side trader_card__side--front trader2">
          <h3>GREENGROCER</h3>
          </div>
          <div class="trader_card__side trader_card__side--back">
          <h3>OVERVIEW</h3>
            <p>
            A greengrocer is a retailer that specializes in selling fresh fruits and vegetables. They often source their produce locally and offer a wide variety of seasonal fruits and vegetables. Some greengrocers also sell herbs, spices, and other pantry staples.
            </p>
            <a id="btn__greengrocer" class="btn__card btn__card--animated" href="#">About the trader</a>
          </div>
        </div>  
        <div class="trader_card ">
          <div class="trader_card__side trader_card__side--front trader3">
          <h3>FISHMONGER</h3>
          </div>
          <div class="trader_card__side trader_card__side--back">
          <h3>OVERVIEW</h3>
            <p>
            A fishmonger is a person who sells fish and seafood products. They may sell a variety of fresh and frozen fish, as well as shellfish like shrimp, crab, and lobster. Some fishmongers may also offer prepared seafood products like smoked salmon or seafood salads.
            </p>
            <a id="btn__fishmonger" class="btn__card btn__card--animated" href="#">About the trader</a>
          </div>
        </div>  
        <div class="trader_card ">
          <div class="trader_card__side trader_card__side--front trader4">
          <h3>BAKERY</h3>
          </div>
          <div class="trader_card__side trader_card__side--back">
          <h3>OVERVIEW</h3>
            <p>
            A bakery is a place where bread, pastries, cakes, and other baked goods are made and sold. Bakeries often offer a variety of breads, including sourdough, whole wheat, and artisanal breads. They may also sell sweet treats like croissants, cookies, and cakes.
            </p>
            <a id="btn__bakery" class="btn__card btn__card--animated" href="#">About the trader</a>
          </div>
        </div>  
        <div class="trader_card ">
          <div class="trader_card__side trader_card__side--front trader5">
          <h3>DELICATESSEN</h3>
          </div>
          <div class="trader_card__side trader_card__side--back">
          <h3>OVERVIEW</h3>
            <p>
            A delicatessen, or deli for short, is a retailer that specializes in high-quality, often imported, foods such as cheeses, cured meats, olives, and pickles. Delis may also offer sandwiches and prepared foods like salads and soups.
            </p>
            <a id="btn__delicatessen" class="btn__card btn__card--animated" href="#">About the trader</a>
          </div>
        </div>  
      </div>
    </section>
    <section class="gallery">
  <figure class="gallery__item gallery__item--1">
    <img src="assets/img/loc1.jpg" alt="" class="gallery__img" />
  </figure>
  <figure class="gallery__item gallery__item--2">
    <img src="assets/img/loc2.jpg" alt="" class="gallery__img" />
  </figure>
  <figure class="gallery__item gallery__item--3">
    <img src="assets/img/loc3.jpg" alt="" class="gallery__img" />
  </figure>
  <figure class="gallery__item gallery__item--4">
    <img src="assets/img/loc4.jpeg" alt="" class="gallery__img" />
  </figure>
  <figure class="gallery__item gallery__item--5">
    <img src="assets/img/loc5.jpg" alt="" class="gallery__img" />
  </figure>
  <figure class="gallery__item gallery__item--6">
    <img src="assets/img/loc6.jpg" alt="" class="gallery__img" />
  </figure>
  <figure class="gallery__item gallery__item--7">
    <img src="assets/img/loc7.jpg" alt="" class="gallery__img" />
  </figure>
  <figure class="gallery__item gallery__item--8">
    <img src="assets/img/loc8.jpg" alt="" class="gallery__img" />
  </figure>
  <figure class="gallery__item gallery__item--9">
    <img src="assets/img/loc9.jpg" alt="" class="gallery__img" />
  </figure>
  <figure class="gallery__item gallery__item--10">
    <img src="assets/img/loc10.jpeg" alt="" class="gallery__img" />
  </figure>
  <figure class="gallery__item gallery__item--11">
    <img src="assets/img/loc11.jpg" alt="" class="gallery__img" />
  </figure>
  <figure class="gallery__item gallery__item--12">
    <img src="assets/img/loc12.jpg" alt="" class="gallery__img" />
  </figure>
  <figure class="gallery__item gallery__item--13">
    <img src="assets/img/loc13.jpg" alt="" class="gallery__img" />
  </figure>
  <figure class="gallery__item gallery__item--14">
    <img src="assets/img/loc14.jpeg" alt="" class="gallery__img" />
  </figure>
</section>
<?php
$sql = "SELECT p.PRODUCT_NAME, p.PRODUCT_IMG, r.RATING
        FROM (SELECT * 
              FROM PRODUCT 
              ORDER BY PRODUCT_ID) p
        JOIN REVIEW r ON p.PRODUCT_ID = r.PRODUCT_ID
        WHERE ROWNUM <= 5
        ORDER BY r.RATING DESC";

$statement = oci_parse($conn, $sql);
oci_execute($statement);

$popularProducts = [];
while ($row = oci_fetch_array($statement, OCI_ASSOC)) {
  $popularProducts[] = $row;
}
$count = 0;
$ratingsArr = [4.7, 4.5, 4.7, 4.6, 4.4];

?>

<section class="popular-products">
  <h2 class="popular-products__title">Popular Products</h2>
  <div class="popular-products__items">
    <?php
    $productNames = array(); // Array to keep track of product names
    foreach ($popularProducts as $product) {
      // Check if the current product name has already been displayed
      if (!in_array($product['PRODUCT_NAME'], $productNames)) {
        $productNames[] = $product['PRODUCT_NAME']; // Add the product name to the array
        ?>
        <div class="popular-product">
          <img src="<?php echo $product['PRODUCT_IMG']; ?>" alt="<?php echo $product['PRODUCT_NAME']; ?>" class="popular-product__img" />
          <div class="popular-product__desc">
            <h3 class="popular-product__name"><?php echo $product['PRODUCT_NAME']; ?></h3>
            <span><?php echo $ratingsArr[$count]; $count++; ?></span>
          </div>
        </div>
        <?php
      }
    }
    ?>
  </div>
</section>

<?php include 'includes/footer.php' ?>
<script src="app/js/script.js"></script>
<script>
    // Get the modal element
    const modal = document.querySelector(".modal");

    // Get the modal wrapper element
    const modalWrapper = document.querySelector(".modal_wrapper");

    // Get the button that opens the modal
    const button = document.querySelector(".btn__card");

    // Get the close button inside the modal
    const closeButton = document.querySelector(".modal_close--btn");

    // Get the main banner container
    const bannerContainer = document.querySelector(".main_banner__cnt");

    // Open the modal when the button is clicked
    button.addEventListener("click", (e) => {
      e.preventDefault();

      if (button.id === "btn__bakery") {
      }

      modalWrapper.style.display = "block";
      modal.classList.add("fade-in");
      modal.classList.remove("fade-out");
    });

    // Close the modal when the close button is clicked
    closeButton.addEventListener("click", () => {
      modal.classList.add("fade-out");
      modal.classList.remove("fade-in");
    });

    // Set the modal display to none after the fade out animation is completed
    modal.addEventListener("animationend", () => {
      if (modal.classList.contains("fade-out")) {
        modalWrapper.style.display = "none";
      }
    });

    // close modal if user clicks outside of it
    window.addEventListener("click", (event) => {
      console.log(event.target === modal);
      if (event.target.classList.contains("modal_wrapper")) {
        closeButton.click();
      }
    });

    const bannerPictures = [
      "../src/assets/img/banner1.webp",
      "../src/assets/img/banner2.webp",
      "../src/assets/img/banner3.webp",
    ];

    const mainBanner = document.querySelector(".main_banner");

    let i = 0;

    function bannerSlideShow() {
      console.log("HELLO");
      if (i > 2) i = 0;
      mainBanner.style.backgroundImage = `url(${bannerPictures[i]})`;
      // bannerImage.src = `${bannerPictures[i]}`;
      i++;
      setTimeout(() => {
        bannerSlideShow();
      }, 2000);
    }

    bannerSlideShow();
  </script>
</body>
</html>
