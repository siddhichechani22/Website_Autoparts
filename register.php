<?php
	// define variables to be used
	$firstName=$lastName=$emailAddress=$password="";
	// also only storing the hashed version of the password
	$hashed_password = "";
	
	// check if the request is POST
	if(isset($_POST['register_submit'])){
		$firstName = clean_input($_POST["firstName"]);
		$lastName = clean_input($_POST["lastName"]);
		$emailAddress = clean_input($_POST["email"]);
		$password = clean_input($_POST["password"]);
		
		if(validateUsername($firstName) || validatePassword($password)){
			// hash the password
			$hashed_password = password_hash($password, PASSWORD_BCRYPT);
			
			// connect to database
			include 'database-connect.php';
			
			// check if email already exists in the database
			$sql = "SELECT * FROM User WHERE email='$emailAddress' LIMIT 1";
			$result = $con->query($sql);
			
			if($result->num_rows > 0){
				echo 'Email already exists. Please enter another email.';
			}else{
				// insert new user into database if everything is fine
				$insertQuery = "INSERT INTO user (first_name, last_name, email, hashed_password, is_admin) VALUES ('$firstName','$lastName', '$emailAddress', '$hashed_password', 0)";
				if ($con->query($insertQuery) === TRUE) {
					// insert successful. don't echo anything
				} else {
					echo "Error: " . $sql . " " . $con->error;
				}
				
				// Start a session with the new user and store new session variables
				session_start();
				$sql = "SELECT * FROM User WHERE email='$emailAddress' AND hashed_password='$hashed_password' LIMIT 1";
				$result = $con->query($sql);
				
				if($result->num_rows > 0){
					//fetch user object from result
					$user_obj = $result->fetch_object();
					
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
					
					// store in session variables
					$_SESSION["username"] = $emailAddress;
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
					echo 'not ok';
				}
			}
			
			// Close Mysql connection
			$con->close();
		}else{
			echo 'Invalid email or password. Please try again.';
		}
	}

	// ***** HELPER FUNCTIONS BELOW *****
	
	function clean_input($data) {
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

