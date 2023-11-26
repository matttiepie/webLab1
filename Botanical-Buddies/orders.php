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
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    //$pdo = new PDO("mysql:host=$server;port=$port;dbname=$db", $user);

    $subtotal = 0.00;
    $totalitems = 0;
    session_start();
    

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = 'SELECT order_id, order_date, order_price, num_items FROM orderhistory WHERE 
    order_username = "' . $user_id . '"';
    
    $statement = $pdo->query($sql);
    $orders = $statement->fetchAll(PDO::FETCH_ASSOC);

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

    echo'
    <h2>Order History For User: ' . $user_id . '</h2>
<div class="table-wrapper">
    <table class="fl-table" id="table1">
        <thead>
        <tr>
            <th onClick="sortTable(0)">Order ID</th>
            <th onClick="sortTable(1)">Order Date</th>
            <th onClick="sortTable(2)">Number of Items</th>
            <th onClick="sortTable(3)">Subtotal</th>
        </tr>
        </thead>
        <tbody>
       ';
    
    foreach ($orders as $order) {
        echo' <tr>
                <td>' . $order["order_id"] . '</td>
                <td>' . $order["order_date"] . '</td>
                <td>' . $order["num_items"] . '</td>
                <td>' . $order["order_price"] . '</td>

            </tr>';
    }
            
        echo'<tbody>
        </table>
        </div>
        </body>';

} else {
    // Handle the case when the user is not logged in
    echo 'User is not logged in.';
    header('refresh: 5; url=login.html');

}
    
    
            

?>
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("table1");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (n == 3){
        if (dir == "asc") {
            if (Number(x.innerHTML) > Number(y.innerHTML)) {
                shouldSwitch = true;
                break;
            }
      } else if (dir == "desc") {
        if (Number(x.innerHTML) < Number(y.innerHTML)) {
                shouldSwitch = true;
                break;
            }
      }
      }
      else{
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
}
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
<style>
    * {
    font-family: 'Gabarito', 'sans-serif';
    font-weight: 400;
    margin: 0;
    padding: 0;
    scroll-behavior: smooth !important;
    scroll-padding-top: 120px;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
}

header {
    display: flex;
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

body{
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

h2{
    text-align: center;
    font-size: 24px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: green;
    padding: 30px 0;
}

center {
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


/* Table Styles */

.table-wrapper{
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
}

.fl-table {
    border-radius: 5px;
    font-size: 18px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td, .fl-table th {
    text-align: center;
    padding: 8px;
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 18px;
}

.fl-table thead th {
    color: #ffffff;
    background: #4FC3A1;
}


.fl-table thead th:nth-child(odd) {
    color: #ffffff;
    background: #324960;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}

/* Responsive */

@media (max-width: 767px) {
    .fl-table {
        display: block;
        width: 100%;
    }
    .table-wrapper:before{
        content: "Scroll horizontally >";
        display: block;
        text-align: right;
        font-size: 17px;
        color: white;
        padding: 0 0 10px;
    }
    .fl-table thead, .fl-table tbody, .fl-table thead th {
        display: block;
    }
    .fl-table thead th:last-child{
        border-bottom: none;
    }
    .fl-table thead {
        float: left;
    }
    .fl-table tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
    }
    .fl-table td, .fl-table th {
        padding: 20px .625em .625em .625em;
        height: 60px;
        vertical-align: middle;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        width: 120px;
        font-size: 13px;
        text-overflow: ellipsis;
    }
    .fl-table thead th {
        text-align: left;
        border-bottom: 1px solid #f7f7f9;
    }
    .fl-table tbody tr {
        display: table-cell;
    }
    .fl-table tbody tr:nth-child(odd) {
        background: none;
    }
    .fl-table tr:nth-child(even) {
        background: transparent;
    }
    .fl-table tr td:nth-child(odd) {
        background: #F8F8F8;
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tr td:nth-child(even) {
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tbody td {
        display: block;
        text-align: center;
    }
}
</style>




