<?php
	session_start();
	// Get address attributes to be updated
	$street_address = "";
	$city = "";
	$state = "";
	$zip_code = "";
	$user_ID = "";
	
	// check if the request is POST
	if (isset($_POST['update_address_submit'])){
		// get attributes being updated. user_ID only used to get the row to update
		$user_ID = intval($_SESSION['user_ID']);
		$street_address = cleanInput($_POST["street_address"]);
		$city = cleanInput($_POST["city"]);
		$zip_code = intval(cleanInput($_POST["zip_code"]));
		$state = cleanInput($_POST["state"]);
		
		// Connect to database
		$con = mysqli_connect('localhost', 'root', '', 'onlineautopartsstore');
		if(!$con){
			die('Could not connect: '.mysqli_error($con));
		}
		
		// SQL statement to update row in DB
		$sql = "UPDATE User
				SET `street_address`='$street_address',`city`='$city',`state`='$state',`zip`=$zip_code
				WHERE `user_ID`=$user_ID";
		$result = $con->query($sql);
		
		if ($result == true) {
			// update session variables
			$_SESSION["street_address"] = $street_address;
			$_SESSION["user_ID"] = $user_ID;
			$_SESSION["city"] = $city;
			$_SESSION["state"] = $state;
			$_SESSION["zip"] = $zip_code;
			echo "Address updated successfully";
		} else {
			echo "Error updating address: " . $con->error;
		}

		// Close Mysql connection
		$con->close();
	}
	
	// cleans data by trimming, stripping slashes, and htmlspecialchars
	function cleanInput($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>