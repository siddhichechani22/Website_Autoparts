<?php
	// Connect to database
	$con = mysqli_connect('localhost', 'root', '', 'onlineautopartsstore');
	if(!$con){
		die('Could not connect: '.mysqli_error($con));
	}
?>