<?php

  include('authentication.php');

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }

  if (isset($_GET['logout'])) {
 	unset($_SESSION['username']);
	session_destroy();
	header("Location: login.php");
  }
?>

<title>Welcome to my forum | Add your question</title>
<link rel="stylesheet" type="text/css" href="style.css">
<nav>
	<div> MY FORUM </div>
</nav>
<br/>

<div> Hi <i><?php echo $_SESSION['username'];?></i>, <a href="home.php?logout='1'" style="color: blue;">logout</a> </div>

<div class="wrapper">

<form method="POST">
	<input type="text" placeholder="Enter your question here" name="question">
	<input type="submit" value="Create question">
	<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
</form>


<h3>Questions</h3>

<?php
$dbhost = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$database = 'secureforum';
$database_connection = mysqli_connect($dbhost, $dbusername, $dbpassword, $database);


if ( isset($_POST['question'] ) && !empty($_POST['question'])) {

	$question = strip_tags($_POST['question']);
	$user = $_SESSION['username'];

	// These queries will add the question to the mysql database. We used prepared statement to prevent sql injection
	$stmt1 = $db->prepare("INSERT INTO `questions` (`question`, `username`) VALUES (?, ?)");
	$stmt2 = $db->prepare("INSERT INTO `answers` (`question`) VALUES (?)");

	$stmt1->bind_param("ss", $question, $user);
	$stmt2->bind_param("s", $question);
	$stmt1->execute();
	$stmt2->execute();
	header("Location: home.php");
	stmt1.close();
	stmt2.close();
}

//here we join the question and answer tables to get information about the question and answer
$query = "SELECT questions.question, questions.username, answers.question, answers.username as user, answers.answer
					FROM answers
					INNER JOIN questions
					ON questions.question=answers.question;";

$stmt = $db -> prepare($query);
$stmt->execute();
$results = $stmt->get_result();

while ($question_data = $results->fetch_assoc()) {
	$question = $question_data['question'];
	$username = $question_data['username'];
	$answer = $question_data['answer'];
	$user = $question_data['user'];

	echo "<div class='single-question'>
			<p>$username asks:</p>
			<b>$question</b>
			<br><br>
			<p>$user answers:</p>
			<p>$answer </p>
			<br>
			<a href='answer.php?question=$question'>Answer</a>
		</div>";
}
?>

</div>
