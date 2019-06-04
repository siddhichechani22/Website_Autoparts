<?php
$link = mysqli_connect('localhost', 'root', '', 'onlineautopartsstore');

include 'check-logged-in.php';

if (!$link)
{
    die("Not Connecting to Database");
    exit();
}
$userID=$item_ID=$quantity="value";

if(!empty($_POST['item_id'])){
    $item_ID = $_POST['item_id'];
}else{
    echo "Failed to Add to Cart";
}



if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $quantity = clean_input($_POST["quantity"]);
    if ($quantity == null || $quantity =="")
    {
        echo "Invalid Input Please Try Again";
        exit();
    }

    $userID = clean_input($_POST['user_id_number']);



}



$checkQuantity = "SELECT num_available FROM item where item_ID  = $item_ID";

$someItem = $link->query($checkQuantity);

$quantityItem = $someItem->fetch_object();

$thisIsItemQuantity = $quantityItem->num_available;


if($thisIsItemQuantity < $quantity)
{
    echo "Quantity Not Available";
    exit();
}






$insertItemQuery = "INSERT INTO cart VALUES ($userID, $item_ID, $quantity)";






if ($stmt = mysqli_query($link, $insertItemQuery))
{
    echo "Successfully Added";
    $link->close();

}

else
{
    if(isset($_SESSION['user_ID'])) {
        echo "You already have this item in your cart";
    }

    else{
        echo "You must be logged in to add to cart";
    }
}





function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}