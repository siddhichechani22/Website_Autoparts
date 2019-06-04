<?php
	// check if the user is logged in. Else redirect to login page
	session_start();

	if(isset($_SESSION['user_ID']) && isset($_SESSION['username'])){
		$username = $_SESSION['username'];
		$user_ID = $_SESSION['user_ID'];
		$first_name = $_SESSION['first_name'];
		$last_name = $_SESSION['last_name'];
		$phone = $_SESSION['phone'];
		$street_address = $_SESSION['street_address'];
		$city = $_SESSION['city'];
		$state = $_SESSION['state'];
		$zip = $_SESSION['zip'];
		$isAdmin = $_SESSION['isAdmin'];
	}else{
		// Redirect to login.html
		header('Location: login.html');
	}
?>