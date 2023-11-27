<?php
// Start the session
  session_start();
if (isset($_SESSION['user_id'])) 
    $user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Records</title>
    <script type="text/javascript">
        function jsFunction(name, y){
          setCookie(name, y , 10); 
        }
        function setCookie(cName, cValue, expDays) {
    let date = new Date();
    date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
}

</script>
    
<body>
      
<?php

echo '<script type="text/javascript" src="cartScript.js"></script>';


    //storing database details in variables.
    
    $db_host="partygoer.mysql.database.azure.com";        
    $db_user="matthewmartinez";        
    $db_pass="1qaz2wsx!QAZ@WSX";        
    $db_name="herewego";  
    $server = "localhost";
    $user = "root";
    $port = 3307;
    $password = "";
    $db = "plants";
    //$pdo = new PDO("mysql:host=$server;port=$port;dbname=$db", $user);
    //uncomment to switch host
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $subtotal = 0.00;
    $totalitems = 0;
    
    //$sql = 'SELECT plant_name, plant_image_url, plant_quantity, plant_price, plant_type, plant_description FROM plant WHERE plant_quantity >= 1';
    $sql = 'SELECT plant_name, plant_image_url, plant_quantity, plant_price, plant_type, plant_description FROM plant_data WHERE plant_quantity >= 1';
    $statement = $pdo->query($sql);
    $plants = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo'
    <body>
    <header>
    <nav>
        <ul>
            <li class="title"><a href="index.html"><img class="logo" src="images/plant-icon.svg" alt="logo" height="50px" width="50px">Botanical Buddies</a></li>
            <li> <!-- temp -->
                <a href="cart.php"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg>
                </a>
            </li>
            <li> <!-- temp -->
                <a href="session.php"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z"/></svg>
                </a>
            </li>
        </ul>
      
    </nav>
</header>
<div>
<marquee class="announcement" behavior="scroll" direction="right" scrollamount="4">🌿coupon codes🌿</marquee>
</div>';
    echo'<main>
    <div class="basket">

                <div class="basket-labels">
                    <ul>
                    <li class="item item-heading">Item</li>
                    <li class="price">Price</li>
                    <li class="quantity">Quantity</li>
                    <li class="subtotal">Subtotal</li>
                    </ul>
                </div>
            ';
    
    foreach ($plants as $plant) {
        $totalprice = $plant['plant_price'] * $plant['plant_quantity'] ;
        $subtotal += (float) $totalprice;
        $totalitems += $plant['plant_quantity'];
        echo ' <div class="basket-product" id="demo">
        <div class="item">
          <div class="product-image">
            <img src=' . $plant["plant_image_url"] .' alt="Placholder Image 2" class="product-frame">
          </div>
          <div class="product-details">
            <h1><strong><span class="item-quantity">'. $plant["plant_quantity"] .'</span> ' . $plant["plant_name"] . '</strong></h1>
            <p><strong>' . $plant["plant_description"] . '</strong></p>
          </div>
        </div>
        <div class="price">' . $plant["plant_price"] . '</div>
        <div class="quantity">
          <input type="number" value=' . $plant["plant_quantity"] . ' min="1" class="quantity-field">
        </div>
        <div class="subtotal">' . $totalprice . '</div>
        
      </div>';
            
    }
    $taxPercent = 8.25 / 100;
    $salesTax = number_format((float)$subtotal * $taxPercent, 1, '.', '');
    $cartTotal = number_format((float)$subtotal + $salesTax, 2, '.', '');
    echo ' <div class="basket-module">
                <label for="promo-code">Enter a promotional code</label>
                <input id="promo-code" type="text" name="promo-code" maxlength="5" class="promo-code-field">
                <button onClick="discount()" class="promo-code-cta">Apply</button>
            </div>
            </div>';
