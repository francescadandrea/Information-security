<?php include('authentication.php') ?>

<!DOCTYPE html>
<html>
<head>
  <title>Login system</title>
  <link rel="stylesheet" type="text/css" href="loginStyle.css">
</head>

<body>
  <div class="header">
  	<h2>Login</h2>
  </div>

  <form method="post" action="login.php">
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" maxlength="15" required>
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password" maxlength="18" required>
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  	<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
  </form>
</body>
</html>
