
<?php 
session_start();
echo "Привет  ".$_SESSION['login']."<br/>";
echo "Твой эмейл:  ".$_SESSION['email'];
?>
<?php 
if(isset($_POST['Exit'])){
	unset($_SESSION['login']);
	unset($_SESSION['email']);
	$_SESSION['auth']=false;
	session_destroy(); //завершаем сессию для пользователя и удаляем данные
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'auth.php';
			header("Location: http://$host$uri/$extra");
			exit;
}
?>

<html>
<head>
<meta charset="utf-8">
	<title>Site</title>
</head>
<body>
<div class="wrapper">

	<form action="personal_room.php" method="POST">
		<input type="submit" name="Exit" value="Exit">
	</form>
	
</div>
</body>
</html>