$checkout = "'checkout.php'";
    echo '<aside>
    <div class="summary">
      <div class="summary-total-items"><span class="total-items"></span> '. $totalitems .' Items in your Cart</div>
      <div class="summary-subtotal">
        <div class="subtotal-title">Subtotal</div>
        <div class="subtotal-value final-value" id="basket-subtotal">' . $subtotal . '</div>
        <div class="summary-promo">
          <div class="promo-title">Promotion</div>
          <div class="promo-value final-value" id="basket-promo">0</div>
        </div>
        <div class="summary-promo">
          <div class="promo-title">Taxes</div>
          <div class="promo-value final-value" id="taxes">' . $salesTax . '</div>
        </div>
      </div>
      <div class="summary-total">
        <div class="total-title">Total</div>
        <div class="total-value final-value" id="basket-total">' . $cartTotal .'</div>
      </div>
      <div class="summary-checkout">
        <button  onclick="window.location.href='.$checkout.';" class="checkout-cta">Go to Secure Checkout</button>
      </div>
    </div>
  </aside>';
    echo '
    </div>
        </body>
    </main>';
    echo '<script type="text/javascript">jsFunction("price", '. $cartTotal .');</script>';
    echo '<script type="text/javascript">jsFunction("items", '. $totalitems .');</script>';


?>


<style>
* {
    font-family: 'Gabarito', 'sans-serif';
    font-weight: 400;
    margin: 0;
    padding: 0;
    scroll-behavior: smooth !important;
    scroll-padding-top: 120px;
}

header {
    display: flex;
}

body {
    color: black;
    background-color: white;
    background-image: url("../../images/white_flowers.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-image: url("../../images/white_flowers.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    min-height: 100vh;
}

.center {
    margin: auto;
    width: 25%;
    height: 60%;
    background-color: white;
    border: 3px solid rgb(212, 219, 144);
    padding: 10px;
    height: 300px;
  }

  table{
    margin: auto;
    height: 300px;
  }

  td {
    width: 50px;
    margin: auto;
  }

  .info {
    height: 400px;
    width: 300px;
  }
    
  .accountinfo {
    margin-left: 40% ;
    background-color: white;
    display: inline-block;
    border: 3px solid rgb(212, 219, 144);
    text-align: center;text-align: center;
    padding-bottom: 3%;
}

    .userinput{
        margin-top: 2%;
    }

  .accountinfo::after{
    content: "";
    clear: both;
    display: table;
}

  input[type=submit] {
    background-color: rgb(212, 219, 144);
    width: 80px;
    height: 40px;
  }

  input[name=create] {
    width: 250px;
    height: 40px;
  }

.card {
    box-shadow: 0px 2px 20px rgba(0,0,0,0.1);
    cursor: pointer;
    display: flex;
    font-size: 0.8rem;
    flex-direction: column;
    justify-content: space-between;
    margin: 0.625rem;
    max-width: 12rem;
    position: relative;
    overflow: hidden;
    transition: transfom 200ms ease-in;
}

.cardimage {
    height: 8rem;
    object-fit: cover;
    width: 100%;
    image-resolution: 300dpi;
}

.cardtitle {
    margin: 0.1rem;
    padding: 0 1rem;
    font-family: 'Noto Serif Old Uyghur', 'serif';
}

.carddescription {
    margin: 0.1rem;
    font-weight: 100;
    padding: 0 1rem;
    font-family: 'Kay Pho Du', serif;
    font-style: italic;
}

.cardbody {
    flex-grow: 1;
}

.cardbutton {
    background: transparent;
    border: 0.125rem solid;
    font-family: inherit;
    font-weight: bold;
    font-size: 1rem;
    margin: 1rem;
    padding: 1rem;
    transition:
        background 200ms ease-in,
        color 200ms ease-in;
    width: 80%;
    font-family: 'Kay Pho Du', serif;
}

.cardprice {
    padding: 0 1rem;
    font-size: 2rem;
    font-family: 'Noto Serif Old Uyghur', serif;
}

.cardquantityAvail {
    padding: 0 1rem;
    font-size: 0.7rem;
    font-family: 'Noto Serif Old Uyghur', serif;
}

.card:hover {
    transform:scale(1.02);
}

.cardbutton:hover {
    background: green;
    color: white;
}

.container {
    display:flex;
}

.carousel {
    /* temp grid*/
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(12rem,14rem));
    grid-gap: 0.2rem;
    justify-content: center;
}

.category {
    background-color: rgba(133, 133, 133, 0.213);
    display: flex;
    font-family: 'Noto Serif Old Uyghur', serif;
    justify-content: center;
    margin: 1rem;
    width: calc(100vw - 1.5rem);
}

nav {
    background-color: white;
    border-top: 5px;
    border-color:rgba(0, 0, 0, 0.202);
    border-style: solid;
    box-shadow: 5px 5px 5px rgba(0,0,0,0.1);
    width: 100%;
    font-size: 20px;
}

