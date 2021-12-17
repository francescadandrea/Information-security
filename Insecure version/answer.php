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
$database = 'forum';
$database_connection = mysqli_connect($dbhost, $dbusername, $dbpassword, $database);

$question = $_GET['question'];

$sql = "SELECT * FROM `answers` WHERE question='$question'";
$question_query = mysqli_query($database_connection, $sql);
$question_data = mysqli_fetch_assoc($question_query);
$question = $question_data['question'];


echo "<form method='POST'>
		<div class='single-question'>
			<b>$question</b>
			<br/><br/>
			<textarea name='answer' rows='4'></textarea>
			<br/><br/>
			<input type='submit'  value='Insert answer'/>
		</div>
	</form>
";
	
if ( isset($_POST['answer'] ) && !empty($_POST['answer'])) {

	$answer = $_POST['answer'];
	$username = $_COOKIE['user'];

	// This query will add the question to the mysql database, note that we are substituting
	// the $query variable in the below query.
	$query = "UPDATE `answers` SET answer='$answer', username='$username' WHERE question='$question'";

	mysqli_query($database_connection, $query);
	header("Location: home.php");
}
?>