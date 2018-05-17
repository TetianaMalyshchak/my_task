<?php

if(@$_SESSION['auth']==true && isset($_SESSION['login']) && !empty($_SESSION['auth']))
{ 			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'personal_room.php';
			header("Location: http://$host$uri/$extra");
			exit; }
 else
 {
echo '<html>
<head>
<meta charset="utf-8">
	<title>Site</title>
</head>
<body>
<div class="wrapper">

	<form action="autorisation.php" method="POST">
		<input type="text" name="login" placeholder="Login">
		<input type="password" name="password" placeholder="Password">
		<input type="submit" name="Enter" value="Enter">
	</form>
	<a href="registrationForm.php" >Регистрация</a>

</div>
</body>
</html>';}
?>