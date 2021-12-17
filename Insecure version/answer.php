<?php
  include('authentication.php');

  if (!isset($_COOKIE['user'])) {
  	header('location: login.php');
  }
?>

<title>Answer to a question</title>
<link rel="stylesheet" type="text/css" href="style.css">
<nav>
	<div> MY FORUM </div>
</nav>
<br/>

<?php

$dbhost = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$database = 'secureforum';
$db = mysqli_connect($dbhost, $dbusername, $dbpassword, $database);
$token = $_SESSION['_token'];

$question = $_GET['question'];

echo "<form method='POST'>
		<div class='single-question'>
			<b>$question</b>
			<br/><br/>
			<textarea name='answer' rows='4'></textarea>
			<br/><br/>
			<input type='submit'  value='Insert answer'/>
		</div>
		<input type='hidden' name='_token'  value='$token'/>
	</form>
";

if ( isset($_POST['answer'] ) && !empty($_POST['answer'])) {

	$answer = mysqli_real_escape_string($db, $_POST['answer']);
	$username = $_SESSION['username'];

	// This query will add the question to the mysql database, note that we are substituting
	// the $query variable in the below query.
	$query = $db -> prepare("UPDATE `answers` SET answer=?, username=? WHERE question=?");
	$query->bind_param("sss", $answer, $username, $question);
	$query->execute();
	header("Location: home.php");
}
?>
