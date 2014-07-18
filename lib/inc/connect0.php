<?php

	//Include database connection details
	require_once 'cfgdb.php';

	//Array to store validation errors
	$errmsg_arr = array();

	//Validation error flag
	$errflag = false;

	//Connect to mysql server
    
	$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
	if($link->connect_error) {
		trigger_error('Failed to connect to server: ' . $link->connect_error, E_USER_ERROR);
	}

?>