nav ul {
    align-items: center;
    display: flex;
    justify-content:center;
    list-style: none;
    margin: 0.5rem;
    width: 100%;
}

nav li {
    align-items: center;
    cursor: pointer;
    display: flex;
    height: 100%;
    justify-content: center;
    width: 100%;
}

nav li:hover {
    color: green;
}

nav a {
    height: 100%;
    padding: 0 1.25rem;
    display: flex;
    align-items: center;
    text-decoration: none;
    color: black;
}

.title {
    font-size: 18px;
    margin-left: auto;
    justify-content: flex-start;

}

.searchBar {
    height:100%;
    width:100%;
    background-image: url(/images/search-icon.svg);
    background-repeat: no-repeat;
}

.sortSelect {
    margin: 1rem;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    width:50%;
}

.menuButton {
    display: none;
}

.announcement {
    width: 100%;
    border: 0.125rem;
    border-style: double;
    background-color: rgb(212, 219, 144);
    text-align: center;
}

.parent {
    display: grid;
    grid-template: auto 1fr auto / auto 1fr auto;
}

@media(max-width: 600px)
{
    .hideOnMobile {
        display: none;
    }

    .menuButton {
        display: block;
    }
}

@media(max-width: 400px)
{
    .sidebar {
        width:100%;
    }
}

button {
    padding: 9px 25px;
    background-color:rgb(171, 224, 184);
    border:none;
    border-radius:50px;
    transition: all 0.3s ease 0s;
    cursor: pointer;
    }
    img,
    .basket-module,
    .basket-labels,
    .basket-product {
    width: 100%;
    }

    input,
    button,
    .basket,
    .basket-module,
    .basket-labels,
    .item,
    .price,
    .quantity,
    .subtotal,
    .basket-product,
    .product-image,
    .product-details {
    float: left;
    }
    .basket {
    width: 70%;
    }
    .basket-labels {
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    margin-top: 1.625rem;
    }
    .basket-product {
  border-bottom: 1px solid #ccc;
  padding: 1rem 0;
  position: relative;
}

.product-image {
  width: 35%;
}

.product-details {
  width: 65%;
}

.product-frame {
  border: 1px solid #aaa;
}

