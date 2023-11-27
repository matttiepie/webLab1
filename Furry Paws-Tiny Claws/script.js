// Your existing code ...

// Initialize cart and total
const cart = [];
let total = 0;

// Function to update the cart and total display
function updateCart() {
  const cartItemsElement = document.getElementById('cart-items');
  const totalElement = document.getElementById('total');

  // Clear the cart display
  cartItemsElement.innerHTML = '';

  // Update the cart display
  cart.forEach(item => {
    const li = document.createElement('li');
    li.textContent = `${item.name} - $${item.price.toFixed(2)}`;
    cartItemsElement.appendChild(li);
  });

  // Update the total display
  totalElement.textContent = total.toFixed(2);
}

// Function to add an item to the cart
function addToCart(product) {
  cart.push({ name: product.name, price: product.price });
  total += product.price;
  updateCart();
}

// Your existing code ...

// Modify your existing 'Add to Cart' button click event listeners to call the 'addToCart' function
document.querySelectorAll('.card button').forEach((button, index) => {
  button.addEventListener('click', () => addToCart(products[index]));
});

// Your existing code ...
