<?php
	// checked if logged in, which user should be to access this page
	include 'check-logged-in.php';

	// connect to DB
	$link = new mysqli('localhost', 'root', '', 'onlineautopartsstore');
	if ($link->connect_errno)
	{
		die("Not Connecting to Database");
		exit();
	}

	$ID = $_SESSION['user_ID'];
	$price=$address=$city=$state=$fname=$lname=$date="";

	// Get inputs for shipping info
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$fname = clean_input($_POST["fname"]);
		if ($fname == null || $fname =="")
		{
			echo "Please enter a first name.";
			exit();
		}
		$lname = clean_input($_POST["lname"]);
		if ($lname == null || $lname =="")
		{
			echo "Please enter a last name.";
			exit();
		}
		$address = clean_input($_POST["address"]);
		if ($address == null || $address =="")
		{
			echo "Please enter a street address.";
			exit();
		}
		$city = clean_input($_POST["city"]);
		if ($city == null || $city =="")
		{
			echo "Please enter a city.";
			exit();
		}
		$state = clean_input($_POST["state"]);
		if ($state == null || $state =="")
		{
			echo "Please enter a state.";
			exit();
		}

		$price = clean_input($_POST["total"]);
	}

	$today = date('l jS \of F Y h:i:s A');

	// SQL to insert new transaction
	$sql= "INSERT INTO `onlineautopartsstore`.`transaction` (`date`, 
						`total_price`, `address`, `city`, `state`) VALUES ('$today', '$price', '$address', '$city', '$state');";

	

	
	// if insert into transaction table successful...
	if ($stmt = $link->query($sql)){
		//Get the transaction_id generated for this transaction
		$transactionID = $link->insert_id;

		// SQL to update transaction_items table
		$updateTransactionItems = "SELECT * FROM `cart` WHERE user_ID = '$user_ID'";

		//Object containing all the items that this user currently had in their cart
		//We will put these items in the transations_items table for storage and then remove them from the cart.
		$items = $link->query($updateTransactionItems);

		while ($allItems = $items->fetch_object()){
			$itemToInsert = $allItems->item_ID;
			$itemToInsertQuantity = $allItems->quantity;

			// store in transaction_items table
			$transaction_items_SQL = "INSERT INTO transaction_items VALUES ($transactionID, $itemToInsert, $itemToInsertQuantity)";
			$link->query($transaction_items_SQL);
			
			// update num_available of item in item table
			$inv_sql = "UPDATE `item` SET `num_available`= (`num_available` - $itemToInsertQuantity) WHERE `item_ID` = '$itemToInsert'";
			$link->query($inv_sql);
		}

		// update user_transactions table
		$user_transactions_sql = "INSERT INTO user_transactions VALUES ($user_ID, $transactionID)";
		$link->query($user_transactions_sql);

		$deleteFromCartSQL = "DELETE FROM cart WHERE user_ID = '$user_ID'";
		$link->query($deleteFromCartSQL);
		$link->close();

		$_SESSION['user_ID']=$user_ID;
		$_SESSION['txn']=$transactionID;
		header('Location: order-summary.php');




	}else
	{
		echo "Checkout Failed";
	}







	function clean_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}


?>
<html>
<head></head>
<body></body>
</html>