// const prodcutInfoContainer = document.querySelector(".product-info");

// if(window.location.href === 'http://localhost/shopthehudd/product-detail.php') {
//   prodcutInfoContainer.insertAdjacentHTML(
//     "beforeend",
//     `
//   <div class="product-quantity">
//     <span>Quantity:</span>
//     <div class="increment-decrement">
//       <span>-</span><hr/>
//       <span>1</span><hr/>
//       <span>+</span>
//       <p>3 in stock</p>
//     </div>
//   </div>
//   <button class="add-to-cart">ADD TO CART</button>
//   <button class="buy-now">BUY NOW</button>`
//   );
// } else if ()

const hamburgerMenu = document.querySelector(".mobile_nav_button");
const mainNav = document.querySelector(".mainnav");
const btns = document.querySelectorAll(".mobile_nav_button span");
const btn1 = document.getElementById("1");
const btn2 = document.getElementById("2");
const btn3 = document.getElementById("3");

function transformMenuIcon(value1, value2, value3) {
  btn1.style.transform = `${value1}`;
  btn2.style.opacity = `${value2}`;
  btn3.style.transform = `${value3}`;
}

function changeColor(color) {
  btns.forEach((btn) => {
    btn.style.backgroundColor = `${color}`;
  });
}

changeColor("#231f20");

hamburgerMenu.addEventListener("click", (e) => {
  mainNav.classList.toggle("mobnav");
  if (mainNav.classList.contains("mobnav")) {
    transformMenuIcon(
      "translateY(6px) rotate(45deg)",
      "0",
      "translateY(-6px) rotate(-45deg)"
    );
    changeColor("#fff");
  } else {
    transformMenuIcon(
      "translateY(0px) rotate(0deg)",
      "1",
      "translateY(0px) rotate(0deg)"
    );
    changeColor("#231f20");
  }
});

const login = document.querySelector(".login");

// Get the cart icon element and cart count element
const cartIcon = document.querySelector(".cart_icon");
const cartCountElement = document.querySelector(".cart_count");

// Add event listener to the "Add to Cart" button

const addToCartButton = document.querySelector('.add-to-cart');
addToCartButton.addEventListener("click", function () {
  // Still need to write the logic to return from this function if the quantity is 0 or stock staus is out of stock.
  console.log("HERE");
  // Update the cart count element
  cartCountElement.textContent = cartCountElement.textContent + 1;

  // Add visual effect to indicate cart count change (optional)
  cartCountElement.classList.add("cart_count--highlight");

  // Remove the visual effect after a certain time (optional)
  setTimeout(function () {
    cartCountElement.classList.remove("cart_count--highlight");
  }, 1000); // Adjust the duration as desired
});

cartIcon.addEventListener("click", function () {
  window.location.href = "http://localhost/shopthehudd/src/cart.php";
});
