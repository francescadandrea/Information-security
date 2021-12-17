<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['_token']) || ($_POST['_token'] !== $_SESSION['_token'])) {
        die('Invalid CSRF token');
    }
}

$_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));

// initializing variables
$username = "";
$password    = "";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'secureforum');
if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
	// receive all input values from the form. We use real_escape_string to protect us from sql injection
  	$username = mysqli_real_escape_string($db, $_POST['username']);
  	$password = mysqli_real_escape_string($db, $_POST['password']);

 	//encrypt the password
  	$password = md5($password);

  	$query = $db->prepare("INSERT INTO authentication (username, password)
  		  VALUES(?, ?)");
  	$query->bind_param("ss", $username, $password);
	$query->execute();
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: home.php');
}

// LOGIN USER
if (isset($_POST['login_user'])) {
	// receive all input values from the form. We use real_escape_string to protect us from sql injection
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	//encrypt the password
  	$password = md5($password);

  	$stmt = $db -> prepare("SELECT * FROM authentication WHERE username=? AND password=?");
 	$stmt->bind_param("ss", $username, $password);
	$stmt->execute();
 	$results = $stmt->get_result();
  	if (mysqli_num_rows($results) == 1) {
    	$_SESSION['username'] = $username;
    	$_SESSION['success'] = "You are now logged in";
  		header('location: home.php');
  	}else {
  		echo "Wrong username/password combination";
  	}
}

?>