.product-details {
  padding: 0 1.5rem;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.quantity-field {
  background-color: #ccc;
  border: 1px solid #aaa;
  border-radius: 4px;
  font-size: 0.625rem;
  padding: 2px;
  width: 3.75rem;
}

aside {
  float: right;
  position: relative;
  width: 30%;
}

.summary {
  background-color: #eee;
  border: 1px solid #aaa;
  padding: 1rem;
  position: fixed;
  width: 250px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

/*test*/


html,
html a {
  -webkit-font-smoothing: antialiased;
  text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.004);
}




strong {
  font-weight: bold;
}

p {
  margin: 0.75rem 0 0;
}

h1 {
  font-size: 0.75rem;
  font-weight: normal;
  margin: 0;
  padding: 0;
}

input,
button {
  border: 0 none;
  outline: 0 none;
}


button:hover,
button:focus {
  background-color: #555;
}

img,
.basket-module,
.basket-labels,
.basket-product {
  width: 100%;
}

input,
button,
.basket,
.basket-module,
.basket-labels,
.item,
.price,
.quantity,
.subtotal,
.basket-product,
.product-image,
.product-details {
  float: left;
}

.price:before,
.subtotal:before,
.subtotal-value:before,
.total-value:before,
.promo-value:before {
  content: '$';
}

.hide {
  display: none;
}

main {
  clear: both;
  font-size: 0.75rem;
  margin: 0 auto;
  overflow: hidden;
  padding: 1rem 0;
  width: 960px;
}

.basket,
aside {
  padding: 0 1rem;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.basket {
  width: 70%;
}

.basket-module {
  color: #111;
  margin-top: 1.625rem;
}

label {
  display: block;
  margin-bottom: 0.3125rem;
}

.promo-code-field {
  border: 1px solid #ccc;
  padding: 0.5rem;
  text-transform: uppercase;
  transition: all 0.2s linear;
  width: 48%;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  -o-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
}

.promo-code-field:hover,
.promo-code-field:focus {
  border: 1px solid #999;
}

.promo-code-cta {
  border-radius: 4px;
  font-size: 0.625rem;
  margin-left: 0.625rem;
  padding: 0.6875rem 1.25rem 0.625rem;
}

.basket-labels {
  border-top: 1px solid #ccc;
  border-bottom: 1px solid #ccc;
  margin-top: 1.625rem;
}

ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

li {
  color: #111;
  display: inline-block;
  padding: 0.625rem 0;
}

li.price:before,
li.subtotal:before {
  content: '';
}

.item {
  width: 55%;
}

.price,
.quantity,
.subtotal {
  width: 15%;
}

.subtotal {
  text-align: right;
}

.remove {
  bottom: 1.125rem;
  float: right;
  position: absolute;
  right: 0;
  text-align: right;
  width: 45%;
}

.remove button {
  background-color: transparent;
  color: #777;
  float: none;
  text-decoration: underline;
  text-transform: uppercase;
}

.item-heading {
  padding-left: 4.375rem;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.basket-product {
  border-bottom: 1px solid #ccc;
  padding: 1rem 0;
  position: relative;
}

.product-image {
  width: 35%;
}

.product-details {
  width: 65%;
}

.product-frame {
  border: 1px solid #aaa;
}

.product-details {
  padding: 0 1.5rem;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.quantity-field {
  background-color: #ccc;
  border: 1px solid #aaa;
  border-radius: 4px;
  font-size: 0.625rem;
  padding: 2px;
  width: 3.75rem;
}

aside {
  float: right;
  position: relative;
  width: 30%;
}

.summary {
  background-color: #eee;
  border: 1px solid #aaa;
  padding: 1rem;
  position: fixed;
  width: 250px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.summary-total-items {
  color: #666;
  font-size: 0.875rem;
  text-align: center;
}

.summary-subtotal,
.summary-total {
  border-top: 1px solid #ccc;
  border-bottom: 1px solid #ccc;
  clear: both;
  margin: 1rem 0;
  overflow: hidden;
  padding: 0.5rem 0;
}

.subtotal-title,
.subtotal-value,
.total-title,
.total-value,
.promo-title,
.promo-value {
  color: #111;
  float: left;
  width: 50%;
}

.summary-promo {
  -webkit-transition: all .3s ease;
  -moz-transition: all .3s ease;
  -o-transition: all .3s ease;
  transition: all .3s ease;
}

.promo-title {
  float: left;
  width: 70%;
}

.promo-value {
  color: #8B0000;
  float: left;
  text-align: right;
  width: 30%;
}

.summary-delivery {
  padding-bottom: 3rem;
}

.subtotal-value,
.total-value {
  text-align: right;
}

.total-title {
  font-weight: bold;
  text-transform: uppercase;
}

.summary-checkout {
  display: block;
}

.checkout-cta {
  display: block;
  float: none;
  font-size: 0.75rem;
  text-align: center;
  text-transform: uppercase;
  padding: 0.625rem 0;
  width: 100%;
}

.summary-delivery-selection {
  background-color: #ccc;
  border: 1px solid #aaa;
  border-radius: 4px;
  display: block;
  font-size: 0.625rem;
  height: 34px;
  width: 100%;
}

@media screen and (max-width: 640px) {
  aside,
  .basket,
  .summary,
  .item,
  .remove {
    width: 100%;
  }
  .basket-labels {
    display: none;
  }
  .basket-module {
    margin-bottom: 1rem;
  }
  .item {
    margin-bottom: 1rem;
  }
  .product-image {
    width: 40%;
  }
  .product-details {
    width: 60%;
  }
  .price,
  .subtotal {
    width: 33%;
  }
  .quantity {
    text-align: center;
    width: 34%;
  }
  .quantity-field {
    float: none;
  }
  .remove {
    bottom: 0;
    text-align: left;
    margin-top: 0.75rem;
    position: relative;
  }
  .remove button {
    padding: 0;
  }
  .summary {
    margin-top: 1.25rem;
    position: relative;
  }
}

@media screen and (min-width: 641px) and (max-width: 960px) {
  aside {
    padding: 0 1rem 0 0;
  }
  .summary {
    width: 28%;
  }
}

@media screen and (max-width: 960px) {
  main {
    width: 100%;
  }
  .product-details {
    padding: 0 1rem;
  }
}


    </style>
</body>
</html>
