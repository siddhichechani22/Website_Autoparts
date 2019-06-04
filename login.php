<?php
	// define variables to be used. Email address is the username
	$username = $password = "";
	
	// check if the request is POST
	if(isset($_POST['login_submit'])){
		$username = cleanInput($_POST["login_username"]);
		$password = cleanInput($_POST["login_password"]);
		if(validateUsername($username) || validatePassword($password)){
			// Connect to database
			$con = mysqli_connect('localhost', 'root', '', 'onlineautopartsstore');
			if(!$con){
				die('Could not connect: '.mysqli_error($con));
			}
			
			// get the hashed password from the database and verify with inputted password
			$sql = "SELECT * FROM User WHERE email='$username' LIMIT 1";
			$result = $con->query($sql);
			if($result->num_rows > 0){
				// fetch user object from result
				$user_obj = $result->fetch_object();
				$db_password = $user_obj->hashed_password;
				
				// verify that passwords match
				if(password_verify($password, $db_password)){
					// Get user_ID, first_name, last_name, phone, address, and email to store in session
					$user_ID = $user_obj->user_ID;
					$first_name = $user_obj->first_name;
					$last_name = $user_obj->last_name;
					$phone = $user_obj->phone_number;
					$street_address = $user_obj->street_address;
					$city = $user_obj->city;
					$state = $user_obj->state;
					$zip = $user_obj->zip;
					$isAdmin = $user_obj->is_admin;
					
					// Start a session
					session_start();
					$_SESSION["username"] = $username;
					$_SESSION["user_ID"] = $user_ID;
					$_SESSION["first_name"] = $first_name;
					$_SESSION["last_name"] = $last_name;
					$_SESSION["phone"] = $phone;
					$_SESSION["street_address"] = $street_address;
					$_SESSION["city"] = $city;
					$_SESSION["state"] = $state;
					$_SESSION["zip"] = $zip;
					$_SESSION["isAdmin"] = $isAdmin;

					echo 'ok';
				}else{
					echo 'The username and password you entered did not match our records. Please try again.';
				}
			}else{
				echo 'The username and password you entered did not match our records. Please try again.';
			}
			
			// Close Mysql connection
			$con->close();
		}else{
			echo 'Invalid username or password. Please try again.';
		}
	}

	// ***** HELPER FUNCTIONS BELOW *****
	
	// cleans data by trimming, stripping slashes, and htmlspecialchars
	function cleanInput($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	function validateUsername($input){
		// check if input matches with regex
		$regex = '/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i';
		if(preg_match($regex, $input)){
			return true;
		}else{
			return false;
		}
	}
	
	function validatePassword($input){
		// check if length of password is at least 8
		if(strlen($input) >= 8){
			return true;
		}else{
			return false;
		}
	}
?>