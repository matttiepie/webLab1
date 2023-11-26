<?php
$db_host = "partygoer.mysql.database.azure.com"; // Change this
$db_user = "matthewmartinez"; // Change this
$db_pass = "1qaz2wsx!QAZ@WSX"; // Change this
$db_name = "herewego"; // Do not change */

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$con) {
    die("Connection failed!" . mysqli_connect_error());
}

if (isset($_POST['addToCart'])) {
    $plantName = $_POST['addToCart'];
    $sql = "UPDATE `plant_data` SET `plant_quantity` = `plant_quantity` + 1 WHERE `plant_name` = '$plantName'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo "error handling addtocart";
    }
    echo "Successfully added to cart!";
} 

if (isset($_POST['Search'])) {
    $searchQuery = $_POST['Search'];
    $sql = "SELECT * FROM `plant_data` WHERE `plant_quantity_available` > 1 AND `plant_name` LIKE '%$searchQuery%'";
    $result = mysqli_query($con, $sql);
    sendPlantData($result);
}

if (isset($_POST['sortBy']) && isset($_POST['currentPage'])) {
    $order = $_POST['sortBy'];
    $currentPage = $_POST['currentPage'];
    $andCase;

    if ($currentPage == 'All') {
        $andCase = 1;  //where 1 = true so I don't have to make a separate switch statement for 'All'
    } else {
        $andCase = "`plant_type` = '$currentPage'"; 
    }

    switch($order) {
        case 'ASCPrice':
            $sql = "SELECT * FROM `plant_data` WHERE `plant_quantity_available` > 1 AND $andCase ORDER BY `plant_price` ASC";
            break;
        case 'DESCPrice':
            $sql = "SELECT * FROM `plant_data` WHERE `plant_quantity_available` > 1 AND $andCase ORDER BY `plant_price` DESC";
            break;
        case 'ASCLetters':
            $sql = "SELECT * FROM `plant_data` WHERE `plant_quantity_available` > 1 AND $andCase ORDER BY `plant_name` ASC";
            break;
        case 'DESCLetters':
            $sql = "SELECT * FROM `plant_data` WHERE `plant_quantity_available` > 1 AND $andCase ORDER BY `plant_name` DESC";
            break;
        case 'ASCQuantAvail':
            $sql = "SELECT * FROM `plant_data` WHERE `plant_quantity_available` > 1 AND $andCase ORDER BY `plant_quantity_available` ASC";
            break;
        case 'DESCQuantAvail':
            $sql = "SELECT * FROM `plant_data` WHERE `plant_quantity_available` > 1 AND $andCase ORDER BY `plant_quantity_available` DESC";
            break;

    }
    $result = mysqli_query($con, $sql);
    sendPlantData($result);
}

//current Page
if (isset($_POST['itemName'])) {
    $itemName = $_POST['itemName'];
    $result = '';
    switch($itemName) {
        case 'Home':
            $sql = "SELECT * FROM `plant_data` WHERE `plant_quantity_available` < 50 AND `plant_quantity_available` > 0 ORDER BY `plant_quantity_available` ASC"; //for best sellers
            break;
        case 'All':
            $sql = "SELECT * FROM `plant_data` WHERE `plant_quantity_available` > 0 ORDER BY `plant_name`";
            break;
        default:
            $sql = "SELECT * FROM `plant_data` WHERE `plant_quantity_available` > 0 AND `plant_type` = '$itemName'";
    }
    $result = mysqli_query($con, $sql);
    sendPlantData($result);
}

function sendPlantData($res) {
    if (mysqli_num_rows($res) > 0) {
        $data = array();
    
        while ($row = mysqli_fetch_assoc($res)) {
            $img_url = $row["plant_image_url"];
            $data[] = array(
                'name' => $row['plant_name'],
                'type' => $row['plant_type'],
                'desc' => $row['plant_description'],
                'imgURL' => $img_url,
                'price' => $row['plant_price'],
                'quantity' => $row['plant_quantity'],
                'quantityAvailable' => $row['plant_quantity_available'],
            );
        }
    
        $json = json_encode($data);
        header('Content-Type: application/json');
        echo $json;
    
    } else {
        echo json_encode(["error" => "No results"]);
    }
}

?>
