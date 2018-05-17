

<?php 
		$login = trim(strip_tags($_REQUEST['login']));
		$password = trim(strip_tags($_REQUEST['password']));
		include 'connect.php';//подключение к серверу
		 $query = 'SELECT*FROM users WHERE login="'.$login.'" or email= "'.$login.'" ';
		$result = mysqli_query($link, $query); 
		$user = mysqli_fetch_assoc($result); 

//проверка на заполнение полей и соответствия пароля
		if ( empty($_REQUEST['password']) || empty($_REQUEST['login'])||empty($user) || !password_verify($password,$user['password']) )
		{$Error[]= "Не верный логин или пароль";}

//запуск сессии и запись данных при отсутствии ошибок
		if(empty($Error))
		{
			session_start(); 
			$_SESSION['auth'] = true; 
			$_SESSION['login'] = $user['login']; 
			$_SESSION['email'] = $user['email'];
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'personal_room.php';
			header("Location: http://$host$uri/$extra");
			exit;
		}
//отрисовываем заполненную форму 
		else{
			foreach($Error as $err){ echo $err."<br/>";}
				unset($Error);}?>
			<form action='autorisation.php' method='POST'>
		<input type='text' name='login' placeholder='Login' value="<?=$login?>">
		<input type='password' name='password' placeholder='Password'>
		<input type='submit' name='Enter' value='Enter'>
	</form>
	<a href='registrationForm.php' >Регистрация</a>
		
