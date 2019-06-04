<?php
	// script to logout and unset all session variables
	session_start();
	session_unset();
	session_destroy();
	$_SESSION = array();
	
	header("location: index.html");
?>