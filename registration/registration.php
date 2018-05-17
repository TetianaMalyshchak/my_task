<?php 
function checkbox_verify($_name)// Выполняет: проверку checkbox
{
$result=0;

if (isset($_REQUEST[$_name]))
{ if ($_REQUEST[$_name]=='on') {$result=1;}
}
return $result;
}
?>

<?php

	$login =trim(strip_tags( $_REQUEST['login']));
	$password = trim(strip_tags($_REQUEST['password']));
	$real_name=trim(strip_tags($_REQUEST['real_name']));
	$email = trim(strip_tags($_REQUEST['email']));
	$time=time();//время регистрации

	include 'connect.php';//подключение к серверу
//проверка полей на наличие данных
	if ( empty($_REQUEST['password']) || empty($_REQUEST['login']) ||empty($_REQUEST['email'])  ||  empty($_REQUEST['real_name']) || empty($_REQUEST['birth_date'])|| empty($_REQUEST['select']) || checkbox_verify('checkme')===0)
	{$Errors[]= 'Поля не могут быть пустыми';}
//проверка эмейла
	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
	{$Errors[]="Введён не правильный email";}
//проверка уникальности логина и эмейла
	$query = 'SELECT*FROM users WHERE login="'.$login.'" or email= "'.$email.'"';
	$is_Login_free=mysqli_fetch_assoc(mysqli_query($link,$query));	
	if(!empty($is_Login_free)){$Errors[]='Такой логин/email уже существует';}
//Действия выполняемые при отсутствии ошибок в заполнении
//старт сесии, запись всех полей в базу данных
	if(empty($Errors))
	{
	$saltedPassword=password_hash($password,PASSWORD_BCRYPT);

				$query = 'INSERT INTO users SET login="'.$login.'", 
					password="'.$saltedPassword.'", email="'.$email.'",timestamp_Unix="'.$time.'",birth_date="'.$_REQUEST['birth_date'].'",country="'.$_REQUEST['select'].'",real_name="'.$real_name.'"';
				mysqli_query($link,$query);
				
				session_start(); 
				$_SESSION['auth'] = true; 
				$_SESSION['login'] = $login;
				$_SESSION['email'] = $email; 
			
				header('Location:http://localhost/registration/personal_room.php');
}
// действия выполняемые если была допущена какая либо ошибка
// возвращаем заполненную форму для повторой попытки пользователя
else
{
$sql = 'SELECT * FROM country;'; 
$result = mysqli_query($link,$sql);
foreach($Errors as $err){ echo $err."<br/>";}
				unset($Errors);}?>


	<form action='registration.php' method='POST'>
		Email:<input type='email' name='email' placeholder='email' value="<?=$email?>"><br/>
		Login:<input type='text' name='login' placeholder='Login' value="<?=$login?>"><br/>
		Real   :<input type='text' name='real_name' placeholder='Real_name' value="<?=$real_name?>"><br/>
		Password:<input type='password' name='password' placeholder='password'><br/>
		Birth date<input type='date' name='birth_date' value="<?=$_REQUEST['birth_date']?>"><br/>
	<p><select size="1" name="select">
    <option disabled>Выберите страну</option>
    <?php while($object = mysqli_fetch_assoc($result)):?>
    <option value ="<?=$object['name_country']?>"><?=$object['name_country']; ?></option>
    <?php endwhile;?>
   </select></p>
<input type="checkbox" name="checkme">agree with terms and conditions <br/>
		<input type="submit" name="Sign in" value="Sign in">
	</form>
	
