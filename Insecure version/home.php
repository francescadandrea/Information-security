<?php 

  include('authentication.php');

  if (!isset($_COOKIE['user'])) {
  	header('location: login.php');
  }
  
  if (isset($_GET['logout'])) {
 	unset($_COOKIE['user']);
	setcookie('user', '', time() - 3600, '/');
	header("Location: login.php");
  }
?>

<title>Welcome to my forum | Add your question</title>
<link rel="stylesheet" type="text/css" href="style.css">
<nav>
	<div> MY FORUM </div>
</nav>
<br/>

<div> Hi <i><?php echo $_COOKIE['user'];?></i>, <a href="home.php?logout='1'" style="color: blue;">logout</a> </div>

<div class="wrapper">

<form method="POST">
	<input type="text" placeholder="Enter your question here" name="question">
	<input type="submit" value="Create question">
</form>


<h3>Questions</h3>

<?php
$dbhost = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$database = 'forum';
$database_connection = mysqli_connect($dbhost, $dbusername, $dbpassword, $database);


if ( isset($_POST['question'] ) && !empty($_POST['question'])) {

	$question = $_POST['question'];
	$user = $_COOKIE['user'];

	// This query will add the question to the mysql database, note that we are substituting
	// the $query variable in the below query.
	$query1 = "INSERT INTO `questions` (`question`, `username`) VALUES ('$question', '$user')";
	$query2 = "INSERT INTO `answers` (`question`,`answer`, `username`) VALUES ('$question', '', '')";

	mysqli_query($database_connection, $query1);
	mysqli_query($database_connection, $query2);
	header("Location: home.php");
}

$questions_query = "SELECT questions.question, questions.username, answers.question, answers.username as user, answers.answer
					FROM answers
					INNER JOIN questions
					ON questions.question=answers.question;";
$questions_result = mysqli_query($database_connection, $questions_query);

while ($question_data = mysqli_fetch_assoc($questions_result) ) {
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