<?php
	// connect to database
	include 'database-connect.php';

	// Get item id to remove from cart
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$item_ID = clean_input($_POST["cart_item_id"]);
		$user_ID = clean_input($_POST["user_ID"]);
		
		// sql to delete the item
		$sql = "DELETE FROM `cart` WHERE `item_ID`='$item_ID' AND `user_ID`='$user_ID'";
		if($con->query($sql)){
			header("Location: cart.html");
		}
	}
	
	function clean_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>