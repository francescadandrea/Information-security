<?php

// initializing variables
$username = "";
$password    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'forum');

// REGISTER USER
if (isset($_POST['reg_user'])) {
	// receive all input values from the form
  	$username = $_POST['username'];
  	$password = $_POST['password'];

  	// first check the database to make sure 
  	// a user does not already exist with the same username and/or email
  	$user_check_query = "SELECT * FROM authentication WHERE username='$username'";
  	$result = mysqli_query($db, $user_check_query);
  	$user = mysqli_fetch_assoc($result);

  	$query = "INSERT INTO authentication (username, password) 
  			VALUES('$username', '$password')";
  	mysqli_query($db, $query);
  	setcookie("user", $username, time() + 3600, "/");
  	header('location: home.php');
}

// LOGIN USER
if (isset($_POST['login_user'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];
  
  	$query = "SELECT * FROM authentication WHERE username='$username' AND password='$password'";
 	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) != 0) {
    	setcookie("user", $username, time() + 3600, "/");
  		header('location: home.php');
  	}else {
  		echo "Wrong username/password combination: " . $query;
  	}
}

?>
