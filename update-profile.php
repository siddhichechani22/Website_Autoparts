<?php
	// define variables to be updated. Email address is username
	$username = "";
	$first_name = "";
	$last_name = "";
	$password = "";
	$confirmed_password = "";
	$phone = "";
	$user_ID = "";
	
	// check if the request is POST
	if (isset($_POST['update_profile_submit'])){
		// get attributes being updated. user_ID only used to get the row to update
		$user_ID = intval(cleanInput($_POST["user_ID"]));
		$username = cleanInput($_POST["email"]);
		$password = cleanInput($_POST["password"]);
		$confirmed_password = cleanInput($_POST["confirm_password"]);
		$first_name = cleanInput($_POST["first_name"]);
		$last_name = cleanInput($_POST["last_name"]);
		$phone = cleanInput($_POST["phone"]);
		
		// check if password = confirmed_password
		if($password == $confirmed_password){
			// check if password is not empty
			if(!empty($password)){
				// check to make sure both username (email) and password are valid
				if(validateUsername($username) && validatePassword($password)){
					// hash the password
					$hashed_password = password_hash($password, PASSWORD_BCRYPT);
					
					// Connect to database
					$con = mysqli_connect('localhost', 'root', '', 'onlineautopartsstore');
					if(!$con){
						die('Could not connect: '.mysqli_error($con));
					}
					
					// SQL statement to update row in DB
					$sql = "UPDATE User
							SET `first_name`='$first_name',`last_name`='$last_name',`email`='$username',`hashed_password`='$hashed_password',`phone_number`='$phone'
							WHERE `user_ID`=$user_ID";
					$result = $con->query($sql);
					
					if ($result == true) {
						// update session variables
						session_start();
						$_SESSION["username"] = $username;
						$_SESSION["user_ID"] = $user_ID;
						$_SESSION["first_name"] = $first_name;
						$_SESSION["last_name"] = $last_name;
						$_SESSION["phone"] = $phone;
						echo "Profile updated successfully";
					} else {
						echo "Error updating profile: " . $con->error;
					}

					// Close Mysql connection
					$con->close();
				}else{
					echo 'Invalid email address or password. Please try again.';
				}
			}else{
				// check to make sure username (email) is valid
				if(validateUsername($username)){
					// Connect to database
					$con = mysqli_connect('localhost', 'root', '', 'onlineautopartsstore');
					if(!$con){
						die('Could not connect: '.mysqli_error($con));
					}
					
					// SQL statement to update row in DB
					$sql = "UPDATE User
							SET `first_name`='$first_name',`last_name`='$last_name',`email`='$username',`phone_number`='$phone'
							WHERE `user_ID`=$user_ID";
					$result = $con->query($sql);
					
					if ($result == true) {
						// update session variables
						session_start();
						$_SESSION["username"] = $username;
						$_SESSION["user_ID"] = $user_ID;
						$_SESSION["first_name"] = $first_name;
						$_SESSION["last_name"] = $last_name;
						$_SESSION["phone"] = $phone;
						echo "Profile updated successfully";
					} else {
						echo "Error updating profile: " . $con->error;
					}

					// Close Mysql connection
					$con->close();
				}else{
					echo 'Invalid email address. Please try again.';
				}
			}
		}else{
			echo 'Password and confirmed password do not match. Please try again.';
		}	
	}
	
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